<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

use App\Http\Requests\CreateProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Categorie;
use App\Models\Lot;
use App\Models\Produit;
use App\Repositories\ProduitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Routing\Redirector;
use Response;

class ProduitController extends AppBaseController
{
    /** @var ProduitRepository $produitRepository*/

    private $produitRepository;

    public function __construct(ProduitRepository $produitRepo)
    {
        $this->produitRepository = $produitRepo;
    }

    public function downloadPDF()
    {
        $data = Produit::all();
        $pdf = PDF::loadView('produits.index', $data);
        return $pdf->download('ma-liste.pdf');
    }
    /**
     * Display a listing of the Produit.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
       // $produits = $this->produitRepository->all();


        $produits = Produit::paginate(50);

        return view('produits.index')->with('produits', $produits);
    }

    /**
     * Show the form for creating a new Produit.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        //$produit = $this->produitRepository->all();
        $categories = Categorie::pluck('libelle','id');
        $lots = Lot::pluck('numero','id');

        return view('produits.create',compact(['categories', 'lots']));
    }

    /**
     * Store a newly created Produit in storage.
     *
     * @param CreateProduitRequest $request
     *
     * @return Response
     */
    public function store(CreateProduitRequest $request)
    {
        $input = $request->all();
        $input['qte_final'] = $request->qte_init;
        $input['qte_sortie'] = $request->qte_init - $input['qte_final'];
       // dd($input);

       $produit = $this->produitRepository->create($input);



        Flash::success('Produit saved successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Display the specified Produit.
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        return view('produits.show')->with('produit', $produit);
    }

    /**
     * Show the form for editing the specified Produit.
     *
     * @param int $id
     *
     * @return Application|Factory|Redirector|RedirectResponse|View
     */
    public function edit($id)
    {
        $produit = $this->produitRepository->find($id);
        $categories = Categorie::all();
        $lots = Lot::all();

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        //return view('produits.edit')->with('produit', $produit);
        return view('produits.edit',compact(['categories', 'produit','lots']));
    }

    /**
     * Update the specified Produit in storage.
     *
     * @param int $id
     * @param UpdateProduitRequest $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update($id, UpdateProduitRequest $request)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $produit = $this->produitRepository->update($request->all(), $id);

        Flash::success('Produit updated successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Remove the specified Produit from storage.
     *
     * @param int $id
     *
     * @return Application|Redirector|RedirectResponse
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $this->produitRepository->delete($id);

        Flash::success('Produit deleted successfully.');

        return redirect(route('produits.index'));
    }

    public function searchProduit(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $produits = Produit::where('libelle', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('code', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('qte_init', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('qte_final', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('prix_public', 'LIKE', '%'.$searchTerm.'%')
            ->orWhere('prix_session', 'LIKE', '%'.$searchTerm.'%')
            ->get();
        return response()->json(['produits' => $produits]);
    }


}
