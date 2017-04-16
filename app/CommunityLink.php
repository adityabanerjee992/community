<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLink extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'approved', 'link'];

    public function creator()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public static function from(User $user)
    {   
        $link = new static;
        $link->user_id = $user->id;

        if($user->trusted()){
            $link->approve();
        }

        return $link;
    }


    public function approve()
    {
        $this->approved = true;
        
        return $this;
    }


    public function contribute($attributes)
    {   
        if($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])){
            $existing->touch();
            throw new CommunityLinkAlreadySubmitted;
        }
        return $this->fill($attributes)->save();

    }

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();        
    }


    public function scopeForChannel($builder, $channel)
    {   
        if($channel->exists){
          return $builder->where('channel_id', $channel->id);
        }
        return $builder;
    }

    
    public function votes()
    {
        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }
}
