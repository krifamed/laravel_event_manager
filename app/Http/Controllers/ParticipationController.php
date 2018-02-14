<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipationRequest;
use App\Http\Requests\UpdateParticipationRequest;
use App\Repositories\ParticipationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ParticipationController extends AppBaseController
{
    /** @var  ParticipationRepository */
    private $participationRepository;

    public function __construct(ParticipationRepository $participationRepo)
    {
        $this->participationRepository = $participationRepo;
    }

    /**
     * Display a listing of the Participation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->participationRepository->pushCriteria(new RequestCriteria($request));
        $participations = $this->participationRepository->all();

        return view('participations.index')
            ->with('participations', $participations);
    }

    /**
     * Show the form for creating a new Participation.
     *
     * @return Response
     */
    public function create()
    {
        return view('participations.create');
    }

    /**
     * Store a newly created Participation in storage.
     *
     * @param CreateParticipationRequest $request
     *
     * @return Response
     */
    public function store(CreateParticipationRequest $request)
    {
        $input = $request->all();

        $participation = $this->participationRepository->create($input);

        Flash::success('Participation saved successfully.');

        return redirect(route('participations.index'));
    }

    /**
     * Display the specified Participation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            Flash::error('Participation not found');

            return redirect(route('participations.index'));
        }

        return view('participations.show')->with('participation', $participation);
    }

    /**
     * Show the form for editing the specified Participation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            Flash::error('Participation not found');

            return redirect(route('participations.index'));
        }

        return view('participations.edit')->with('participation', $participation);
    }

    /**
     * Update the specified Participation in storage.
     *
     * @param  int              $id
     * @param UpdateParticipationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParticipationRequest $request)
    {
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            Flash::error('Participation not found');

            return redirect(route('participations.index'));
        }

        $participation = $this->participationRepository->update($request->all(), $id);

        Flash::success('Participation updated successfully.');

        return redirect(route('participations.index'));
    }

    /**
     * Remove the specified Participation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            Flash::error('Participation not found');

            return redirect(route('participations.index'));
        }

        $this->participationRepository->delete($id);

        Flash::success('Participation deleted successfully.');

        return redirect(route('participations.index'));
    }
}
