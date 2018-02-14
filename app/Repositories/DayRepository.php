<?php

namespace App\Repositories;

use App\Models\Day;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DayRepository
 * @package App\Repositories
 * @version February 13, 2018, 2:33 pm UTC
 *
 * @method Day findWithoutFail($id, $columns = ['*'])
 * @method Day find($id, $columns = ['*'])
 * @method Day first($columns = ['*'])
*/
class DayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'when',
        'event_id',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Day::class;
    }
}
