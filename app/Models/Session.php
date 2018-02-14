<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Session
 * @package App\Models
 * @version February 13, 2018, 2:57 pm UTC
 *
 * @property \App\Models\Day day
 * @property \Illuminate\Database\Eloquent\Collection moduleFields
 * @property \Illuminate\Database\Eloquent\Collection participations
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection roleModule
 * @property \Illuminate\Database\Eloquent\Collection roleModuleFields
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection roles
 * @property string title
 * @property string|\Carbon\Carbon start_date
 * @property string|\Carbon\Carbon end_date
 * @property string payed
 * @property string description
 * @property string speaker
 * @property integer day_id
 */
class Session extends Model
{
    use SoftDeletes;

    public $table = 'sessions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'start_date',
        'end_date',
        'payed',
        'description',
        'speaker',
        'day_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'payed' => 'string',
        'description' => 'string',
        'speaker' => 'string',
        'day_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function day()
    {
        return $this->belongsTo(\App\Models\Day::class);
    }
}
