@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	@if(count($errors) > 0 )
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
				  	<div class="panel-body">
				    	<form action="login" method="POST">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="pass">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
							{{ csrf_field() }}
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection