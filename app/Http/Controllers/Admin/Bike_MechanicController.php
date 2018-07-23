<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\BikeMechanics;
use Redirect;

class Bike_MechanicController extends Controller
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
        return view('admin.bike_mechanic.add');
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
            'bike_m_name' => 'required',
            'bike_m_phone_1' => 'required',
            'bike_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           BikeMechanics::create($data);
          return redirect('admin/bike_mechanic/show')->with(['message'=>'Bike Mechanic Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.bike_mechanic.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bike_mechanic = BikeMechanics::find($id);
        $edit = true;
        return view('admin.bike_mechanic.add',compact('bike_mechanic','edit'));
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
            'bike_m_name' => 'required',
            'bike_m_phone_1' => 'required',
            'bike_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $bike_mechanic = BikeMechanics::find($id);
        $bike_mechanic->update($data);
        $bike_mechanic->save();

        return redirect('admin/bike_mechanic/show')->with(['message'=>'Bike Mechanic Updated successfully']);
        
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
      BikeMechanics::destroy($ids);
      \Session::flash('message', 'Bike Mechanic Deleted Successfully');
       exit();
    }
    public function get_bike_mechanic_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'bike_m_name', 'bike_m_f_name','bike_m_phone_1','bike_m_shop','bike_m_location','bike_m_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->bike_m_name;
             $bike_m_father =$request->bike_m_father;
             $bike_m_contact =$request->bike_m_contact;
             $bike_m_shop =$request->bike_m_shop;
             $bike_m_location =$request->bike_m_location;
             $bike_m_description =$request->bike_m_description;
             if(!empty($name)){
                 $where['bike_m_name'] = '%' . $name . '%'; 
             }
             if(!empty($bike_m_father)){
                 $where['bike_m_f_name'] = '%' . $bike_m_father . '%'; 
             }
             if(!empty($bike_m_contact)){
                 $where['bike_m_phone_1'] = '%' . $bike_m_contact . '%'; 
             }
             
             if(!empty($bike_m_shop)){
                 $where['bike_m_shop'] = '%' . $bike_m_shop . '%'; 
             }
             if(!empty($bike_m_location)){
                 $where['bike_m_location'] = '%' . $bike_m_location . '%'; 
             }
             if(!empty($bike_m_description)){
                 $where['bike_m_description'] = '%' . $bike_m_description . '%'; 
             }
             
         }
         $count = BikeMechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = BikeMechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['bike_m_name'],
                    $c['bike_m_f_name'],
                    $c['bike_m_phone_1'],
                    $c['bike_m_shop'],
                    $c['bike_m_location'],
                    $c['bike_m_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../bike_mechanic/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_bike_mechanic(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
