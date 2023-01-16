<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Debugbar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    //Create Info
    public function createinfo(Request $request)
    {
        logger($request->all());

        if (
            $request->petname === null ||
            $request->pawrent === null ||
            $request->gender === null ||
            $request->contact === null ||
            $request->city === null ||
            $request->status === null ||
            $request->breed === null ||
            $request->time === null ||
            $request->address === null ||
            $request->township === null
        ) {
            $data = [
                'petname' => 'This field is required',
                'pawrent' => 'This field is required',
                'gender' => 'This field is required',
                'contact' => 'This field is required',
                'city' => 'This field is required',
                'status' => 'This field is required',
                'breed' => 'This field is required',
                'time' => 'This field is required',
                'address' => 'This field is required',
                'township' => 'This field is required',
            ];
            return response()->json([
                'data' => $data,
                'type' => 'fail',
            ]);
        } else {
            $item = Info::all()->last();
            $data =  $this->getdata($request);
            Info::create($data);
            return response()->json([
                'data' => $item,
                'type' => 'success',
            ]);
        }
    }

    //Sent data to Client Side
    public function sentdata()
    {
        $data = Info::paginate(8);
       return response()->json([
        'data' => $data,
        'type' => 'success',
     ]);
    }

    //Update data
    public function updatedata(Request $request){
        $data = Info::where('id',$request->id)->get();
        return response()->json([
            'data' => $data,
            'type' => 'success',
        ]);
    }

    //Update Final Data
    public function updatefinal(Request $request){
       Info::where('id_code',$request->id_code)->update([
            'id_code' => $request->id_code,
            'petname' => $request->petname,
            'pawrent' => $request->pawrent,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'city' => $request->city,
            'status' => $request->status,
            'breed' => $request->breed,
            'date' => $request->time,
            'address' => $request->address,
            'township' => $request->township,
       ]);
       $data =Info::where('id_code',$request->id_code)->get();
       return response()->json([
        'data' => $data,
        'type'=>'success',
       ]);
    }


    //Delete item
    public function deleteitem(Request $request){
        Info::where('id',$request->id)->delete();
        return response()->json([
            'type' => 'success',
        ]);
    }

    //Search Key
    public function searchkey(Request $request){
       $data = Info::orwhere('id_code','LIKE','%'.$request->key.'%')
            ->orwhere('petname', 'LIKE', '%' . $request->key . '%')
            ->orwhere('pawrent', 'LIKE', '%' . $request->key . '%')
            ->orwhere('contact', 'LIKE', '%' . $request->key . '%')
            ->orwhere('address', 'LIKE', '%' . $request->key . '%')
            ->get();
            return response()->json([
                'data' => $data,
                'type' => 'success',
            ]);
    }

    //Get data from CLient
    private function getdata($request)
    {
        $str = strtoupper(Str::random(1));
        $randomId = (string)rand(5, 50000);
        $idcode = $str . "-" . $randomId;
        return [
            'id_code' => $idcode,
            'petname' => $request->petname,
            'pawrent' => $request->pawrent,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'city' => $request->city,
            'status' => $request->status,
            'breed' => $request->breed,
            'date' => $request->time,
            'address' => $request->address,
            'township' => $request->township,
        ];
    }

    
}