<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getList(){
    	$theloai = TheLoai::orderBy('id','desc')->get();
    	return view('admin.theloai.list',['theloai'=>$theloai]);
    }
    public function getEdit($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.edit',['theloai'=>$theloai]);
    }
    public function postEdit(Request $request,$id){
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    	[
    		'Name'=> 'required|unique:theloai,Ten|min:3|max:100 '
    	],
    	[
    		'Name.required'=>'Bạn chưa nhập tên thể loại',
    		'Name.unique'=>'Tên thể loại đã tồi tại',
    		'Name.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    		'Name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    	]);

    	$theloai->Ten = $request->Name;
    	$theloai->TenKhongDau = str_slug($request->Name,'-');
    	$theloai->save();

    	 return redirect('admin/theloai/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');

    }



    public function getAdd(){
    	return view('admin.theloai.add');
    }
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'Name'=> 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Name.required'=>'Bạn chưa nhập tên thể loại',
    			'Name.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'Name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'Name.unique'=>'Tên thể loại đã tồi tại',
    		]);
    	$theloai =  new TheLoai;
    	$theloai->Ten = $request->Name;
    	$theloai->TenKhongDau = str_slug($request->Name,'-');
    	$theloai->save();

    	return redirect('admin/theloai/add')->with('thongbao','Thêm Thành Công');

    }


    public function getDelete($id){
    	$theloai = TheLoai::find($id);
        
        $theloai->loaitin()->delete();
        $theloai->tintuc()->delete();
  		$theloai->delete();

  		return redirect('admin/theloai/list')->with('thongbao','Bạn đã xóa thành công');
    }
}
