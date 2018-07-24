<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\GasMechanics;
use Redirect;

class Gas_MechanicController extends Controller
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
        return view('admin.gas_mechanic.add');
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
            'gas_m_name' => 'required',
            'gas_m_phone_1' => 'required',
            'gas_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['created_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
            
           GasMechanics::create($data);
          return redirect('admin/gas_mechanic/show')->with(['message'=>'Gas Mechanic Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('admin.gas_mechanic.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gas_mechanic = GasMechanics::find($id);
        $edit = true;
        return view('admin.gas_mechanic.add',compact('gas_mechanic','edit'));
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
            'gas_m_name' => 'required',
            'gas_m_phone_1' => 'required',
            'gas_m_location' => 'required',
        ]);
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            unset($data['_token']);
            unset($data['save']);
        $gas_mechanic = GasMechanics::find($id);
        $gas_mechanic->update($data);
        $gas_mechanic->save();

        return redirect('admin/gas_mechanic/show')->with(['message'=>'Gas Mechanic Updated successfully']);
        
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
      GasMechanics::destroy($ids);
      \Session::flash('message', 'Gas Mechanic Deleted Successfully');
       exit();
    }
    public function get_gas_mechanic_data(Request $request){
       $where =array();
       $data =array();
       $offset = $request->start;
        if (trim($offset) == "") {
            $offset = 1;
        }
       $colmnsArry = array('', '', 'gas_m_name', 'gas_m_f_name','gas_m_phone_1','gas_m_shop','gas_m_location','gas_m_description');
        if ($request->order) {
            $order = $request->order;
            if (isset($order[0]['column'])) {
                $fieldName = $colmnsArry[$order[0]['column']];
                $orderType = $order[0]['dir'];
                $order_by = $colmnsArry[$order[0]['column']] . "," . $order[0]['dir'];
            }
        }
         if ($request->action == 'filter') {
             $name =$request->gas_m_name;
             $gas_m_father =$request->gas_m_father;
             $gas_m_contact =$request->gas_m_contact;
             $gas_m_shop =$request->gas_m_shop;
             $gas_m_location =$request->gas_m_location;
             $gas_m_description =$request->gas_m_description;
             if(!empty($name)){
                 $where['gas_m_name'] = '%' . $name . '%'; 
             }
             if(!empty($gas_m_father)){
                 $where['gas_m_f_name'] = '%' . $gas_m_father . '%'; 
             }
             if(!empty($gas_m_contact)){
                 $where['gas_m_phone_1'] = '%' . $gas_m_contact . '%'; 
             }
             
             if(!empty($gas_m_shop)){
                 $where['gas_m_shop'] = '%' . $gas_m_shop . '%'; 
             }
             if(!empty($gas_m_location)){
                 $where['gas_m_location'] = '%' . $gas_m_location . '%'; 
             }
             if(!empty($gas_m_description)){
                 $where['gas_m_description'] = '%' . $gas_m_description . '%'; 
             }
             
         }
         $count = GasMechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->count();
         $pageLimit = (($request->length) < 0) ? $count : $request->length;
         $results = GasMechanics::where(function($q) use ($where){
            foreach($where as $key => $value){
                $q->where($key, 'LIKE', $value);
            }
        })->orderBy($fieldName,$orderType)->skip($offset)->take($pageLimit)->get();
         $n = 1;
            foreach ($results as $c) {
                 $data[] = [
                    '<input type="checkbox" name="id[]" class="checkboxes2" value="' . $c['id'] . '">',
                    $n,
                    $c['gas_m_name'],
                    $c['gas_m_f_name'],
                    $c['gas_m_phone_1'],
                    $c['gas_m_shop'],
                    $c['gas_m_location'],
                    $c['gas_m_description'],
                    '<div class="a_actions_width"><a class="table_button table_edit_button" href="../gas_mechanic/'. $c['id'] .'/edit"><i class="fa fa-edit"></i></a><button class="table_button table_delete_button" onclick="delete_gas_mechanic(' . $c['id'] . ')"><i class="fa fa-trash"></i></button></div>'
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
