@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa Tin
                            {{-- <small>{{$tintuc->id}}</small> --}}
                        </h1>
                    </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}.<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class=" alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    @if(session('loi'))
                        <div class=" alert alert-success">
                            {{session('loi')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/tintuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="cate" id="theloai">
                                    @foreach($theloai as $tl)
                                        <option
                                         @if($tintuc->loaitin->theloai->id == $tl->id)
                                                {{'selected'}}
                                            @endif 
                                         value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="type" id="loaitin">
                                    @foreach($loaitin as $lt)
                                        <option
                                            @if($tintuc->idLoaiTin == $lt->id)
                                                {{'selected'}}
                                            @endif 
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="name" placeholder="Nhập tiêu đề
                                "  value="{{$tintuc->TieuDe}}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea  name="tomtat" class="form-control" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <p>
                                    <img width="300px" src="{{asset('upload/tintuc/'.$tintuc->Hinh)}}">
                                </p>                       
                                <input type="file" class="form-control" name="image" />
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea  name="content" id="demo" class="form-control ckeditor" rows="3">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" 
                                    @if($tintuc->NoiBat == 0)
                                        {{'checked'}}
                                    @endif
                                     type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat"
                                     @if($tintuc->NoiBat == 1)
                                        {{'checked'}}
                                    @endif
                                     value="1" type="radio">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa Tin</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                            {{ csrf_field() }}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment
                        </h1>
                    </div>
                     @if(session('thongbao2'))
                        <div class=" alert alert-success">
                            {{session('thongbao2')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/delete/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection