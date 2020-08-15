<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;
use App\Ad;


class BusesController extends Controller
{
    public function __contruct(){
		$this->middleware('auth');
	}

    public function index(){
    	$buses = Bus::all();
    	return view('buses', compact('buses'));
    }

    public function store(Request $request){

    	$bus = new Bus;
    	$bus->reference = $request->reference;
    	$bus->pickup = $request->pickup;
        $bus->drop = $request->drop;

        $bus->save();

        return redirect()->route('buses');

    }

    public function edit(Request $request){

    	$bus = Bus::findOrFail($request->id);
    	$bus->reference = $request->reference;
    	$bus->pickup = $request->pickup;
        $bus->drop = $request->drop;

        $bus->update();

        return redirect()->route('buses');

    }
    public function bus_pub($id){



        $bus = Bus::with(['ads'=> function($query){
            $query->where('begin','<=', date("Y-m-d H:i:s"))
            ->where('end','>=', date("Y-m-d H:i:s")); 
        }])->findOrFail($id);
       
        return view('index', compact('bus')); 
    }
}
