<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\LockMasters;
use Redirect;

class LockMasterController extends Controller
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
        return view('admin.lock_master.add');
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
            'lm_name' => 'required',
            'lm_phone_1' => 'required',
            'lm_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           LockMasters::create($data);
          return redirect('admin/lock_master/show')->with(['message'=>'Lock Master Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.lock_master.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lock_master = LockMasters::find($id);
        $edit = true;
        return view('admin.lock_master.add',compact('lock_master','edit'));
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
            'lm_name' => 'required',
            'lm_phone_1' => 'required',
            'lm_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $lock_master = LockMasters::find($id);
        $lock_master->update($data);
        $lock_master->save();

        return redirect('admin/lock_master/show')->with(['message'=>'Lock Master Updated successfully']);
        
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
      LockMasters::destroy($ids);
      \Session::flash('message', 'Lock Master Deleted Successfully');
       exit();
    }
    public function get_lock_master_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'lm_name', 'lm_f_name','lm_phone_1','lm_shop','lm_location','lm_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->lm_name;
             $lm_father =$request->lm_father;
             $lm_contact =$request->lm_contact;
             $lm_shop =$request->lm_shop;
             $lm_location =$request->lm_location;
             $lm_description =$request->lm_description;
             if(!empty($name)){
                 $where['lm_name'] = '%' . $name . '%'; 
             }
             if(!empty($lm_father)){
                 $where['lm_f_name'] = '%' . $lm_father . '%'; 
             }
             if(!empty($lm_contact)){
                 $where['lm_phone_1'] = '%' . $lm_contact . '%'; 
             }
             
             if(!empty($lm_shop)){
                 $where['lm_shop'] = '%' . $lm_shop . '%'; 
             }
             if(!empty($lm_location)){
                 $where['lm_location'] = '%' . $lm_location . '%'; 
             }
             if(!empty($lm_description)){
                 $where['lm_description'] = '%' . $lm_description . '%'; 
             }
             
         }
         $count = LockMasters::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = LockMasters::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['lm_name'],
                    $c['lm_f_name'],
                    $c['lm_phone_1'],
                    $c['lm_shop'],
                    $c['lm_location'],
                    $c['lm_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../lock_master/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_lock_master(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
