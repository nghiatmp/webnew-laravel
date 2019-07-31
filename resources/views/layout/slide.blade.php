<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $i=0; ?>
                        @foreach($slide as $sl)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="
                        @if($i== 0 )
                        {{'active'}}
                        @endif
                        "></li>
                        <?php $i++?>
                         @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($slide as $sl)
                        <div class="
                        @if($sl->id ==4) 
                            {{'item active'}}
                        @else 
                            {{'item'}}
                        @endif

                        ">
                            <img class="slide-image" src="{{asset('upload/slide/'.$sl->Hinh)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
</div>