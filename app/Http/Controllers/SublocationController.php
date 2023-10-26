<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Sublocation;
use Illuminate\Http\Request;

class SublocationController extends Controller
{
    // Show all locations
    public function show(Location $location){
        $lid = $location['id'];
        $subs = Sublocation::where('area','=',$lid)->get();
        return view('sublocations.index', [
            'sublocations' => $subs
        ]);    
    }
}
