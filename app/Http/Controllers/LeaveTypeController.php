<?php
// app/Http/Controllers/LeaveTypeController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless($request->user()->can('manage-leave-types'), 403);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(LeaveType::query())
                ->addColumn('action', fn ($lt) => view('leave-types.partials.actions', ['leaveType' => $lt])->render())
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('leave-types.index');
    }

    public function create() { return view('leave-types.create'); }

    public function store(StoreLeaveTypeRequest $request)
    {
        LeaveType::create($request->validated());
        return redirect()->route('leave-types.index')->with('success', 'Leave type created.');
    }

    public function edit(LeaveType $leaveType) { return view('leave-types.edit', compact('leaveType')); }

    public function update(UpdateLeaveTypeRequest $request, LeaveType $leaveType)
    {
        $leaveType->update($request->validated());
        return redirect()->route('leave-types.index')->with('success', 'Leave type updated.');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();
        return redirect()->route('leave-types.index')->with('success', 'Leave type deleted.');
    }
}