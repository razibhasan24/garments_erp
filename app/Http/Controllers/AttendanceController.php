<?php
// app/Http/Controllers/AttendanceController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function __construct(private AttendanceService $attendanceService)
    {
        $this->authorizeResource(Attendance::class, 'attendance');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $date = $request->get('date', now()->toDateString());
            $attendances = Attendance::with('employee')->whereDate('attendance_date', $date);

            return DataTables::of($attendances)
                ->addColumn('employee_name', fn ($a) => $a->employee->name . ' (' . $a->employee->employee_id . ')')
                ->addColumn('status_badge', function ($a) {
                    $map = ['Present' => 'success', 'Absent' => 'danger', 'Leave' => 'info', 'Holiday' => 'secondary', 'Weekend' => 'secondary', 'Late' => 'warning'];
                    return '<span class="badge bg-' . $map[$a->status] . '">' . $a->status . '</span>';
                })
                ->make(true);
        }

        return view('attendance.index');
    }

    /**
     * Show the daily attendance entry sheet for a chosen date.
     */
    public function create(Request $request)
    {
        $date = $request->get('date', now()->toDateString());
        $employees = Employee::where('status', 'Active')->orderBy('name')->get();
        $existing = Attendance::whereDate('attendance_date', $date)->get()->keyBy('employee_id');

        return view('attendance.create', compact('employees', 'existing', 'date'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $this->attendanceService->saveDailyAttendance(
            $request->attendance_date,
            $request->entries,
            $request->user()->id
        );

        return redirect()->route('attendance.index', ['date' => $request->attendance_date])
            ->with('success', 'Attendance saved successfully.');
    }

    public function import(Request $request)
    {
        return view('attendance.import');
    }

    public function processImport(Request $request)
    {
        $request->validate(['csv_file' => ['required', 'file', 'mimes:csv,txt']]);

        $result = $this->attendanceService->importFromCsv($request->file('csv_file')->getRealPath(), $request->user()->id);

        return redirect()->route('attendance.index')
            ->with('success', "Import complete: {$result['imported']} imported, {$result['skipped']} skipped.");
    }
}
