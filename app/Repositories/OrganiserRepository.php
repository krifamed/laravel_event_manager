<?php

namespace App\Repositories;

use App\Models\Organiser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrganiserRepository
 * @package App\Repositories
 * @version February 11, 2018, 4:13 pm UTC
 *
 * @method Organiser findWithoutFail($id, $columns = ['*'])
 * @method Organiser find($id, $columns = ['*'])
 * @method Organiser first($columns = ['*'])
*/
class OrganiserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Organiser::class;
    }
}
