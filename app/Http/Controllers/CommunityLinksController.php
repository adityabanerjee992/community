<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CommunityLink;
use App\Channel;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Http\Requests\CommunityLinkForm;

class CommunityLinksController extends Controller
{
    public function index(Channel $channel = null)
    {	
    	$links = CommunityLink::with('votes', 'creator', 'channel')
                    ->forChannel($channel)
                    ->where('approved', 1)
                    ->latest('updated_at')
                    ->paginate(7);

        $channels = Channel::orderBy('title', 'asc')->get();
    	return view('community.index', compact('links', 'channels', 'channel'));	
    }

    public function store(CommunityLinkForm $form)
    {	
        try {
            $form->persist();
        	if(Auth::user()->trusted){
                flash('Thanks for the contribution', 'success');
            }else{
                flash()->overlay('Your contribution will be reviewed shortly!', 'Thanks');
            }
            
        } catch (CommunityLinkAlreadySubmitted $e) {
            flash()->overlay(
                    'we will bump the timestamps and bring that link back to the top. Thanks!', 
                    'That link has already been submitted'
            );
        }

    	return back();
    }

}
