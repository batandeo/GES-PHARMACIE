<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use App\Repositories\CategorieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Flash;
use Response;

class CategorieController extends AppBaseController
{
    /** @var CategorieRepository $categorieRepository*/
    private $categorieRepository;

    public function __construct(CategorieRepository $categorieRepo)
    {
        $this->categorieRepository = $categorieRepo;
    }

    /**
     * Display a listing of the Categorie.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
       // $categories = $this->categorieRepository->all();

        $categories = Categorie::paginate(20);

        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Categorie.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Categorie in storage.
     *
     * @param CreateCategorieRequest $request
     *
     * @return Response
     */
    public function store(CreateCategorieRequest $request)
    {
        $input = $request->all();

        $categorie = $this->categorieRepository->create($input);

        Flash::success('Categorie saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Categorie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categorie', $categorie);
    }

    /**
     * Show the form for editing the specified Categorie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('categorie', $categorie);
    }

    /**
     * Update the specified Categorie in storage.
     *
     * @param int $id
     * @param UpdateCategorieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategorieRequest $request)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('categories.index'));
        }

        $categorie = $this->categorieRepository->update($request->all(), $id);

        Flash::success('Categorie updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Categorie from storage.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('categories.index'));
        }

        $this->categorieRepository->delete($id);

        Flash::success('Categorie deleted successfully.');

        return redirect(route('categories.index'));
    }

    public function searchCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $searchTerm = $request->input('searchTerm');
        $categories = Categorie::where('libelle', 'LIKE', '%'.$searchTerm.'%')
            ->get();
        return response()->json(['categories' => $categories]);
    }
}
