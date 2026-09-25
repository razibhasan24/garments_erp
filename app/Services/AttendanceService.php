<?php
// app/Services/AttendanceService.php
namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    /**
     * Bulk save/update a whole day's attendance sheet at once.
     */
    public function saveDailyAttendance(string $date, array $entries, int $markedBy): void
    {
        DB::transaction(function () use ($date, $entries, $markedBy) {
            foreach ($entries as $entry) {
                $workingHours = 0;
                if (!empty($entry['in_time']) && !empty($entry['out_time'])) {
                    $in = Carbon::parse($entry['in_time']);
                    $out = Carbon::parse($entry['out_time']);
                    $workingHours = round($out->diffInMinutes($in) / 60, 2);
                }

                Attendance::updateOrCreate(
                    ['employee_id' => $entry['employee_id'], 'attendance_date' => $date],
                    [
                        'in_time' => $entry['in_time'] ?? null,
                        'out_time' => $entry['out_time'] ?? null,
                        'working_hours' => $workingHours,
                        'overtime_hours' => $entry['overtime_hours'] ?? 0,
                        'status' => $entry['status'],
                        'remarks' => $entry['remarks'] ?? null,
                        'marked_by' => $markedBy,
                    ]
                );
            }
        });
    }

    /**
     * Import attendance from a biometric-exported CSV.
     * Expected columns: employee_id,attendance_date,in_time,out_time
     */
    public function importFromCsv(string $filePath, int $markedBy): array
    {
        $imported = 0;
        $skipped = 0;

        DB::transaction(function () use ($filePath, $markedBy, &$imported, &$skipped) {
            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $row);

                $employee = \App\Models\Employee::where('employee_id', $data['employee_id'] ?? null)->first();
                if (!$employee || empty($data['attendance_date'])) {
                    $skipped++;
                    continue;
                }

                $workingHours = 0;
                if (!empty($data['in_time']) && !empty($data['out_time'])) {
                    $in = Carbon::parse($data['in_time']);
                    $out = Carbon::parse($data['out_time']);
                    $workingHours = round($out->diffInMinutes($in) / 60, 2);
                }

                Attendance::updateOrCreate(
                    ['employee_id' => $employee->id, 'attendance_date' => $data['attendance_date']],
                    [
                        'in_time' => $data['in_time'] ?? null,
                        'out_time' => $data['out_time'] ?? null,
                        'working_hours' => $workingHours,
                        'status' => $workingHours > 0 ? 'Present' : 'Absent',
                        'marked_by' => $markedBy,
                    ]
                );

                $imported++;
            }

            fclose($handle);
        });

        return ['imported' => $imported, 'skipped' => $skipped];
    }
}