@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{{$tintuc->TomTat}}</p>
                <p>{{$tintuc->NoiDung}}</p>
                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
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
                @if(Auth::check())
                     <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="comment/{{$tintuc->id}}" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="text"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                        {{ csrf_field() }}
                    </form>
                </div>
                @endif

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
               
                @foreach($tintuc->comment as $cm)

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        
                        </h4>
                       {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach

           

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
					@foreach($tinlienquan as $ttlq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$ttlq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$ttlq->id}}/{{$ttlq->TieuDeKhongDau}}.html"><b>{{$ttlq->TieuDe}}</b></a>
                            </div>
                            {{-- <p>{{$ttlq->TomTat}}</p> --}}
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                       @endforeach
                    </div>
                  
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
						@foreach($tinnoibat as $tnb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> --}}
                            <div class="break"></div>
                        </div>

                        <!-- end item -->
                        @endforeach       
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection