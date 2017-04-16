<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CommunityLink;
use App\CommunityLinkVote;

class VotesController extends Controller
{	
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(CommunityLink $link)
    {	
   		CommunityLinkVote::firstOrNew([
   				'user_id' => auth()->user()->id, 
   				'community_link_id' => $link->id
   			])->toggle();

	    return back();
    }

}
