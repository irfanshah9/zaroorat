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
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['e_location_name']);
            unset($data['save']);
            
           $lectricians = Electricians::create($data);
          return redirect('admin/electrician/show')->with(['message'=>'Electrician Added successfully']);
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
        $electrician = Electricians::find($id);
        $edit = true;
        return view('admin.electrician.add',compact('electrician','edit'));
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
            'e_name' => 'required',
            'e_phone_1' => 'required',
            'e_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['e_location_name']);
            unset($data['save']);
           // return $data;
        $electricians = Electricians::find($id);
        $electricians->update($data);
        $electricians->save();

        return redirect('admin/electrician/show')->with(['message'=>'Electrician Updated successfully']);
        
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
      Electricians::destroy($ids);
      \Session::flash('message', 'Electrician Deleted Successfully');
       exit();
    }
    public function get_electrician_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'e_name', 'e_f_name','e_phone_1','e_shop','e_location','e_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->e_name;
             $e_father =$request->e_father;
             $e_contact =$request->e_contact;
             $e_shop =$request->e_shop;
             $e_location =$request->e_location;
             $e_description =$request->e_description;
             if(!empty($name)){
                 $where['e_name'] = '%' . $name . '%'; 
             }
             if(!empty($e_father)){
                 $where['e_f_name'] = '%' . $e_father . '%'; 
             }
             if(!empty($e_contact)){
                 $where['e_phone_1'] = '%' . $e_contact . '%'; 
             }
             
             if(!empty($e_shop)){
                 $where['e_shop'] = '%' . $e_shop . '%'; 
             }
             if(!empty($e_location)){
                 $where['e_location'] = '%' . $e_location . '%'; 
             }
             if(!empty($e_description)){
                 $where['e_description'] = '%' . $e_description . '%'; 
             }
             
         }
         $count = Electricians::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = Electricians::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
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
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../electrician/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_electrician(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
    public function electriciansbulkdelete ($id){
        var_dump($id); exit;
        
    }
}
