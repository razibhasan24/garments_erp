<?php
// app/Http/Controllers/LeaveApplicationController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveApplicationRequest;
use App\Http\Requests\UpdateLeaveApplicationStatusRequest;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use App\Services\LeaveService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveApplicationController extends Controller
{
    public function __construct(private LeaveService $leaveService)
    {
        $this->authorizeResource(LeaveApplication::class, 'leave_application');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leaves = LeaveApplication::with(['employee', 'leaveType']);

            return DataTables::of($leaves)
                ->addColumn('employee_name', fn ($l) => $l->employee->name . ' (' . $l->employee->employee_id . ')')
                ->addColumn('leave_type', fn ($l) => $l->leaveType->name)
                ->addColumn('status_badge', function ($l) {
                    $map = ['Pending' => 'warning', 'Approved' => 'success', 'Rejected' => 'danger', 'Cancelled' => 'secondary'];
                    return '<span class="badge bg-' . $map[$l->status] . '">' . $l->status . '</span>';
                })
                ->addColumn('action', fn ($l) => view('leave-applications.partials.actions', ['leave' => $l])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('leave-applications.index');
    }

    public function create()
    {
        return view('leave-applications.create', [
            'employees' => Employee::where('status', 'Active')->orderBy('name')->get(),
            'leaveTypes' => LeaveType::where('is_active', true)->get(),
        ]);
    }

    public function store(StoreLeaveApplicationRequest $request)
    {
        $this->leaveService->apply($request->validated());
        return redirect()->route('leave-applications.index')->with('success', 'Leave application submitted.');
    }

    public function updateStatus(UpdateLeaveApplicationStatusRequest $request, LeaveApplication $leave_application)
    {
        $this->leaveService->updateStatus(
            $leave_application,
            $request->status,
            $request->user()->id,
            $request->rejection_reason
        );

        return redirect()->route('leave-applications.index')->with('success', 'Leave application ' . strtolower($request->status) . '.');
    }

    public function destroy(LeaveApplication $leave_application)
    {
        $leave_application->delete();
        return redirect()->route('leave-applications.index')->with('success', 'Leave application deleted.');
    }
}
