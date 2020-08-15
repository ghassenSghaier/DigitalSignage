<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Bus;
use App\Ad;
use Auth;

class UsersController extends Controller
{
    public function index(){
    	$users = User::whereNotNull('company_id')->with('company')->get();
    	$companies = Company::pluck('name', 'id');
    	return view('users', compact('users', 'companies'));
    }

    public function store(Request $request){

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->company_id = $request->company_id;
    	$user->save();

    	return redirect()->back();
    	
    }

    public function edit(Request $request, $id){
    	
    	$user = User::findOrFail($id);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->company_id = $request->company_id;
    	$user->save();

    	return redirect()->back(); 	
    }

    public function access(){
    	$user = Auth::user();
    	if($user->company_id != null){
    		$ads=Company::with('ads')->find(1);
    		$company = $user->company()->with('ads')->get();
    	}
        $buses = Bus::all();
    	return view('access', compact('company', 'ads', 'buses'));
    	
    }
}
