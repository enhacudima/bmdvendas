<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendasTroco;
use App\Charts\VendasLineChart;
use Auth;

class ChartController extends Controller
{
    
    
        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    public $days;


    function daysMonth ()
    {
        for ($i=0; $i <=30 ; $i++) { 
            $days[$i]=$i+1;
        }
        
        return $days;
    }

    public function chartLine()
    {
        $this->authorize('dashboard');

        $api = url('/chart-line-ajax');
   
        $chart = new VendasLineChart;
        $chart->labels($this->months)
        ->load($api)
        ->title('Venda Mensal');

        //teste
        $api2=url('/chart-line-ajax-api2');
		
		for($i = 1 ; $i <= 12; $i++)
		{
		 $months[$i]= date("F",strtotime(date("Y")."-".$i."-01"));
		 
		}

        $days=$this->daysMonth();

        $chart2 = new VendasLineChart;
        $chart2->labels($days)
        ->load($api2)
        ->title('Vendas Diarias');
          
        return view('dashboard.chartLine', compact('chart','chart2','months'));
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

        function sumItemTotalVenda($items)
    {
        $total=0;

        foreach ($items as $item)
        {
            $total=$total+$item->total_venda;
        }
        $result = $total;
        
        return $result;
    }
    function getDataSet($labels,$dataset)
    {

       foreach ($labels as $key => $value) {
            if (isset($dataset[$value])) {
                $data_var=$dataset[$value];
            } else{
                $data_var=0;
            } 
            $datas[$key]=$data_var;
            $datas=array_values($datas);//without keys
       };

       return $datas;
    }

    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y'); 
        $dataset = VendasTroco::select(\DB::raw("sum(total_venda) as count"),\DB::raw('date_format(created_at,"%b") as month'))
                    ->whereYear('created_at', $year)
                    ->groupBy('month')
                    ->pluck('count','month'); 

        $datas=$this->getDataSet($this->months,$dataset);            

        $chart = new VendasLineChart;
        $chart->dataset('Total venda', 'line', $datas)
              ->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);

        return $chart->api();   
    }
        public function chartLineAjax2(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $month = $request->has('month') ? $request->month : date('m');

        $dataset = VendasTroco::select(\DB::raw("sum(total_venda) as count"),\DB::raw("Day(created_at) as day"))
                    ->whereYear('created_at', $year)
                    ->wheremonth('created_at',$month)
                    ->groupBy('day')
                    ->pluck('count','day');

        $days=$this->daysMonth();          
        $datas=$this->getDataSet($days,$dataset);  
  
        $chart2 = new VendasLineChart;
        $chart2->dataset('Venda', 'bar', $datas)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart2->api();
    }
}
