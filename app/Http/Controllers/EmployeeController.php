<?php
// app/Http/Controllers/EmployeeController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Factory;
use App\Models\Floor;
use App\Models\ProductionLine;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $employeeService)
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::with(['department', 'designation']);

            return DataTables::of($employees)
                ->addColumn('department', fn ($e) => $e->department->name ?? '-')
                ->addColumn('designation', fn ($e) => $e->designation->name ?? '-')
                ->addColumn('status_badge', function ($e) {
                    $map = ['Active' => 'success', 'Resigned' => 'secondary', 'Terminated' => 'danger', 'Layoff' => 'warning'];
                    return '<span class="badge bg-' . $map[$e->status] . '">' . $e->status . '</span>';
                })
                ->addColumn('action', fn ($e) => view('employees.partials.actions', ['employee' => $e])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('employees.index');
    }

    private function formData(): array
    {
        return [
            'factories' => Factory::where('is_active', true)->get(),
            'departments' => Department::where('is_active', true)->get(),
            'designations' => Designation::where('is_active', true)->get(),
            'floors' => Floor::where('is_active', true)->get(),
            'lines' => ProductionLine::where('is_active', true)->get(),
        ];
    }

    public function create()
    {
        return view('employees.create', $this->formData());
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeService->create($request->validated(), $request->file('photo'));

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['department', 'designation', 'floor', 'productionLine', 'attendances' => fn ($q) => $q->latest('attendance_date')->limit(30)]);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', array_merge(['employee' => $employee], $this->formData()));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeService->update($employee, $request->validated(), $request->file('photo'));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $this->employeeService->delete($employee);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
