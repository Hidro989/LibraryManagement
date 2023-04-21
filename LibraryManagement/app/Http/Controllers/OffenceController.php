<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OffenceController extends Controller
{

    private $unseField = 6;
    public function index()
    {   
        $unseLocalVar = 5;
        return view('admin.index');
    }

    public function show(string $id)
    {
         if(emptyString($id)){
            return view('admin.index');
         }else{
            return redirect()->back();
         }
    }

    private function UnusePrivateMethod()
    {

    }

    public function edit(string $id)
    {
        //
    }

    
    
    public function store(Request $request, string $id)
    {
        
        
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

class ATooLongClassNameThatHintsAtADesignProblem{
     const myNum = 0;
     public function ATooLongClassNameThatHintsAtADesignProblem() {}

    

            
}