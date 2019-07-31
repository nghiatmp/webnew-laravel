<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
	//list
    public function getList(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list',['loaitin'=>$loaitin]);
    }
    //add
    public function getAdd(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.add',['theloai1'=>$theloai]);

    }
    public function postAdd(Request $request){
    	$this->validate($request,
    	[
    		'Name' => 'required|min:3|max:100|unique:loaitin,Ten',
    		'cate' =>'required',
    	],
    	[
    		'Name.required'=>'Bạn chưa nhập tên Loại Tin',
    		'Name.unique' =>'Loại tin đã tồn tại',
    		'Name.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    		'Name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    		'cate.required'=>'Bạn chưa chọn Thể Loại'
    	]);
    	$loaitin =  new LoaiTin();
    	$loaitin->Ten = $request->Name;
    	$loaitin->TenKhongDau = str_slug($request->Name,'-');
    	$loaitin->idTheLoai = $request->cate;

    	$loaitin->save();

    	return redirect('admin/loaitin/add')->with('thongbao','Bạn đã thêm thành công');
 		
    }
    //delete
    public function getDelete($id){
    	$loaitin = LoaiTin::find($id);
    	$loaitin->tintuc()->delete();
        $loaitin->delete();
    	return redirect('admin/loaitin/list')->with('thongbao','Bạn đã xóa thành công');

    }

    //edit
    public function getEdit($id){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin/loaitin/edit',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postEdit(Request $request,$id){
    	$loaitin = LoaiTin::find($id);
    	$this->validate($request,
    		[
    			'name'=>'required|min:3|max:150|unique:loaitin,Ten,'.$id,
    			'cate'=>'required',
    		],
    		[
    			'name.required'=>'Bạn chưa nhập Tên Loại Tin',
    			'name.unique'=>'Loại Tin đã tồn tại',
    			'name.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'cate.required'=>'Bạn chưa nhập Tên Thể Loại ',
    		]);
    	$loaitin->Ten = $request->name;
    	$loaitin->TenKhongDau = str_slug($request->name,'-');
    	$loaitin->idTheLoai = $request->cate;

    	$loaitin->save();
    	return redirect('admin/loaitin/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
}
