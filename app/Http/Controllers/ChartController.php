<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendasTroco;
use App\Charts\VendasLineChart;

class ChartController extends Controller
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLine()
    {
        $api = url('/chart-line-ajax');
   
        $chart = new VendasLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
        ->load($api)
        ->title('Venda Mensal');

        //teste
        $api2=url('/chart-line-ajax-api2');
        for ($i=0; $i <=30 ; $i++) { 
        	$days[$i]=$i+1;
        }
		
		for($i = 1 ; $i <= 12; $i++)
		{
		 $months[$i]= date("F",strtotime(date("Y")."-".$i."-01"));
		 
		}



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
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $users = VendasTroco::select(\DB::raw("sum(total_venda) as count"))
                    ->whereYear('created_at', $year)
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
  
        $chart = new VendasLineChart;
  
        $chart->dataset('Total venda', 'line', $users)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }
        public function chartLineAjax2(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $month = $request->has('month') ? $request->month : date('m');

        $users = VendasTroco::select(\DB::raw("sum(total_venda) as count"))
                    ->whereYear('created_at', $year)
                    ->wheremonth('created_at',$month)
                    ->groupBy(\DB::raw("Day(created_at)"))
                    ->pluck('count');
  
        $chart2 = new VendasLineChart;
  
        $chart2->dataset('Venda', 'bar', $users)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart2->api();
    }
}
