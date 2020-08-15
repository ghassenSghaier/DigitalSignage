<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Ad;
use App\Company;
use App\Bus;

class AdsController extends Controller
{
	public function index(){

		$ads = Ad::with('buses')->with('company')->get();
		$companies = Company::pluck('name','id');
		$buses = Bus::pluck('reference','id');

		return view('ads', compact('ads', 'companies', 'buses'));
	}
    public function store(Request $request){

    	$ad = new Ad;
    	$ad->titre = $request->titre;
    	$ad->begin = $request->begin;
    	$ad->end = $request->end;
    	$ad->company_id = $request->company_id;


    	$file = Input::file('video');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/video/';
        $file->move($path, $filename);

        $ad->video = $filename;

        $ad->save();

        $ad->buses()->attach($request->buses);

        return redirect()->back();


    }

    public function search(Request $request){
    	$pub = Ad::all();
       
        if($pub->all() == null){
            $buses = Bus::pluck('reference', 'id');
        }else {

            $ads = Ad::where(function ($query) use($request) {
                            $query->where('end','<', $request->begin)->where('end','<', $request->end); })
                        ->orWhere(function ($query) use($request) {
                            $query->where('begin','>', $request->begin)->where('begin','>', $request->end);
                        })
                        ->with('buses')
                        ->get();

            $allbuses = Bus::with('ads')->get();            
            $buses= array();

            foreach($ads as $ad){
                foreach($ad->buses as $bus){
                    $buses[$bus->id] = $bus->reference;
                }
            }
            foreach($allbuses as $bus){
                if($bus->ads->all() == null){
                    $buses[$bus->id] = $bus->reference;
                }
            }

        }
		return response(json_encode($buses));
    }

    public function delete(Request $request){
    	$ad = Ad::findOrFail($request->id);
    	$ad->buses()->sync([]);
    	$ad->delete();
    	return redirect()->back();
    }

}
