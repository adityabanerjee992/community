<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * check if user is trusted or not.
     * @return boolean 
     */
    public function trusted()
    {   
        return ($this->trusted == 1) ? true : false; 
    }


    /**
     * vote belongto many user.
     * @return collection
     */
    public function votes()
    {
        return $this->belongsToMany(CommunityLink::class, 'community_links_votes')->withTimestamps(); 
    }


    /**
     * [votedFor description]
     * @param  CommunityLink $link [description]
     * @return [type]              [description]
     */
    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id);
    }
}
