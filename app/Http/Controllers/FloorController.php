<?php
// app/Http/Controllers/FloorController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use App\Models\Factory;
use App\Models\Floor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FloorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Floor::class, 'floor');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $floors = Floor::query();

            return DataTables::of($floors)
                ->addColumn('status_badge', fn ($f) => $f->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', fn ($f) => view('floors.partials.actions', ['floor' => $f])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('floors.index');
    }

    public function create()
    {
        return view('floors.create', ['factories' => Factory::where('is_active', true)->get()]);
    }

    public function store(StoreFloorRequest $request)
    {
        Floor::create($request->validated());
        return redirect()->route('floors.index')->with('success', 'Floor created successfully.');
    }

    public function edit(Floor $floor)
    {
        return view('floors.edit', [
            'floor' => $floor,
            'factories' => Factory::where('is_active', true)->get(),
        ]);
    }

    public function update(UpdateFloorRequest $request, Floor $floor)
    {
        $floor->update($request->validated());
        return redirect()->route('floors.index')->with('success', 'Floor updated successfully.');
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return redirect()->route('floors.index')->with('success', 'Floor deleted successfully.');
    }
}
