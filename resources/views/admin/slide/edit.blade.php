@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Slide
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
                        <form action="admin/slide/edit/{{$slide->id}}" method="POST" enctype="multipart/form-data">
            
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="name" placeholder="Nhập tên slide
                                 " value="{{$slide->Ten}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình Anh</label>
                                <p>
                                    <img width="100px" src="{{asset('upload/slide/'.$slide->Hinh)}}">
                                </p>
                                <input type="file" class="form-control" name="image"/>
                            </div>   
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea  name="content" class="form-control" rows="3">
                                    {{$slide->NoiDung}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Nhập link
                                "  value="{{$slide->link}}" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Edit Slide</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                            {{ csrf_field() }}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection