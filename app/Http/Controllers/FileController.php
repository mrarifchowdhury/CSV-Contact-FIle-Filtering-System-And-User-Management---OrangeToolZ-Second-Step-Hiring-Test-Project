<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Group;
use App\Models\FileDtls;
use Validator;
use Session;
use Hash;
use Auth;
use DB; 

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['FileData'] =  File::select('*')
                                        ->orderBy('created_at', 'desc')
                                        ->get();  
        $data['GroupData'] =  Group::select('*')
                                        ->orderBy('created_at', 'desc')
                                        ->get(); 
        return view('files.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('files.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {   
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);
                $DataArr = $filterData = [];
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    $singleData = [
                        'number' => is_numeric($line[0])?$line[0]*1:$line[0],
                        'first_name' => $line[1],
                        'last_name' => $line[2],
                        'email' => $line[3],
                        'state' => $line[4],
                        'zip' => $line[5]
                    ];
                    $DataArr[] = $singleData;
                    if(is_numeric($line[0])){
                        $filterData[] = $singleData;
                    }
                    
                }
                // Close opened CSV file
                fclose($csvFile);
                $chunkedArr = array_chunk($filterData,100);

                $FileArr['file_name'] = $request->name;
                $FileArr['original_name'] = $_FILES['file']['name'];
                $FileArr['total_uploaded'] = count($DataArr);
                $FileArr['total_process'] = count($filterData);
                $FileArr['user_id'] = Auth::user()->id;
                $fileSaved = File::create($FileArr);

                $i = 0;
                foreach ($chunkedArr as $key => $value) {
                    ++$i;
                    $groupArr['file_id'] = $fileSaved->id;
                    $groupArr['group_name'] = "Group ".$i;
                    $groupSaved = Group::create($groupArr);

                    foreach ($value as $index => $saveDataArr) {
                        // code...
                        $saveDataArr['file_id'] = $fileSaved->id;
                        $saveDataArr['group_id'] = $groupSaved->id;
                        FileDtls::create($saveDataArr);
                    }
                }
                // echo "<pre>";
                // print_r($chunkedArr);
                // die('Success');
            }else{
                die('Invalid File');
            }
        }else{
            die("Invalid File");
        }


        Session::flash('flash_message','Data Successfully Saved !');
        return redirect('add-file')->with('status_color','success');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data=User::findOrFail($id);
        $input=$request->all();
        $validator = Validator::make($input, [
                    'name' => 'required',
                    'email' => 'required',
                    'status' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        try{
            $bug=0;
            $data->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'status' => $input['status'],
            ]);
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','User Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    



public function eachGroupDetails($id)
    {
        

        $data['GroupData'] = Group::where('files.id', '=', $id)
                            ->join('files', 'groups.file_id', 'files.id')
                            ->select('groups.*')
                            ->orderBy('groups.id', 'asc')
                            ->get();

        $data['FileDetails'] =  FileDtls::where('file_id', '=', $id)
                                        ->select('*')
                                        ->orderBy('created_at', 'desc')
                                        ->get();  


        // return response()->json($data['FileDetails']);
        return view('files.eachFileGroupDetails',$data);
    }




    public function destroy($id)
    {
         $data = User::findOrFail($id);
        
        try{
          $bug=0;
          $action = $data->delete();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }
        else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
