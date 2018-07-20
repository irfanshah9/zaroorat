<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\AC_Mechanics;
use Redirect;

class AC_MechanicController extends Controller
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
        return view('admin.ac_mechanic.add');
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
            'ac_m_name' => 'required',
            'ac_m_phone_1' => 'required',
            'ac_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           AC_Mechanics::create($data);
          return redirect('admin/ac_mechanic/show')->with(['message'=>'AC Mechanic Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.ac_mechanic.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ac_mechanic = AC_Mechanics::find($id);
        $edit = true;
        return view('admin.ac_mechanic.add',compact('ac_mechanic','edit'));
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
            'ac_m_name' => 'required',
            'ac_m_phone_1' => 'required',
            'ac_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $ac_mechanic = AC_Mechanics::find($id);
        $ac_mechanic->update($data);
        $ac_mechanic->save();

        return redirect('admin/ac_mechanic/show')->with(['message'=>'AC Mechanic Updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ids = explode(",", $id);  
      AC_Mechanics::destroy($ids);
      \Session::flash('message', 'AC Mechanic Deleted Successfully');
       exit();
    }
    public function get_ac_mechanic_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'ac_m_name', 'ac_m_f_name','ac_m_phone_1','ac_m_shop','ac_m_location','ac_m_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->ac_m_name;
             $ac_m_father =$request->ac_m_father;
             $ac_m_contact =$request->ac_m_contact;
             $ac_m_shop =$request->ac_m_shop;
             $ac_m_location =$request->ac_m_location;
             $ac_m_description =$request->ac_m_description;
             if(!empty($name)){
                 $where['ac_m_name'] = '%' . $name . '%'; 
             }
             if(!empty($ac_m_father)){
                 $where['ac_m_f_name'] = '%' . $ac_m_father . '%'; 
             }
             if(!empty($ac_m_contact)){
                 $where['ac_m_phone_1'] = '%' . $ac_m_contact . '%'; 
             }
             
             if(!empty($ac_m_shop)){
                 $where['ac_m_shop'] = '%' . $ac_m_shop . '%'; 
             }
             if(!empty($ac_m_location)){
                 $where['ac_m_location'] = '%' . $ac_m_location . '%'; 
             }
             if(!empty($ac_m_description)){
                 $where['ac_m_description'] = '%' . $ac_m_description . '%'; 
             }
             
         }
         $count = AC_Mechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = AC_Mechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['ac_m_name'],
                    $c['ac_m_f_name'],
                    $c['ac_m_phone_1'],
                    $c['ac_m_shop'],
                    $c['ac_m_location'],
                    $c['ac_m_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../ac_mechanic/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_ac_mechanic(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
                ];
                $n++;
            }

        $json_data = array(
                "draw"            => intval( $_REQUEST['draw'] ),
                "recordsTotal"    => intval( $count ),
                "recordsFiltered" => intval( $count ),
                "data"            => $data
        );

        echo json_encode($json_data);
    }
  
}
