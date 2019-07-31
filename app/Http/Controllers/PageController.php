<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB; 
 use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
	public function __construct(){
		$theloai = TheLoai::all();
		$slide =Slide::orderBy('id','desc')->take(4)->get();
		$tintuc = TinTuc::all();
		view::share(['theloai'=>$theloai,'slide'=>$slide,'tintuc'=>$tintuc]);
	}
    public function trangchu(){
    	return view('pages.trangchu');
    }
    public function lienhe(){
    	return view('pages.lienhe');
    }
    public function loaitin($id){
    	$loaitin =  LoaiTin::find($id);
    	$tintuc = TinTuc::where("idLoaiTin",$id)->paginate(4);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function tintuc($id){
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    	DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);  
    }
    public function getLogin(){
    	return view('pages.dangnhap');
    }
    public function postLogin(Request $request){
    	$this->validate($request,
            [
                'email'=>'required|min:3|max:50',
                'pass'=>'required|min:3|max:50',
            ],
            [
                'email.required'=>'Bạn chưa nhập email',
                'email.min'=>'Độ dài email từ 3-50 kí tự',
                'email.max'=>'Độ dài email từ 3-50 kí tự',
                'pass.required'=>'Bạn chưa nhập Mật khẩu',
                'pass.min'=>'Độ dài mật khẩu từ 3-50 kí tự',
                'pass.max'=>'Độ dài mật khẩu từ 3-50 kí tự',
                
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->pass])){

            return redirect('trangchu');
        }else
        {
            return redirect('login')->with('thongbao','Đăng nhập thất bại');
        }
    }
    public function getdangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    public function postcomment($idTinTuc,Request $request){
        $idTinTuc= $idTinTuc;
        $tintuc = TinTuc::find($idTinTuc);

        $this->validate($request, 
            [
                'text'=>'min:3|max:100'
            ], 
            [
                'text.min'=>'Bình luận phải dài từ 3 đến 100 kí tự',
                'text.max'=>'Bình luận phải dài từ 3 đến 100 kí tự',
            ]);

        $comment =  new Comment;
        $comment->idUser = Auth::user()->id;
        $comment->idTinTuc = $idTinTuc;
        $comment->NoiDung = $request->text;

        $comment->save();
        return redirect('tintuc/'.$idTinTuc.'/'.$tintuc->TieuDeKhongDau.".html")->with('thongbao','Bạn đã gửi comment thành công');


    }

    public function timkiem(Request $request){
        $tukhoa = $request->timkiem;
        $tintuc = TinTuc::where('TieuDe','like',"% $tukhoa %")->orWhere('NoiDung','like',"% $tukhoa %")->orWhere('TomTat','like',"%$tukhoa%")->take(30)->paginate(4)->appends(['tukhoa'=>$tukhoa]);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

}
