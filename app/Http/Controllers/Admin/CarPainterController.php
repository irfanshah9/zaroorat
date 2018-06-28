<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\CarPainters;
use Redirect;

class CarPainterController extends Controller
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
        return view('admin.carpainter.add');
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
            'cp_name' => 'required',
            'cp_phone_1' => 'required',
            'cp_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           CarPainters::create($data);
          return redirect('admin/carpainter/show')->with(['message'=>'Car Painter Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.carpainter.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carpainter = CarPainters::find($id);
        $edit = true;
        return view('admin.carpainter.add',compact('carpainter','edit'));
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
            'cp_name' => 'required',
            'cp_phone_1' => 'required',
            'cp_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $Carpainters = CarPainters::find($id);
        $Carpainters->update($data);
        $Carpainters->save();

        return redirect('admin/carpainter/show')->with(['message'=>'Car Painter Updated successfully']);
        
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
      CarPainters::destroy($ids);
      \Session::flash('message', 'Car painter Deleted Successfully');
       exit();
    }
    public function get_carpainter_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'cp_name', 'cp_f_name','cp_phone_1','cp_shop','cp_location','cp_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->cp_name;
             $cp_father =$request->cp_father;
             $cp_contact =$request->cp_contact;
             $cp_shop =$request->cp_shop;
             $cp_location =$request->cp_location;
             $cp_description =$request->cp_description;
             if(!empty($name)){
                 $where['cp_name'] = '%' . $name . '%'; 
             }
             if(!empty($cp_father)){
                 $where['cp_f_name'] = '%' . $cp_father . '%'; 
             }
             if(!empty($cp_contact)){
                 $where['cp_phone_1'] = '%' . $cp_contact . '%'; 
             }
             
             if(!empty($cp_shop)){
                 $where['cp_shop'] = '%' . $cp_shop . '%'; 
             }
             if(!empty($cp_location)){
                 $where['cp_location'] = '%' . $cp_location . '%'; 
             }
             if(!empty($cp_description)){
                 $where['cp_description'] = '%' . $cp_description . '%'; 
             }
             
         }
         $count = CarPainters::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = CarPainters::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['cp_name'],
                    $c['cp_f_name'],
                    $c['cp_phone_1'],
                    $c['cp_shop'],
                    $c['cp_location'],
                    $c['cp_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../carpainter/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_carpainter(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
