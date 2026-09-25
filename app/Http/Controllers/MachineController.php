<?php
// app/Http/Controllers/MachineController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Floor;
use App\Models\Machine;
use App\Models\ProductionLine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MachineController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Machine::class, 'machine');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $machines = Machine::with(['floor', 'productionLine']);

            return DataTables::of($machines)
                ->addColumn('floor', fn ($m) => $m->floor->name ?? '-')
                ->addColumn('line', fn ($m) => $m->productionLine->name ?? '-')
                ->addColumn('status_badge', function ($m) {
                    $map = ['Running' => 'success', 'Idle' => 'secondary', 'Under Maintenance' => 'warning', 'Scrapped' => 'danger'];
                    return '<span class="badge bg-' . $map[$m->status] . '">' . $m->status . '</span>';
                })
                ->addColumn('action', fn ($m) => view('machines.partials.actions', ['machine' => $m])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('machines.index');
    }

    private function formData(): array
    {
        return [
            'floors' => Floor::where('is_active', true)->get(),
            'lines' => ProductionLine::where('is_active', true)->get(),
        ];
    }

    public function create()
    {
        return view('machines.create', $this->formData());
    }

    public function store(StoreMachineRequest $request)
    {
        Machine::create($request->validated());
        return redirect()->route('machines.index')->with('success', 'Machine created successfully.');
    }

    public function edit(Machine $machine)
    {
        return view('machines.edit', array_merge(['machine' => $machine], $this->formData()));
    }

    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        $machine->update($request->validated());
        return redirect()->route('machines.index')->with('success', 'Machine updated successfully.');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully.');
    }
}
