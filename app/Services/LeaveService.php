<?php
// app/Services/LeaveService.php
namespace App\Services;

use App\Models\LeaveApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaveService
{
    public function apply(array $data): LeaveApplication
    {
        return DB::transaction(function () use ($data) {
            $from = Carbon::parse($data['from_date']);
            $to = Carbon::parse($data['to_date']);
            $data['total_days'] = $from->diffInDays($to) + 1;
            $data['status'] = 'Pending';

            return LeaveApplication::create($data);
        });
    }

    public function updateStatus(LeaveApplication $leave, string $status, int $approverId, ?string $rejectionReason = null): LeaveApplication
    {
        DB::transaction(function () use ($leave, $status, $approverId, $rejectionReason) {
            $leave->update([
                'status' => $status,
                'approved_by' => $approverId,
                'approved_at' => now(),
                'rejection_reason' => $status === 'Rejected' ? $rejectionReason : null,
            ]);

            // If approved, mark attendance as 'Leave' for the date range
            if ($status === 'Approved') {
                $period = \Carbon\CarbonPeriod::create($leave->from_date, $leave->to_date);
                foreach ($period as $date) {
                    \App\Models\Attendance::updateOrCreate(
                        ['employee_id' => $leave->employee_id, 'attendance_date' => $date->toDateString()],
                        ['status' => 'Leave', 'marked_by' => $approverId]
                    );
                }
            }
        });

        return $leave->fresh();
    }

    /**
     * Remaining leave balance for an employee for a given leave type (current year).
     */
    public function remainingBalance(int $employeeId, int $leaveTypeId): int
    {
        $leaveType = \App\Models\LeaveType::findOrFail($leaveTypeId);

        $used = LeaveApplication::where('employee_id', $employeeId)
            ->where('leave_type_id', $leaveTypeId)
            ->where('status', 'Approved')
            ->whereYear('from_date', now()->year)
            ->sum('total_days');

        return max(0, $leaveType->days_per_year - $used);
    }
}