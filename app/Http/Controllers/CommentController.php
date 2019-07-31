<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function getDelete($id,$idTinTuc){
    	$comment = Comment::find($id);

    	$comment->delete(); 

    	return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao2','Bạn đã xóa comment');
    }
}
