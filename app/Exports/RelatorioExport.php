<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\ProcessedFiles;


class RelatorioExport implements FromQuery, ShouldAutoSize,ShouldQueue,WithHeadings
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $start;
    public $end;
    public $type;
    public $filtro; 
    public function headings(): array
    {
        $data=DB::table($this->type)->first();
        $arrrayData=collect($data)->toArray();
        $heading=array_keys($arrrayData);
        return $heading;
    }
    public function __construct($start,$end,$type,$filtro)
    {
        $this->start=$start;
        $this->end=$end;
        $this->type=$type;
        $this->filtro=$filtro;
    }
    
    public function query()
    {
        $data=new ProcessedFiles;
        $data=DB::table($this->type)->whereBetween($this->filtro,[$this->start,$this->end])->orderBy($this->filtro,'asc');
        return $data;
    }

}
