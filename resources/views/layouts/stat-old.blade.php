<ul class="widget widget-usage unstyled span4">
    @php
    $products = App\Products::all()
    @endphp
    @foreach($cat as $ct)
    @if($ct->id % 2 != 0)
    @php
    $prods = App\Products::where('cat_id','=',[$ct->id])->get()
    @endphp
    <li>
        <p>
            <strong>
              <a href="list/{{$ct->id}}">
                {{$ct->cat_name}}
              </a>
            </strong> <span class="pull-right small muted">
               {{substr((count($prods)/count($products))*100,0,4)}}%


            </span>
        </p>
        <div class="progress tight">

        <div class="bar bar-primary" style="width: {{substr((count($prods)/count($products))*100,0,4)}}%">
        </div>

        </div>
    </li>
    @endif
    @endforeach

    <!-- <li>
        <p>
            <strong>Computer Accessories</strong> <span class="pull-right small muted">67%</span>
        </p>
        <div class="progress tight">
            <div class="bar bar-danger" style="width: 67%;">
            </div>
        </div>
    </li> -->
    <!-- <li>
        <p>
            <strong>Mac</strong> <span class="pull-right small muted">56%</span>
        </p>
        <div class="progress tight">
            <div class="bar bar-success" style="width: 56%;">
            </div>
        </div>
    </li> -->
    <!-- <li>
        <p>
            <strong>Linux</strong> <span class="pull-right small muted">44%</span>
        </p>
        <div class="progress tight">
            <div class="bar bar-warning" style="width: 44%;">
            </div>
        </div>
    </li> -->
</ul>
