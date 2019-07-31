<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
	//list
    public function getList(){
    	 //$user = User::orderBy('quyen','desc')->get();
    	$user =User::where('id','>',0)->orderBy('quyen','desc')->get();
    	return view('admin/user/list',['user'=>$user]);
    }
    //add
    public function getAdd(){
    	return view('admin/user/add');
    }
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'required|min:3|max:100',
    			'email'=>'required|email|unique:users,email',
    			'pass'=>'required|min:3|max:31',
    			'passAgain'=>'required|same:pass',

    		],
    		[
    			'name.required'=>'Bạn chưa nhập họ tên',
    			'name.min'=>'Họ tên phải có độ dài từ 3 đến 100 ký tự',
    			'name.max'=>'Họ Tên phải có độ dài từ 3 đến 100 ký tự',
    			'email.required'=>'Bạn chưa nhập email',
    			'email.email'=>'Bạn chưa nhập đúng định dạng emal',
    			'email.unique'=>'Email đã tồn tại',
    			'pass.required'=>'Bạn chưa nhập mật khẩu',
    			'pass.min'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
    			'pass.max'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
    			'passAgain.required'=>'Bạn chưa nhập lại mật khẩu',
    			'passAgain.same'=>'Mật khẩu nhập lại chưa đúng',
    		]);

    		$user = new User;
    		$user->name = $request->name;
    		$user->email = $request->email;
    		$user->quyen = $request->quyen;
    		$user->password = bcrypt($request->pass); 

    		$user->save();

    		return redirect('admin/user/add')->with('thongbao','Bạn đã thêm thành công');
    }
    //edit
    public function getEdit($id){
        $user = User::find($id);
        return view('admin/user/edit',['user'=>$user]);
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            [
                'name'=>'required|min:3|max:100',
            ],
            [
                'name.required'=>'Bạn chưa nhập họ tên',
                'name.min'=>'Họ tên phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Họ Tên phải có độ dài từ 3 đến 100 ký tự',   
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->quyen =$request->quyen;
            if($request->check == 'on'){
                $this->validate($request,
                    [
                        'pass'=>'required|min:3|max:31',
                        'passAgain'=>'required|same:pass',
                    ],
                    [
                        'pass.required'=>'Bạn chưa nhập mật khẩu',
                        'pass.min'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                        'pass.max'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                        'passAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                        'passAgain.same'=>'Mật khẩu nhập lại chưa đúng',
                    ]);
                $user->password = bcrypt($request->pass);
            }
            $user->save();

            return redirect('admin/user/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    public function getDelete($id){
        $user=User::find($id);
        $user->comment()->delete();
        $user->delete();

        return redirect('admin/user/list')->with('thongbao','Bạn đã xóa thành công');
    }
    //loggin
    public function getLogin(){
        return view('admin/login');
    }
    public function postLogin(Request $request){
        $this->validate($request,
            [
                'email'=>'required',
                'pass'=>'required|min:3|max:31',
            ],
            [
                'email.required'=>"Bạn chưa nhập email",
                'pass.required'=>"Bạn chưa nhập mật khẩu",
                'pass.min'=>'Mật khẩu phải dài ít nhất 3 kí tự',
                'pass.max'=>"Mật khaari dài nhất 32 kí tự",
            ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->pass])){
            return redirect('admin/theloai/list');
        }else{
            return redirect('admin/login')->with('thongbao','Đăng nhập thất bại tài khoản hoặc mật khẩu chưa đúng');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }

    ////giao dien nguoi dung
    public function getGiaoDien($id){
        if(Auth::check()){
              $user = User::find($id);
            return view('pages.giaodien',['user'=>$user]);
        }else{
            return redirect('login');
        }
      
    }
    public function postGiaoDien(Request $request){
        $this->validate($request, 
            [
                'name'=>'required|min:3|max:100',
            ],
            [
                'name.required'=>'Bạn chưa nhập họ tên',
                'name.min'=>'Họ tên phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Họ Tên phải có độ dài từ 3 đến 100 ký tự', 
            ]);

        $user= Auth::user();
        $user->name = $request->name;

        if($request->check == 'on'){
                $this->validate($request,
                    [
                        'pass'=>'required|min:3|max:31',
                        'passAgain'=>'required|same:pass',
                    ],
                    [
                        'pass.required'=>'Bạn chưa nhập mật khẩu',
                        'pass.min'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                        'pass.max'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                        'passAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                        'passAgain.same'=>'Mật khẩu nhập lại chưa đúng',
                    ]);
                $user->password = bcrypt($request->pass);
        }
        $user->save();
        return redirect('giaodien/'.$user->id)->with('thongbao','Bạn đã sửa thành công');
    }
    //dang ki nguoi dung
    public function getDangki(){
        return view('pages.dangkinguoidung');
    }
    public function postDangki(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3|max:100',
                'email'=>'required|email|unique:users,email',
                'pass'=>'required|min:3|max:31',
                'passAgain'=>'required|same:pass',

            ],
            [
                'name.required'=>'Bạn chưa nhập họ tên',
                'name.min'=>'Họ tên phải có độ dài từ 3 đến 100 ký tự',
                'name.max'=>'Họ Tên phải có độ dài từ 3 đến 100 ký tự',
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Bạn chưa nhập đúng định dạng emal',
                'email.unique'=>'Email đã tồn tại',
                'pass.required'=>'Bạn chưa nhập mật khẩu',
                'pass.min'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                'pass.max'=>'Mật khẩu phải có độ dài từ 3 đến 100 ký tự',
                'passAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passAgain.same'=>'Mật khẩu nhập lại chưa đúng',
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->quyen = 0;
            $user->password = bcrypt($request->pass); 

            $user->save();

            return redirect('dangki')->with('thongbao','Bạn đã thêm thành công');
    }
}
