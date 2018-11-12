<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class _Carousel extends Model
{
	use SoftDeletes;
    protected $table = 'carousel';
	protected $primaryKey = 'id';
    protected $guarded = [];
	public $incrementing = false;
	protected $dates = ['deleted_at'];
}
