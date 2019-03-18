<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Repositories\ViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
class ViewController extends AppBaseController
{
    /** @var  ViewRepository */
    private $viewRepository;

    public function __construct(ViewRepository $viewRepo)
    {
        $this->viewRepository = $viewRepo;
    }

    /**
     * Display a listing of the View.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->viewRepository->pushCriteria(new RequestCriteria($request));
        $views = $this->viewRepository->all();

        return view('views.index')
            ->with('views', $views);
    }

    /**
     * Show the form for creating a new View.
     *
     * @return Response
     */
    public function create()
    {
        return view('views.create');
    }

    /**
     * Store a newly created View in storage.
     *
     * @param CreateViewRequest $request
     *
     * @return Response
     */
    public function store(CreateViewRequest $request)
    {
        $input = $request->all();

        $view = $this->viewRepository->create($input);

        Flash::success('View saved successfully.');

        return redirect(route('views.index'));
    }

    /**
     * Display the specified View.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $view = $this->viewRepository->findWithoutFail($id);

        if (empty($view)) {
            Flash::error('View not found');

            return redirect(route('views.index'));
        }

        return view('views.show')->with('view', $view);
    }

    /**
     * Show the form for editing the specified View.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $view = $this->viewRepository->findWithoutFail($id);

        if (empty($view)) {
            Flash::error('View not found');

            return redirect(route('views.index'));
        }

        return view('views.edit')->with('view', $view);
    }

    /**
     * Update the specified View in storage.
     *
     * @param  int              $id
     * @param UpdateViewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateViewRequest $request)
    {
        $view = $this->viewRepository->findWithoutFail($id);

        if (empty($view)) {
            Flash::error('View not found');

            return redirect(route('views.index'));
        }

        $view = $this->viewRepository->update($request->all(), $id);

        Flash::success('View updated successfully.');

        return redirect(route('views.index'));
    }

    /**
     * Remove the specified View from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $view = $this->viewRepository->findWithoutFail($id);

        if (empty($view)) {
            Flash::error('View not found');

            return redirect(route('views.index'));
        }

        $this->viewRepository->delete($id);

        Flash::success('View deleted successfully.');

        return redirect(route('views.index'));
    }
}
