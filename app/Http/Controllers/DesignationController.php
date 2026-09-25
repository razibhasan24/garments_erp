<?php
// app/Http/Controllers/DesignationController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Designation::class, 'designation');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $designations = Designation::with('department');

            return DataTables::of($designations)
                ->addColumn('department', fn ($d) => $d->department->name ?? '-')
                ->addColumn('status_badge', fn ($d) => $d->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', fn ($d) => view('designations.partials.actions', ['designation' => $d])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('designations.index');
    }

    public function create()
    {
        return view('designations.create', ['departments' => Department::where('is_active', true)->get()]);
    }

    public function store(StoreDesignationRequest $request)
    {
        Designation::create($request->validated());
        return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
    }

    public function edit(Designation $designation)
    {
        return view('designations.edit', [
            'designation' => $designation,
            'departments' => Department::where('is_active', true)->get(),
        ]);
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $designation->update($request->validated());
        return redirect()->route('designations.index')->with('success', 'Designation updated successfully.');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designations.index')->with('success', 'Designation deleted successfully.');
    }
}
