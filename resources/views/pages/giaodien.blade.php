@extends('layout.index')

@section('content')
	    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	@if(count($errors) > 0 )
				  		<div class=" alert alert-danger">
				  			@foreach( $errors->all() as $err)
				  			      {{$err}}<br>
				  			@endforeach
				  		</div>
				  	@endif
				  	 @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
				  	<div class="panel-body">
				    	<form action="giaodien" method="POST">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$user->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
							  	disabled value="{{$user->email}}" 
							  	>
							</div>
							<br>	
							<div class="form-group">
                                <input type="checkbox" name="check" id="check">
                                <label>Đổi Mật Khẩu</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu" disabled />
                            </div>
                           <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" name="passAgain" id="passAgain" placeholder="Nhập mật khẩu" disabled />
                            </div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>
							{{ csrf_field() }}

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection


@section('script')
    <script  type="text/javascript">
        $(document).ready(function(){
            $('#check').change(function(){
                if($('#check').is(":checked")){
                    $("#pass").removeAttr('disabled');
                    $("#passAgain").removeAttr('disabled');
                }else{
                    $("#pass").attr('disabled','');
                    $("#passAgain").attr('disabled','');
                }
            });
        });
    </script>

@endsection