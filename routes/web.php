<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;


Route::get('/', function () {
    return view('welcome');
});
Route::get('thu',function(){
	$theloai = TheLoai::find(1);
	foreach($theloai ->loaitin as $loaitin) {
		echo $loaitin->Ten."<br/>";
	}
});
Route::get('test',function(){
	return view('admin.login');
});

//Route: dang nhap
Route::get('admin/login','UserController@getLogin');
Route::post('admin/login','UserController@postLogin');
Route::get('admin/logout','UserController@getLogout');

Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		//list
		Route::get('list','TheLoaiController@getList');
		//edit
		Route::get('edit/{id}','TheLoaiController@getEdit');
		Route::post('edit/{id}','TheLoaiController@postEdit');
		//add
		Route::get('add','TheLoaiController@getAdd');
		Route::post('add','TheLoaiController@postAdd');
		//delete
		Route::get('delete/{id}','TheLoaiController@getDelete');
	});
	Route::group(['prefix'=>'loaitin'],function(){
		//list
		Route::get('list','LoaiTinController@getList');
		//edit
		Route::get('edit/{id}','LoaiTinController@getEdit');
		Route::post('edit/{id}','LoaiTinController@postEdit');
		//add
		Route::get('add','LoaiTinController@getAdd');
		Route::post('add','LoaiTinController@postAdd');
		//delete
		Route::get('delete/{id}','LoaiTinController@getDelete');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		//list
		Route::get('list','TinTucController@getList');
		//edit

		Route::get('edit/{id}','TinTucController@getEdit');
		Route::post('edit/{id}','TinTucController@postEdit');

		//add
		Route::get('add','TintucController@getAdd');
		Route::post('add','TinTucController@postAdd');

		//delete
		Route::get('delete/{id}','TinTucController@getDelete');
	});
	Route::group(['prefix'=>'user'],function(){
		//list
		Route::get('list','UserController@getList');
		//edit
		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');
		//add
		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');
		//delete
		Route::get('delete/{id}','UserController@getDelete');
	});
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idtheloai}','AjaxController@getLoaiTin');
	});
	Route::group(['prefix'=>'comment'],function(){
		Route::get('delete/{id}/{idTinTuc}','CommentController@getDelete');
	});
	Route::group(['prefix'=>'slide'],function(){
		//list
		Route::get('list','SlideController@getList');
		//add
		Route::get('add','SlideController@getAdd');
		Route::post('add','SlideController@postAdd');


		Route::get('edit/{id}','SlideController@getEdit');
		Route::post('edit/{id}','SlideController@postEdit');
		//delete
		Route::get('delete/{id}','SlideController@getDelete');
	});

});

Route::get("trangchu","PageController@trangchu");
Route::get("lienhe","PageController@lienhe");
Route::get("loaitin/{id}/{TenKhongDau}.html","PageController@loaitin");
Route::get('tintuc/{id}/{TenKhongDau}.html',"PageController@tintuc");

//login nguoi dung
Route::get("login","PageController@getLogin");
Route::post("login","PageController@postLogin");
//dang xuat
Route::get("dangxuat",'PageController@getdangxuat');
Route::post("comment/{idTinTuc}",'PageController@postcomment');


//giao dien nguoi dung

Route::get('giaodien/{id}','UserController@getGiaoDien');
Route::post('giaodien','UserController@postGiaoDien');

//dang ki nguoi dung

Route::get('dangki','UserController@getDangki');
Route::post('dangki','UserController@postDangki');


//Tim kiem
Route::get('timkiem','PageController@timkiem');