<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Car_Mechanics;
use Redirect;

class Car_MechanicController extends Controller
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
        return view('admin.car_mechanic.add');
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
            'car_m_name' => 'required',
            'car_m_phone_1' => 'required',
            'car_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           Car_Mechanics::create($data);
          return redirect('admin/car_mechanic/show')->with(['message'=>'Car Mechanic Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.car_mechanic.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_mechanic = Car_Mechanics::find($id);
        $edit = true;
        return view('admin.car_mechanic.add',compact('car_mechanic','edit'));
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
            'car_m_name' => 'required',
            'car_m_phone_1' => 'required',
            'car_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $car_mechanic = Car_Mechanics::find($id);
        $car_mechanic->update($data);
        $car_mechanic->save();

        return redirect('admin/car_mechanic/show')->with(['message'=>'Car Mechanic Updated successfully']);
        
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
      Car_Mechanics::destroy($ids);
      \Session::flash('message', 'Car Mechanic Deleted Successfully');
       exit();
    }
    public function get_car_mechanic_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'car_m_name', 'car_m_f_name','car_m_phone_1','car_m_shop','car_m_location','car_m_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->car_m_name;
             $car_m_father =$request->car_m_father;
             $car_m_contact =$request->car_m_contact;
             $car_m_shop =$request->car_m_shop;
             $car_m_location =$request->car_m_location;
             $car_m_description =$request->car_m_description;
             if(!empty($name)){
                 $where['car_m_name'] = '%' . $name . '%'; 
             }
             if(!empty($car_m_father)){
                 $where['car_m_f_name'] = '%' . $car_m_father . '%'; 
             }
             if(!empty($car_m_contact)){
                 $where['car_m_phone_1'] = '%' . $car_m_contact . '%'; 
             }
             
             if(!empty($car_m_shop)){
                 $where['car_m_shop'] = '%' . $car_m_shop . '%'; 
             }
             if(!empty($car_m_location)){
                 $where['car_m_location'] = '%' . $car_m_location . '%'; 
             }
             if(!empty($car_m_description)){
                 $where['car_m_description'] = '%' . $car_m_description . '%'; 
             }
             
         }
         $count = Car_Mechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = Car_Mechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['car_m_name'],
                    $c['car_m_f_name'],
                    $c['car_m_phone_1'],
                    $c['car_m_shop'],
                    $c['car_m_location'],
                    $c['car_m_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../car_mechanic/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_car_mechanic(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
