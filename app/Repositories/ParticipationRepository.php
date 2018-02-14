<?php

namespace App\Repositories;

use App\Models\Participation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParticipationRepository
 * @package App\Repositories
 * @version February 12, 2018, 11:00 am UTC
 *
 * @method Participation findWithoutFail($id, $columns = ['*'])
 * @method Participation find($id, $columns = ['*'])
 * @method Participation first($columns = ['*'])
*/
class ParticipationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client_id',
        'event_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Participation::class;
    }
}
