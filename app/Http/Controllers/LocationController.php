<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Show all locations
    public function index(){

        $id = auth()->user()->id;
        return view('locations.index', [
            'locations' => Location::where('user_id', auth()->user()->id)->get()
        ]);    
    }

    // Show all locations
    public function show(Location $location){
        $lid = $location['id'];
        return view('locations.index', [
            'locations' => Location::where('user_id', auth()->user()->id)->get()
        ]);    
    }

    // Add Location of the garden
    public function add(){
        return view('locations.add');
    }
    
    // Update garden
    public function store(Request $request){

        // user_id info 
        $auth=auth()->user()->id;
        $user=User::find($auth);
        
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();

        /*
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('gardens','public');
        }
        */
        //dd($formFields);
        Location::create($formFields);

        return back()->with('message', 'Location Created successfully');
    }        

}
