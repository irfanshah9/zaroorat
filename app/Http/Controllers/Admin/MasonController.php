<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Masons;
use Redirect;

class MasonController extends Controller
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
        return view('admin.mason.add');
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
            'm_name' => 'required',
            'm_phone_1' => 'required',
            'm_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           Masons::create($data);
          return redirect('admin/mason/show')->with(['message'=>'Mason Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.mason.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mason = Masons::find($id);
        $edit = true;
        return view('admin.mason.add',compact('mason','edit'));
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
            'm_name' => 'required',
            'm_phone_1' => 'required',
            'm_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $masons = Masons::find($id);
        $masons->update($data);
        $masons->save();

        return redirect('admin/mason/show')->with(['message'=>'Mason Updated successfully']);
        
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
      Masons::destroy($ids);
      \Session::flash('message', 'Mason Deleted Successfully');
       exit();
    }
    public function get_mason_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'm_name', 'm_f_name','m_phone_1','m_location','m_address','m_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->m_name;
             $m_father =$request->m_father;
             $m_contact =$request->m_contact;
             $m_address =$request->m_address;
             $m_location =$request->m_location;
             $m_description =$request->m_description;
             if(!empty($name)){
                 $where['m_name'] = '%' . $name . '%'; 
             }
             if(!empty($m_father)){
                 $where['m_f_name'] = '%' . $m_father . '%'; 
             }
             if(!empty($m_contact)){
                 $where['m_phone_1'] = '%' . $m_contact . '%'; 
             }
             if(!empty($m_location)){
                 $where['m_location'] = '%' . $m_location . '%'; 
             }
             if(!empty($m_address)){
                 $where['m_address'] = '%' . $m_address . '%'; 
             }
             if(!empty($m_description)){
                 $where['m_description'] = '%' . $m_description . '%'; 
             }
             
         }
         $count = Masons::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = Masons::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['m_name'],
                    $c['m_f_name'],
                    $c['m_phone_1'],
                    $c['m_location'],
                    $c['m_address'],
                    $c['m_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../mason/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_mason(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
