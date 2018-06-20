<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Plumbers;
use Redirect;

class PlumberController extends Controller
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
        return view('admin.plumber.add');
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
            'p_name' => 'required',
            'p_phone_1' => 'required',
            'p_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           $lectricians = Plumbers::create($data);
          return redirect('admin/plumber/show')->with(['message'=>'Plumber Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.plumber.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plumber = Plumbers::find($id);
        $edit = true;
        return view('admin.plumber.add',compact('plumber','edit'));
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
            'p_name' => 'required',
            'p_phone_1' => 'required',
            'p_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
           // return $data;
        $electricians = Plumbers::find($id);
        $electricians->update($data);
        $electricians->save();

        return redirect('admin/plumber/show')->with(['message'=>'Plumber Updated successfully']);
        
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
      Plumbers::destroy($ids);
      \Session::flash('message', 'Plumber Deleted Successfully');
       exit();
    }
    public function get_plumber_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'p_name', 'p_f_name','p_phone_1','p_shop','p_location','p_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->p_name;
             $p_father =$request->p_father;
             $p_contact =$request->p_contact;
             $p_shop =$request->p_shop;
             $p_location =$request->p_location;
             $p_description =$request->p_description;
             if(!empty($name)){
                 $where['p_name'] = '%' . $name . '%'; 
             }
             if(!empty($p_father)){
                 $where['p_f_name'] = '%' . $p_father . '%'; 
             }
             if(!empty($p_contact)){
                 $where['p_phone_1'] = '%' . $p_contact . '%'; 
             }
             
             if(!empty($p_shop)){
                 $where['p_shop'] = '%' . $p_shop . '%'; 
             }
             if(!empty($p_location)){
                 $where['p_location'] = '%' . $p_location . '%'; 
             }
             if(!empty($p_description)){
                 $where['p_description'] = '%' . $p_description . '%'; 
             }
             
         }
         $count = Plumbers::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = Plumbers::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['p_name'],
                    $c['p_f_name'],
                    $c['p_phone_1'],
                    $c['p_shop'],
                    $c['p_location'],
                    $c['p_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../plumber/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_plumber(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
