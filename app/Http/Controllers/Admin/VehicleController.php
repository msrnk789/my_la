<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function rand()
    {
        $rand = rand(1000, 9999);
        $unique_id = 'hy'.$rand;
        //return $unique_id;
        $modeldetail = BidMake::where('id','=',6)->first();
        $string = $modeldetail->name;
        $string{0} = strtoupper($string{0});
        $string{1} = strtoupper($string{1});
        //$s = $modeldetail->name; 
        //printf(substr($s, 0,2));
        return substr($string, 0,2).$rand;
        return $modeldetail;
    }}
