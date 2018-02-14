<?php

namespace App\Repositories;

use App\Models\Session;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SessionRepository
 * @package App\Repositories
 * @version February 13, 2018, 2:57 pm UTC
 *
 * @method Session findWithoutFail($id, $columns = ['*'])
 * @method Session find($id, $columns = ['*'])
 * @method Session first($columns = ['*'])
*/
class SessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'start_date',
        'end_date',
        'payed',
        'description',
        'speaker',
        'day_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Session::class;
    }
}
