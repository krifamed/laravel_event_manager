<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrganiserAPIRequest;
use App\Http\Requests\API\UpdateOrganiserAPIRequest;
use App\Models\Organiser;
use App\Repositories\OrganiserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OrganiserController
 * @package App\Http\Controllers\API
 */

class OrganiserAPIController extends AppBaseController
{
    /** @var  OrganiserRepository */
    private $organiserRepository;

    public function __construct(OrganiserRepository $organiserRepo)
    {
        $this->organiserRepository = $organiserRepo;
    }

    /**
     * Display a listing of the Organiser.
     * GET|HEAD /organisers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->organiserRepository->pushCriteria(new RequestCriteria($request));
        $this->organiserRepository->pushCriteria(new LimitOffsetCriteria($request));
        $organisers = $this->organiserRepository->all();

        return $this->sendResponse($organisers->toArray(), 'Organisers retrieved successfully');
    }

    /**
     * Store a newly created Organiser in storage.
     * POST /organisers
     *
     * @param CreateOrganiserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrganiserAPIRequest $request)
    {
        $input = $request->all();

        $organisers = $this->organiserRepository->create($input);

        return $this->sendResponse($organisers->toArray(), 'Organiser saved successfully');
    }

    /**
     * Display the specified Organiser.
     * GET|HEAD /organisers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Organiser $organiser */
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            return $this->sendError('Organiser not found');
        }

        return $this->sendResponse($organiser->toArray(), 'Organiser retrieved successfully');
    }

    /**
     * Update the specified Organiser in storage.
     * PUT/PATCH /organisers/{id}
     *
     * @param  int $id
     * @param UpdateOrganiserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrganiserAPIRequest $request)
    {
        $input = $request->all();

        /** @var Organiser $organiser */
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            return $this->sendError('Organiser not found');
        }

        $organiser = $this->organiserRepository->update($input, $id);

        return $this->sendResponse($organiser->toArray(), 'Organiser updated successfully');
    }

    /**
     * Remove the specified Organiser from storage.
     * DELETE /organisers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Organiser $organiser */
        $organiser = $this->organiserRepository->findWithoutFail($id);

        if (empty($organiser)) {
            return $this->sendError('Organiser not found');
        }

        $organiser->delete();

        return $this->sendResponse($id, 'Organiser deleted successfully');
    }
}
