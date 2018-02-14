<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParticipationAPIRequest;
use App\Http\Requests\API\UpdateParticipationAPIRequest;
use App\Models\Participation;
use App\Repositories\ParticipationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use App\User;
use App\Models\Client;
use Response;

/**
 * Class ParticipationController
 * @package App\Http\Controllers\API
 */

class ParticipationAPIController extends AppBaseController
{
    /** @var  ParticipationRepository */
    private $participationRepository;

    public function __construct(ParticipationRepository $participationRepo)
    {
        $this->participationRepository = $participationRepo;
    }

    /**
     * Display a listing of the Participation.
     * GET|HEAD /participations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->participationRepository->pushCriteria(new RequestCriteria($request));
        $this->participationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $participations = $this->participationRepository->all();

        return $this->sendResponse($participations->toArray(), 'Participations retrieved successfully');
    }

    /**
     * Store a newly created Participation in storage.
     * POST /participations
     *
     * @param CreateParticipationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateParticipationAPIRequest $request)
    {
        $data = $request->all();
        $user = User::where('email', $data["email"])->first();
        $client = Client::where('user_id', $user->id)->first();
        // dd($client['id']);
        // $participations = $this->participationRepository->create($data);
        $participations = $this->participationRepository->create(['client_id'=>$client['id'], 'event_id'=> $data['event_id']]);

        return $this->sendResponse($participations->toArray(), 'Participation saved successfully');
    }

    /**
     * Display the specified Participation.
     * GET|HEAD /participations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Participation $participation */
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            return $this->sendError('Participation not found');
        }

        return $this->sendResponse($participation->toArray(), 'Participation retrieved successfully');
    }

    /**
     * Update the specified Participation in storage.
     * PUT/PATCH /participations/{id}
     *
     * @param  int $id
     * @param UpdateParticipationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParticipationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Participation $participation */
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            return $this->sendError('Participation not found');
        }

        $participation = $this->participationRepository->update($input, $id);

        return $this->sendResponse($participation->toArray(), 'Participation updated successfully');
    }

    /**
     * Remove the specified Participation from storage.
     * DELETE /participations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Participation $participation */
        $participation = $this->participationRepository->findWithoutFail($id);

        if (empty($participation)) {
            return $this->sendError('Participation not found');
        }

        $participation->delete();

        return $this->sendResponse($id, 'Participation deleted successfully');
    }
}
