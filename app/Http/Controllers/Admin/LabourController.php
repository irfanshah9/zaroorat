<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Labours;
use Redirect;

class LabourController extends Controller
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
        return view('admin.labour.add');
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
            'l_name' => 'required',
            'l_phone_1' => 'required',
            'l_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           Labours::create($data);
          return redirect('admin/labour/show')->with(['message'=>'Labour Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.labour.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $labour = Labours::find($id);
        $edit = true;
        return view('admin.labour.add',compact('labour','edit'));
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
            'l_name' => 'required',
            'l_phone_1' => 'required',
            'l_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $labours = Labours::find($id);
        $labours->update($data);
        $labours->save();

        return redirect('admin/labour/show')->with(['message'=>'Labour Updated successfully']);
        
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
      Labours::destroy($ids);
      \Session::flash('message', 'Labour Deleted Successfully');
       exit();
    }
    public function get_labour_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'l_name', 'l_f_name','l_phone_1','l_location','l_address','l_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->l_name;
             $l_father =$request->l_father;
             $l_contact =$request->l_contact;
             $l_address =$request->l_address;
             $l_location =$request->l_location;
             $l_description =$request->l_description;
             if(!empty($name)){
                 $where['l_name'] = '%' . $name . '%'; 
             }
             if(!empty($l_father)){
                 $where['l_f_name'] = '%' . $l_father . '%'; 
             }
             if(!empty($l_contact)){
                 $where['l_phone_1'] = '%' . $l_contact . '%'; 
             }
             if(!empty($l_location)){
                 $where['l_location'] = '%' . $l_location . '%'; 
             }
             if(!empty($l_address)){
                 $where['l_address'] = '%' . $l_address . '%'; 
             }
             if(!empty($l_description)){
                 $where['l_description'] = '%' . $l_description . '%'; 
             }
             
         }
         $count = Labours::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = Labours::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['l_name'],
                    $c['l_f_name'],
                    $c['l_phone_1'],
                    $c['l_location'],
                    $c['l_address'],
                    $c['l_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../labour/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_labour(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
