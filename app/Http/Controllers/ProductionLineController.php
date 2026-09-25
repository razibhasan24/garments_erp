<?php
// app/Http/Controllers/ProductionLineController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionLineRequest;
use App\Http\Requests\UpdateProductionLineRequest;
use App\Models\Floor;
use App\Models\ProductionLine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductionLineController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProductionLine::class, 'production_line');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lines = ProductionLine::with('floor');

            return DataTables::of($lines)
                ->addColumn('floor', fn ($l) => $l->floor->name ?? '-')
                ->addColumn('status_badge', fn ($l) => $l->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', fn ($l) => view('production-lines.partials.actions', ['line' => $l])->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('production-lines.index');
    }

    public function create()
    {
        return view('production-lines.create', ['floors' => Floor::where('is_active', true)->get()]);
    }

    public function store(StoreProductionLineRequest $request)
    {
        ProductionLine::create($request->validated());
        return redirect()->route('production-lines.index')->with('success', 'Production line created successfully.');
    }

    public function edit(ProductionLine $productionLine)
    {
        return view('production-lines.edit', [
            'line' => $productionLine,
            'floors' => Floor::where('is_active', true)->get(),
        ]);
    }

    public function update(UpdateProductionLineRequest $request, ProductionLine $productionLine)
    {
        $productionLine->update($request->validated());
        return redirect()->route('production-lines.index')->with('success', 'Production line updated successfully.');
    }

    public function destroy(ProductionLine $productionLine)
    {
        $productionLine->delete();
        return redirect()->route('production-lines.index')->with('success', 'Production line deleted successfully.');
    }
}
