<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class AddressController extends Controller
{
    public function getProvinces(){
        return Province::get();
    }

    public function getDistricts(Request $request) {
        $city = Province::find($request->city_id);
        $districts = $city->districts;
        return response()->json($districts);
    }

    public function getWards(Request $request) {
        $city = Province::find($request->city_id);
        $wards = $city->wards;
        return response()->json($wards);
    }

    public function getWardsInDistrict(Request $request){
        $district = District::find($request->district_id);
        $wards = $district->wards;
        return response()->json($wards);        
    }
}
