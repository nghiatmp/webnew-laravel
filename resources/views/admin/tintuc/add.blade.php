
@extends('admin.layout.index')

@section('content')

 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
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
                        <form action="admin/tintuc/add" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="cate" id="theloai">
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="type" id="loaitin">
                                    @foreach($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="name" placeholder="Nhập tiêu đề
                                " />
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea  name="tomtat" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Anh</label>
                                <input type="file" class="form-control" name="image"/>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea  name="content" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="1" type="radio">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm Tin</button>
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

@section('script')
<script>
    $(document).ready(function(){
        $('#theloai').change(function(){
            var idtheloai = $(this).val();
            $.get("admin/ajax/loaitin/"+idtheloai,function(data){
                $('#loaitin').html(data);
            });
        });
    });
</script>
@endsection