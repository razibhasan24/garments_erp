<?php
// app/Http/Controllers/BuyerController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBuyerRequest;
use App\Http\Requests\UpdateBuyerRequest;
use App\Models\Buyer;
use App\Services\BuyerService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BuyerController extends Controller
{
    public function __construct(private BuyerService $buyerService)
    {
        $this->authorizeResource(Buyer::class, 'buyer');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $buyers = Buyer::query()->select('buyers.*');

            return DataTables::of($buyers)
                ->addColumn('status_badge', fn ($b) => $b->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', function ($b) {
                    return view('buyers.partials.actions', ['buyer' => $b])->render();
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('buyers.index');
    }

    public function create()
    {
        return view('buyers.create');
    }

    public function store(StoreBuyerRequest $request)
    {
        $this->buyerService->create($request->validated());

        return redirect()->route('buyers.index')->with('success', 'Buyer created successfully.');
    }

    public function edit(Buyer $buyer)
    {
        return view('buyers.edit', compact('buyer'));
    }

    public function update(UpdateBuyerRequest $request, Buyer $buyer)
    {
        $this->buyerService->update($buyer, $request->validated());

        return redirect()->route('buyers.index')->with('success', 'Buyer updated successfully.');
    }

    public function destroy(Buyer $buyer)
    {
        $this->buyerService->delete($buyer);

        return redirect()->route('buyers.index')->with('success', 'Buyer deleted successfully.');
    }
}
