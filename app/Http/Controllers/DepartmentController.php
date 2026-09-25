<?php
// app/Http/Controllers/DepartmentController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Department::class, 'department');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Department::query())
                ->addColumn('status_badge', fn ($d) => $d->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', fn ($d) => view('departments.partials.actions', ['department' => $d])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }
        return view('departments.index');
    }

    public function create() { return view('departments.create'); }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    public function edit(Department $department) { return view('departments.edit', compact('department')); }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted.');
    }
}