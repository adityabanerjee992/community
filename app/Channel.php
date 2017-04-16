<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{	
	/**
	 * mass assignment
	 */
    protected $fillable = ['title', 'slug', 'color'];

    /**
 	* Get the route key for the model.
 	*
 	* @return string
 	*/
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}
