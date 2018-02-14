<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model
{
    use SoftDeletes;

	protected $table = 'participations';

	protected $hidden = [

    ];
  public static $rules = [];
	protected $guarded = [];

	protected $dates = ['deleted_at'];
}
