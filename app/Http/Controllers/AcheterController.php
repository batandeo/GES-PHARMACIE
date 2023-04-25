<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAcheterRequest;
use App\Http\Requests\UpdateAcheterRequest;
use App\Models\Produit;
use App\Models\Acheter;
use App\Repositories\AcheterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Flash;
use Response;

class AcheterController extends AppBaseController
{
    /** @var AcheterRepository $acheterRepository*/
    private $acheterRepository;

    public function __construct(AcheterRepository $acheterRepo)
    {
        $this->acheterRepository = $acheterRepo;
    }

    /**
     * Display a listing of the Acheter.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $acheters = $this->acheterRepository->all();
        $produits = Produit::all();
        return view('acheters.index', compact(['produits', 'acheters']));
    }

    /**
     * Show the form for creating a new Acheter.
     *
     * @return Response
     */
    public function create()
    {
        return view('acheters.create');
    }

    /**
     * Store a newly created Acheter in storage.
     *
     * @param CreateAcheterRequest $request
     *
     * @return Response
     */
    public function store(CreateAcheterRequest $request)
    {
        $input = $request->all();

        $acheter = $this->acheterRepository->create($input);

        Flash::success('Acheter saved successfully.');

        return redirect(route('acheters.index'));
    }

    /**
     * Display the specified Acheter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $acheter = $this->acheterRepository->find($id);

        if (empty($acheter)) {
            Flash::error('Acheter not found');

            return redirect(route('acheters.index'));
        }

        return view('acheters.show')->with('acheter', $acheter);
    }

    /**
     * Show the form for editing the specified Acheter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $acheter = $this->acheterRepository->find($id);

        if (empty($acheter)) {
            Flash::error('Acheter not found');

            return redirect(route('acheters.index'));
        }

        return view('acheters.edit')->with('acheter', $acheter);
    }

    /**
     * Update the specified Acheter in storage.
     *
     * @param int $id
     * @param UpdateAcheterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAcheterRequest $request)
    {
        $acheter = $this->acheterRepository->find($id);

        if (empty($acheter)) {
            Flash::error('Acheter not found');

            return redirect(route('acheters.index'));
        }

        $acheter = $this->acheterRepository->update($request->all(), $id);

        Flash::success('Acheter updated successfully.');

        return redirect(route('acheters.index'));
    }

    /**
     * Remove the specified Acheter from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $acheter = $this->acheterRepository->find($id);

        if (empty($acheter)) {
            Flash::error('Acheter not found');

            return redirect(route('acheters.index'));
        }

        $this->acheterRepository->delete($id);

        Flash::success('Acheter deleted successfully.');

        return redirect(route('acheters.index'));
    }

    public function sell(Request $request)
    {

        //dd($request);
        if (empty($request->all()['product'])) {
            return json_encode(['status' => 422, 'exception' => 'null data provided']);
        }
        foreach ($request->all()['product'] as $productsell) {
            try {
                DB::beginTransaction();
                $new_achat = new Acheter();
                $new_achat->quantite = $productsell['quantity'] == null ? 0 : $productsell['quantity'];
                $new_achat->produit_id = Produit::where('libelle', $productsell['name'])->first()->id;

                $new_achat->user_id = auth()->user()->id;
                $new_achat->date_achat = $productsell['date_achat'] ?? now();
                try {

                    if ($new_achat->quantite > Produit::where('libelle', $productsell['name'])->first()->qte_final) {
                        // return json_encode(['status' => 200, 'Message' => 'La quantité commandé est supérieur à la quantité restante']);
                        Flash::success('La quantité commandé est supérieur à la quantité restante');
                        return redirect(route('acheters.index'));
                    }
                    if ($new_achat->quantite < 0) {
                        // return json_encode(['status' => 200, 'Message' => 'La quantité commandé est supérieur à la quantité restante']);
                        Flash::success('La quantité commandé ne peut pas être négative');
                        return redirect(route('acheters.index'));
                    }
                    $new_achat->save();
                    Produit::where('libelle', $productsell['name'])->update(['qte_final' => Produit::where('libelle', $productsell['name'])->first()->qte_final - $new_achat->quantite]);
                    Produit::where('libelle', $productsell['name'])->update(['qte_sortie' => Produit::where('libelle', $productsell['name'])->first()->qte_sortie + $new_achat->quantite]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return json_encode(['status' => 500, 'exception' => $e->getMessage()]);
                }
            } catch (\Exception $e) {
                return json_encode(['status' => 500, 'exception' => $e->getMessage()]);
            }
        }
        return json_encode(['status' => 201, 'date' => now()]);
        //Flash::success('Achats instances stored successfully');
    }

    public function sellListToday(Request $request)
    {
        $today = Carbon::today();
        $acheters = Acheter::whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();
        $pages = Acheter::paginate(100);
        return view('acheters.sellList', compact(['acheters', 'pages']));
    }

    public function sellListWeek(Request $request)
    {
        //$today = Carbon::today();
        $weekAgo = Carbon::now()->subWeek(); // date il y a une semaine
        $acheters = Acheter::where('created_at', '>=', $weekAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        $pages = Acheter::paginate(100);
        return view('acheters.sellList', compact(['acheters', 'pages']));
    }

    public function sellListMonth(Request $request)
    {
        //$today = Carbon::today();
        $monthAgo = Carbon::now()->subMonth(); // date il y a une semaine
        $acheters = Acheter::where('created_at', '>=', $monthAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        $pages = Acheter::paginate(100);
        return view('acheters.sellList', compact(['acheters', 'pages']));
    }

    // display 5 last product more selling
    public function sellProductBestLeast(Request $request)
    {
        $today = Carbon::today();
        $produits = Produit::all();

        $acheterTodays = Acheter::whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        // 5 best sellers today
        $bestSellers = Acheter::whereDate('created_at', $today)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        $weekAgo = Carbon::now()->subWeek(); // date il y a une semaine
        $acheterWeeks = Acheter::where('created_at', '>=', $weekAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        // 5 best sellers a week
        $bestSellersWeeks = Acheter::whereDate('created_at', '>=', $weekAgo)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();


        $monthAgo = Carbon::now()->subMonth();
        $acheterMonths = Acheter::where('created_at', '>=', $monthAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        // 5 best a month
        $bestSellersMonths = Acheter::whereDate('created_at', '>=', $monthAgo)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        // 5 least product by day
        $leastSoldDays = Acheter::whereDate('created_at', '>=', $today)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderBy('total_sales', 'asc')
            ->take(5)
            ->get();

        // 5 least product by week
        $leastSoldWeeks = Acheter::whereDate('created_at', '>=', $weekAgo)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderBy('total_sales', 'asc')
            ->take(5)
            ->get();

        // 5 least product by month
        $leastSoldMonths = Acheter::whereDate('created_at', '>=', $monthAgo)
            ->select('produit_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('produit_id')
            ->orderBy('total_sales', 'asc')
            ->take(5)
            ->get();

        return view('home', compact(['acheterTodays', 'acheterWeeks','acheterMonths', 'leastSoldMonths','leastSoldWeeks','leastSoldDays','bestSellers','bestSellersWeeks', 'produits','bestSellersMonths']));
    }

    public function searchProd(Request $request): JsonResponse
    {
        $searchTerm = $request->input('searchTerm');
        $acheters = Acheter::where('created_at', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return response()->json(['acheters' => $acheters]);
    }

    public function showProducts($date)
    {
        $acheters = Acheter::where('date', $date)->get();

        return response()->json(['acheters' => $acheters]);
    }
}
