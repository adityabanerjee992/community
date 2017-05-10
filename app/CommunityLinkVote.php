<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{   
    /**
     * table to refer for this model.
     * @var string
     */
    protected $table = 'community_links_votes';


    /**
     * protect from mass assignment
     * @var array
     */
    protected $fillable = ['user_id', 'community_link_id'];


    /**
     * taggle the vote when user clicks on it.
     * @return boolean 
     */
    public function toggle()
    {
    	if($this->exists){
    		return $this->delete();
    	}	
    	return $this->save();
    }
}
