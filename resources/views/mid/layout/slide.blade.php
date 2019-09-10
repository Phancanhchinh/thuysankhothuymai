
<div class="row carousel-holder">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php   $i = 0 ?>
                    @foreach ($slide as $sl)
                    <li data-target="#carousel-example-generic"
                    @if ($i==0)
                        class="active"
                    @endif
                    data-slide-to="{{$i}}"></li>
                    <?php   $i++ ?>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    <?php $i=0 ?>
                    @foreach ($slide as $sl)
                        <div
                        @if ($i == 0)
                            class="item active"
                        @else
                            class="item"
                        @endif
                        >
                            <img class="slide-image" style="width: 100%" src="main/image/slide/{{$sl->image}}" alt="{{$sl->image}}">
                        </div>
                        <?php $i++ ?>
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






