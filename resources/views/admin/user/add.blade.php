
@extends('admin.layout.index')

@section('content')

 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm Người Dùng
                        </h1>
                    </div>
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                   {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/add" method="POST">
                            <div class="form-group">
                                <label>Họ Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập Họ Tên" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Email" />
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" name="pass" placeholder="Nhập mật khẩu" />
                            </div>
                           <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" name="passAgain" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Phân Quyền</label>
                               
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio" checked="">Thành Viên
                                </label>
                                 <label class="radio-inline">
                                    <input name="quyen" value="1"  type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm Người Dùng</button>
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