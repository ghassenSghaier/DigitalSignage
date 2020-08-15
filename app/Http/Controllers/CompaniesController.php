<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Image; 


class CompaniesController extends Controller
{	
	public function __contruct(){
		$this->middleware('auth');
	}

    public function index(){
    	$companies = Company::all();
    	return view('companies', compact('companies'));
    }

    public function store(Request $request){

    	$company = new Company;
    	$company->name = $request->name;
    	$company->description = $request->description;
    	 
    	if(Input::file()){
    		$image = Input::file()['logo'];
        
            $filename  = time() .'.' . $image->getClientOriginalExtension();

            $path = public_path('/img/uploads/').'/'. $filename;
        
            Image::make($image)->save($path, 80);

           
          
       }

       $company->logo = $filename;

       $company->save();

       return redirect()->route('companies');

    }

    public function edit(Request $request){

    	$company = Company::findOrFail($request->id);
    	$company->name = $request->name;
    	$company->description = $request->description;
    	 
    	if(Input::file()){
    		$image = Input::file()['logo'];
        
            $filename  = time() .'.' . $image->getClientOriginalExtension();

            $path = public_path('/img/uploads/').'/'. $filename;
        
            Image::make($image)->save($path, 80);

           
          
       }

       $company->logo = $filename;

       $company->update();

       return redirect()->route('companies');

    }


}
