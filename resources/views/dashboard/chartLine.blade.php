@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')

   
@stop

@section('content')
        <div class="box box-primary">
        <div class="box-header with-border">
            <div class="row" style="width: 7%;margin: 0 auto;">
                <select class="sel form-control" id="sel" name="year">
                    @php($year=2019)
                    @for ($year; $year <=2100; $year++)
                      @if(date('Y') == $year)
                      <option selected value="{{$year}}">Year {{$year}}</option>
                      @else  
                      <option value="{{$year}}">Year {{$year}}</option>
                      @endif
                    @endfor
                </select>
             </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
        
            <div style="width: 80%;margin: 0 auto;" class="row">
                {!! $chart->container() !!}
            </div> 
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            
          </div>
        
        </div> 

        <div class="box box-primary">
        <div class="box-header with-border">
            <div  style="width: 10%;margin: 0 auto;">
                <select class="month form-control" name="month">
                    <option selected disabled>Month {{date('F')}}</option>
                    @foreach($months as $key => $month)
                      <option value="{{$key}}">Month {{$month}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
        
            <div style="width: 80%;margin: 0 auto;" class="row">
                {!! $chart2->container() !!}
            </div> 
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            
          </div>
        
        </div> 


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  
        {!! $chart->script() !!}
        {!! $chart2->script() !!}
  
        <script type="text/javascript">
            var original_api_url = {{ $chart->id }}_api_url;
            $(".sel").change(function(){
                var year = $(this).val();
                {{ $chart->id }}_refresh(original_api_url + "?year="+year);
            });
        </script>


        <script type="text/javascript">
            var original_api_url = {{ $chart2->id }}_api_url;
            $(".month").change(function(){
                var month = $(this).val();
                var year = $('#sel').val();
                {{ $chart2->id }}_refresh(original_api_url + "?year="+year+"&month="+month);
            });
        </script>
@stop

