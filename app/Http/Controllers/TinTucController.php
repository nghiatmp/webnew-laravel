<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;


class TinTucController extends Controller
{
	//list
   public function getList(){
   		$tintuc = TinTuc::orderBy('id','desc')->get();
    	return  view('admin/tintuc/list',['tintuc'=>$tintuc]);
   }
   //add
   public function getAdd(){
   		$theloai = TheLoai::all();
   		$loaitin = LoaiTin::all();
   	 	return view('admin/tintuc/add',['theloai'=>$theloai,'loaitin'=>$loaitin]);
   }
   public function postAdd(Request $request){
   	$this->validate($request,
   		[
   			'type'=>'required',
   			'name'=>'required|min:3|max:100|unique:tintuc,Tieude',
   			'tomtat'=>'required',
   			'content'=>'required',
   		],
   		[
   			'type.required'=>'Bạn chưa chọn loại tin',
   			'name.required'=>'Bạn chưa đặt tiêu đề',
   			'name.min'=>'Tiêu đề phải có độ dài từ 3 đến 100 ký tự',
    		'name.max'=>'Tiêu đề phải có độ dài từ 3 đến 100 ký tự',
    		'name.unique'=>'Tiêu đề đã tồn tại',
    		'tomtat.required'=>'Bạn chưa nhập tóm tắt',
    		'content.required'=>'Bạn chưa nhập nội dung',
   		]);

   		$tintuc =  new TinTuc;
   		$tintuc->TieuDe = $request->name;
   		$tintuc->TieuDeKhongDau = str_slug($request->name,'-');
   		$tintuc->TomTat = $request->tomtat;
   		$tintuc->NoiDung = $request->content;
   		$tintuc->SoLuotXem= 0;
   		$tintuc->idLoaiTin=$request->type;

   		if($request->hasFile('image')){
   			$file =$request->file('image');
   			$duoi = $file->getClientOriginalExtension();
   			if($duoi != 'jpg' && $duoi !='png'){
   				return redirect('admin/tintuc/add')->with('loi','File hình ảnh phải có đuôi jpg hoặc png');
   			}
   			$name = $file->getClientOriginalName();
   			$Hinh = str_random(4)."_".$name;
   			while (file_exists('upload/tintuc'.$Hinh)) {
   				$Hinh = str_random(4)."_".$name;
   			}
   			$file->move('upload/tintuc',$Hinh);
   			$tintuc->Hinh=$Hinh;
   		}else{
   			$tintuc->Hinh = "";
   		}


   		$tintuc->save();

   		return redirect('admin/tintuc/add')->with('thongbao','Bạn đã thêm thành công');

   }
   //edit
   public function getEdit($id){
   		$theloai= TheLoai::all();
   		$loaitin=LoaiTin::all();
   		$tintuc= tintuc::find($id);
   		return view('admin/tintuc/edit',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
   }
   public function postEdit(Request $request,$id){
   		$tintuc = TinTuc::find($id);
   		$this->validate($request,
   		[
   			'type'=>'required',
   			'name'=>'required|min:3|max:100|unique:tintuc,Tieude,'.$id,
   			'tomtat'=>'required',
   			'content'=>'required',
   		],
   		[
   			'type.required'=>'Bạn chưa chọn loại tin',
   			'name.required'=>'Bạn chưa đặt tiêu đề',
   			'name.min'=>'Tiêu đề phải có độ dài từ 3 đến 100 ký tự',
    		'name.max'=>'Tiêu đề phải có độ dài từ 3 đến 100 ký tự',
    		'name.unique'=>'Tiêu đề đã tồn tại',
    		'tomtat.required'=>'Bạn chưa nhập tóm tắt',
    		'content.required'=>'Bạn chưa nhập nội dung',
   		]);
   		$tintuc->TieuDe = $request->name;
   		$tintuc->TieuDeKhongDau = str_slug($request->name,'-');
   		$tintuc->TomTat = $request->tomtat;
   		$tintuc->NoiDung = $request->content;
   		$tintuc->idLoaiTin=$request->type;
   		if($request->hasFile('image')){
   			$file =$request->file('image');
   			$duoi = $file->getClientOriginalExtension();
   			if($duoi != 'jpg' && $duoi !='png'){
   				return redirect('admin/tintuc/edit')->with('loi','File hình ảnh phải có đuôi jpg hoặc png');
   			}
   			$name = $file->getClientOriginalName();
   			$Hinh = str_random(4)."_".$name;
   			while (file_exists('upload/tintuc'.$Hinh)) {
   				$Hinh = str_random(4)."_".$name;
   			}
   			$file->move('upload/tintuc',$Hinh);
   			if($tintuc->Hinh){
  				unlink("upload/tintuc/".$tintuc->Hinh);
			}
   			$tintuc->Hinh=$Hinh;
 
   		}

   		$tintuc->save();

   		return redirect('admin/tintuc/edit/'.$id)->with('thongbao','Bạn đã sua thành công');


   }
   //delete
   public function getDelete($id){
      $tintuc = TinTuc::find($id);

      $tintuc->delete();
      return redirect('admin/tintuc/list')->with('thongbao','Bạn đã xóa thành công');
   }
}
