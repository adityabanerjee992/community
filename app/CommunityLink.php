<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLink extends Model
{   
    /**
     * add fields to be safe from mass assignment.
     * @var array
     */
    protected $fillable = ['user_id', 'channel_id', 'title', 'approved', 'link'];


    /**
     * creator belongs to a community link
     * @return eloquent collection
     */
    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }


    /**
     * assign user to the link and check
     * if they are trusted or not and approve 
     * them if yes.
     * @param  User   $user 
     * @return $link  
     */
    public static function from(User $user)
    {   
        $link = new static;
        $link->user_id = $user->id;

        if($user->trusted()){
            $link->approve();
        }

        return $link;
    }


    /**
     * change approve status to true.
     * @return $this 
     */
    public function approve()
    {
        $this->approved = true;
        
        return $this;
    }


    /**
     * check if link has been submitted or not 
     *  and persist the link to the table 
     * @param  array $attributes 
     * @return boolean
     */
    public function contribute($attributes)
    {   
        if($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])){
            $existing->touch();
            throw new CommunityLinkAlreadySubmitted;
        }
        return $this->fill($attributes)->save();

    }


    /**
     * a channel belongs to a community link
     * @return eloquent collection 
     */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }


    /**
     * check if a link has been already submitted or not.
     * @param  string  $link 
     * @return boolean  
     */
    public function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();        
    }


    /**
     * dynamic query scope for channel.
     * if channel exists find channel or 
     * proceed with the query.
     * @param  $builder 
     * @param  $channel 
     * @return $builder  
     */
    public function scopeForChannel($builder, $channel)
    {   
        if($channel->exists){
          return $builder->where('channel_id', $channel->id);
        }
        return $builder;
    }


    /**
     * relationship between votes and community link
     * @return eloquent collection.
     */
    public function votes()
    {
        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }
}
