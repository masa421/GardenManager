<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plant;
use App\Models\Garden;
use Illuminate\Http\Request;

class PlantController extends Controller
{

    // Show Edit Form
    public function edit(Plant $plant){

        // Make sure logged in user is owner
        if($plant->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        $gid = $plant['garden'];
        $garden = Garden::where('id','=',$gid)->first();

        // Make sure logged in user is owner
        if($garden->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        // dd($garden);
        return view('plants.edit', ['plant' => $plant, 'garden' => $garden]);
    }

    // Update plant
    public function update(Request $request, Plant $plant){

        // Make sure logged in user is owner
        if($plant->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        //dd($request->all());
        $formFields = $request->validate([
            'name' => 'required',
            'planted' => 'required',
            'color' => 'required',
            'size' => 'required',
            'description' => 'required',
            'positionx' => 'required',
            'positiony' => 'required',
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('images','public');
        }
        // dd($formFields);
        $plant->update($formFields);

        return back()->with('message', 'Plant Updated successfully');
    }

    // Add plant to garden
    public function add(Garden $garden){

        // Make sure logged in user is owner
        if($garden->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }

        // dd($garden);
        return view('plants.add', ['garden' => $garden]);
    }

    // Update plant
    public function store(Request $request, Plant $plant){
        
        // user_id info 
        $auth=auth()->user()->id;
        $user=User::find($auth);

        //dd($request->all());
        $formFields = $request->validate([
            'name' => 'required',
            'planted' => 'required',
            'color' => 'required',
            'size' => 'required',
            'description' => 'required',
            'positionx' => 'required',
            'positiony' => 'required',
            'garden' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('images','public');
        }

        //dd($formFields);
        Plant::create($formFields);

        return back()->with('message', 'Garden Created successfully');
    }    

    // Delete plant from garden
    public function delete(Plant $plant){

        // Make sure logged in user is owner
        if($plant->user_id != auth()->id() ){
            abort(403, 'Unauthorized Action');
        }
        
        $plant->delete();
        return redirect("/garden/$plant->garden")->with('message', 'Plant Deleted successfully');
    }


}
