<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plant;
use App\Models\Garden;
use App\Models\Location;
use Illuminate\Http\Request;

class GardenController extends Controller
{
    // Show all locations
    public function list(Location $location){

        if($location->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        $lid = $location['id'];
        $gardens = Garden::where([['location','=',$lid],['user_id', auth()->user()->id]])->get();
        return view('gardens.index', [
            'gardens' => $gardens,
            'location' => $location
        ]);    
    }

    // Show the specific garden
    public function show(Garden $garden){

        if($garden->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        $gid = $garden['id'];
        $plants = Plant::where([['garden', '=', $gid],['user_id', auth()->user()->id]] )->get();
        //dd($garden);
        //dd($gid);
        //dd($plants);
        return view('gardens.detail', [
            'garden' => $garden,
            'plants' => $plants
        ]);    
    }

    public function edit(Garden $garden){

        if($garden->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        return view('gardens.edit', [
            'garden' => $garden,
        ]);
    }

    // Update garden
    public function update(Request $request, Garden $garden){

        //dd( $request);
        // Make sure logged in user is owner
        if($garden->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }
        //dd($request->all());
        $formFields = $request->validate([
            'name' => 'required',
            'width' => 'required',
            'length' => 'required',
            'description' => 'required',
        ]);

        //dd($formFields);
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('gardens','public');
        }
        //dd($formFields);
        $garden->update($formFields);

        return back()->with('message', 'Garden Updated successfully');
    }        

    public function create(Location $location){

        if($location->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        return view('gardens.create',[
            'location' => $location 
        ]);
    }

    // Update garden
    public function store(Request $request){

        // user_id info 
        $auth=auth()->user()->id;
        $user=User::find($auth);
        
        $formFields = $request->validate([
            'name' => 'required',
            'width' => 'required',
            'length' => 'required',
            'location' => 'required',
            'description' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['shape'] = 'rectangle';

        //dd($formFields);
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('gardens','public');
        }
        //dd($formFields);
        Garden::create($formFields);

        return back()->with('message', 'Garden Created successfully');
    }        

    // Test    
    public function test(){

        // user_id info 
        $auth=auth()->user()->id;
        if($auth !== 1){
            abort(403, 'Unauthorized Action');
        }

        $gardens = Garden::get();
        $plants  = Plant::get();
        $locations  = Location::get();
        return view('test', [
            'gardens' => $gardens,
            'plants' => $plants,
            'locations' => $locations
        ]);    
    }

}
