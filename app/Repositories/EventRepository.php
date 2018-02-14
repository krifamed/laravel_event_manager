<?php

namespace App\Repositories;

use App\Models\Event;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version February 11, 2018, 9:27 pm UTC
 *
 * @method Event findWithoutFail($id, $columns = ['*'])
 * @method Event find($id, $columns = ['*'])
 * @method Event first($columns = ['*'])
*/
class EventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'places',
        'public',
        'owner',
        'start',
        'end'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Event::class;
    }
}
