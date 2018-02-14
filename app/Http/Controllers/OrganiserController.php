<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganiserRequest;
use App\Http\Requests\UpdateOrganiserRequest;
use App\Repositories\OrganiserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrganiserController extends AppBaseController
{
    /** @var  OrganiserRepository */
    private $organiserRepository;

    public function __construct(OrganiserRepository $organiserRepo)
    {
        $this->organiserRepository = $organiserRepo;
    }

    /**
     * Display a listing of the Organiser.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->organiserRepository->pushCriteria(new RequestCriteria($request));
        $organisers = $this->organiserRepository->all();

        return view('organisers.index')
            ->with('organisers', $organisers);
    }

    /**
     * Show the form for creating a new Organiser.
     *
     * @return Response
     */
    public function create()
    {
        return view('organisers.create');
    }

    /**
     * Store a newly created Organiser in storage.
     *
     * @param CreateOrganiserRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganiserRequest $request)
    {
        $input = $request->all();

        $organiser = $this->organiserRepository->create($input);

        Flash::success('Organiser saved successfully.');

        return redirect(route('organisers.index'));
    }

    /**
     * Display the specified Organiser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            Flash::error('Organiser not found');

            return redirect(route('organisers.index'));
        }

        return view('organisers.show')->with('organiser', $organiser);
    }

    /**
     * Show the form for editing the specified Organiser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            Flash::error('Organiser not found');

            return redirect(route('organisers.index'));
        }

        return view('organisers.edit')->with('organiser', $organiser);
    }

    /**
     * Update the specified Organiser in storage.
     *
     * @param  int              $id
     * @param UpdateOrganiserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganiserRequest $request)
    {
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            Flash::error('Organiser not found');

            return redirect(route('organisers.index'));
        }

        $organiser = $this->organiserRepository->update($request->all(), $id);

        Flash::success('Organiser updated successfully.');

        return redirect(route('organisers.index'));
    }

    /**
     * Remove the specified Organiser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            Flash::error('Organiser not found');

            return redirect(route('organisers.index'));
        }

        $this->organiserRepository->delete($id);

        Flash::success('Organiser deleted successfully.');

        return redirect(route('organisers.index'));
    }
}
