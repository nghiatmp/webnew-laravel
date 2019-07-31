<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;

class AjaxController extends Controller
{
    public function getLoaiTin($idtheloai){
    	$loaitin = LoaiTin::where('idtheloai',$idtheloai)->get();
    	foreach($loaitin as $lt){
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}
    }
}
?>
