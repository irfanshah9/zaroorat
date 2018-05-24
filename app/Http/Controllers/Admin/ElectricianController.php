<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricianController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**Add Elecrician into DB*/
    
    public function add_electrician(){
        return view('admin/add_electrician');
    }
}