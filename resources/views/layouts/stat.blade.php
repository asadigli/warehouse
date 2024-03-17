<div class="box" id="stat_section">
  <div class="box-header with-border">
    <h3 class="box-title"><a class="active">Category Stat</a> | <a>Cəmi satış</a> </h3>
  </div>
  <div class="box-body">
    <table class="table table-bordered">
      <tr>
        <th style="width: 10px">{{__('app.ID')}}</th>
        <th>{{__('app.Name')}}</th>
        <th>{{__('app.Progress')}}</th>
        <th style="width: 40px">{{__('app.Percent')}} </th>
      </tr>
      @php($products = App\Products::all())
      @foreach($cat as $ct)
      @php($prods = App\Products::where('cat_id',$ct->id)->get())
      <tr>
        <td>{{$ct->id}}.</td>
        <td><a href="list/{{$ct->id}}">{{$ct->cat_name}}</a> </td>
        <td>
          <div class="progress progress-xs progress-striped active">
            <div class="progress-bar progress-bar-success" style="width: {{substr((count($prods)/count($products))*100,0,4)}}%"></div>
          </div>
        </td>
        <td><span class="badge bg-green">{{substr((count($prods)/count($products))*100,0,4)}}%</span></td>
      </tr>
      @endforeach
    </table>
  </div>
  <div class="box-body" style="display:none;">
    <table class="table table-bordered" id="month_value" data-words="Ay,Cəm,{{__('app.Progress')}},{{__('app.Percent')}}"></table>
  </div>
</div>
