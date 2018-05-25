<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ElectricianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      //  return view('admin.students.students');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.electrician.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        die('here');
        $validatedData = $request->validate([
            'e_name' => 'required',
            'ef_name' => 'required',
            'location' => 'required',
        ]);
            
            $data = $request->all();
            echo "<pre>";
            print_r($data); exit;
            unset($data['_token']);
            $user = Student::create($data);
        // return redirect('admin/students')->with(['message'=>'Student saved successfully']);
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
       
        $edit = true;
        return view('admin.students.add',compact('student','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'std_name' => 'required|max:255',
        ]);
        $data = $request->all();
        unset($data['_token']);
        
        // return $data;
        $student = Student::find($id);
        $student->update($data);
        $student->save();

        return redirect('admin/students')->with(['message'=>'Student Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->back()->with(['message'=>'Student Deleted successfully']);
    }
}
