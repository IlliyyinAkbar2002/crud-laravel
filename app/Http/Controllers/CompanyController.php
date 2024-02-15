<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
// use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function index(){
        $companies = Company::orderBy('id','desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    public function create(){
        return view('companies.create');
    }


    public function store(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'address' =>'required'
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company Has Been updated successfully');
    }

    public function destroy($id){
        Company::destroy($id);
        return redirect()->route('companies.index')->with('success', 'Company Has Been deleted successfully');
    }

    public function edit($id){
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'address' =>'required'
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        return redirect()->route('companies.index')->with('success', 'Company Has Been updated successfully');
    }
}
