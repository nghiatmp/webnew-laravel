<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
	//list
    public function getList(){
    	$slide=Slide::all();
    	return view('admin/slide/list',['slide'=>$slide]);
    }
    //add
    public function getAdd(){
    	return view('admin/slide/add');
    }
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'name' => 'required|min:3|max:100|unique:slide,Ten',
    			'content' =>'required|min:3|max:100',
    			'link'=>'required'
    		],
    		[
    			'name.required'=>'Bạn chưa nhập tiêu đề',
    			'name.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'name.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'content.required'=>'Bạn chưa nhập nội dung',
    			'content.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'content.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
    			'name.required'=>'Bạn chưa nhập link',

    		]);
    		$slide=new Slide;
    		$slide->Ten = $request->name;
    		$slide->NoiDung = $request->content;
    		if($request->has('link')){
    			$slide->link = $request->link;
    		}
    		if($request->hasFile('image')){
    			$file =$request->file('image');
    			$duoi = $file->getClientOriginalExtension();
    			if($duoi !='jpg' && $duoi !='png'){
    				return redirect('admin/slide/add')->with('loi','File hình ảnh phải có đuôi jpg hoặc png');
    				}
    			$name = $file->getClientOriginalName();
    			$hinh = str_random(4)."_".$name;
    			while (file_exists("upload/slide".$hinh)) {
    				$hinh = str_random(4)."_".$name;
    			}
    			$file->move('upload/slide',$hinh);
    			$slide->Hinh=$hinh;

    		}
    		$slide->save();
    		return redirect('admin/slide/add')->with('thongbao','Bạn đã thêm slide thành công');


    		//delete



    }

    //delete
    public function getDelete($id){
    	$slide = Slide::find($id);
    	$slide ->delete();

    	return redirect('admin/slide/list')->with('thongbao','Bạn đã xóa slide thành công');
    }
    //Edit

    public function getEdit($id){
    	$slide = Slide::find($id);
    	return view('admin/slide/edit',['slide'=>$slide]);
    }
    public function postEdit(Request $request,$id){
    	$slide = Slide::find($id);
    	$this->validate($request,
    		[
    			'name'=>'required|min:3|max:100|unique:slide,Ten,'.$id,
    			'content'=>'required',
    			'link'=>'required',
    		],
    		[
    			'name.required'=>'Bạn chưa nhập tên slide',
    			'name.unique'=>'Tên đã tồn tại',
    			'name.min'=>'Tên slide phải có độ dài từ 3 đến 100 ký tự',
    			'name.max'=>'Tên slide phải có độ dài từ 3 đến 100 ký tự',
    			'content.required'=>'Bạn chưa nhập nội dung',
    			'link.required'=>'Bạn chưa nhập link',
    		]);

    			$slide->Ten = $request->name;
    			$slide->NoiDung = $request->content;
    			$slide->link = $request->link;

    		if($request->hasFile('image')){
    			$file = $request->file('image');
    			$duoi = $file->getClientOriginalExtension();
    			if($duoi !='jpg' && $duoi !='png'){
    				return redirect('admin/slide/add')->with('loi','File hình ảnh phải có đuôi jpg hoặc png');
    				}
    			$name = $file->getClientOriginalName();
    			$hinh = str_random(4)."_".$name;
    			while (file_exists('upload/slide'.$hinh)) {
    				$hinh = str_random(4)."_".$name;
    			}
    			$file->move('upload/slide',$hinh);
    			if($slide->Hinh){
    				unlink('upload/slide/'.$slide->Hinh);
    			}
    			$slide->Hinh = $hinh;
    		}

    		$slide->save();

    		return redirect('admin/slide/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
}
