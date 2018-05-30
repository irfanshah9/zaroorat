<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Electricians;
use Redirect;

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
      
        $validatedData = $request->validate([
            'e_name' => 'required',
            'e_phone_1' => 'required',
            'e_location' => 'required',
        ]);
           $data = $request->all();
//         echo "<pre>";
//            print_r($data); exit;
            
           $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['e_location_name']);
            unset($data['save']);
            
           $lectricians = Electricians::create($data);
           return Redirect::back()->with('message','Electrician Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.electrician.view');
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
    public function get_electrician_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $order_by = FALSE;
        $colmnsArry = array('', '', 'e_name', 'e_f_name','e_phone_1','e_shop','e_location','e_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $order_by = $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->e_name;
             $e_father =$request->e_father;
             if(!empty($name)){
                 $where['e_name'] = '%' . $name . '%'; 
           //  $where =array('e_name', 'like', '%' . $name . '%');
                 
             }
             if(!empty($e_father)){
                 $where['e_f_name'] = '%' . $e_father . '%'; 
             }
             
         }
         $results = Electricians::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->get();
//       $results = Electricians::where($where)->get();
       $count =  count($results);
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['e_name'],
                    $c['e_f_name'],
                    $c['e_phone_1'],
                    $c['e_shop'],
                    $c['e_location'],
                    $c['e_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href=""><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_electrician(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
                ];
                $n++;
            }


      $totaldata = 30;
        $totalfiltered = 20;

        $json_data = array(
                "draw"            => intval( $_REQUEST['draw'] ),
                "recordsTotal"    => intval( $count ),
                "recordsFiltered" => intval( $count ),
                "data"            => $data
        );

        echo json_encode($json_data);
    }
}
