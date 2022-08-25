<?php

namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesFilterExport implements FromCollection, WithHeadings, WithColumnWidths, WithCustomStartCell, WithEvents, WithStyles
{
    protected $search, $from, $to;

    public function __construct($search, $from, $to)
    {
        $this->search = $search;
        $this->from = $from;
        $this->to = $to;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Sale::query();

        $sales = $this->dataQuery($data);
        $salesCollection = new Collection();

        foreach ($sales as $key=>$sale) {
            $salesCollection->push((object)[
                'serial' => $key + 1,
                'store' => $sale->store,
                'brand' => $sale->brand,
                'product_category' => $sale->product_category,
                'product_name' => $sale->product_name,
                'price' => $sale->price,
                'sale_at' => $sale->created_at->format('d M, Y'),
            ]);
        }
        return $salesCollection;
    }

    public function dataQuery($data){

        if($this->from || $this->to){
            $from_date = $this->from ?? Carbon::today()->subDays(30);
            $to_date = $this->to ?? Carbon::today();
            $data->whereBetween(DB::raw('DATE(created_at)'), array($from_date, $to_date));
        } else {
            $data->whereDate('created_at', Carbon::today());
        }

        if($this->search){
            $data->where('store','LIKE','%'.$this->search.'%')
                ->orWhere('brand','LIKE','%'.$this->search.'%')
                ->orWhere('product_name','LIKE','%'.$this->search.'%')
                ->orWhere('product_category','LIKE','%'.$this->search.'%');
        }

        return $data->orderBy('created_at', 'desc')->get();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 18]],
            2    => ['font' => ['size' => 12]],
            3    => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array {

        return [
            AfterSheet::class => function(AfterSheet $event) {
                /** @var Sheet $sheet */

                $sheet = $event->sheet;

                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', "Summary of Viser X E-commerce");

                $sheet->mergeCells('A2:G2');
                if ($this->from || $this->to){
                    $from_date = $this->from ?? Carbon::today()->subDays(30);
                    $to_date = $this->to ?? Carbon::today();
                    $sheet->setCellValue('A2', "Sales Report Date : [ ". Carbon::parse($from_date)->format('d-m-Y') .' To '. Carbon::parse($to_date)->format('d-m-Y'). ']');
                } else {
                    $sheet->setCellValue('A2', "Sales Report Date : ". Carbon::today()->format('d-m-Y'));
                }

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:G1'; // All headers
                $columnCellRange = 'A3:G3'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle($columnCellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension('3')->setRowHeight(20);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Sl No.',
            'Store Name',
            'Brand Name',
            'Product Category',
            'Product Name',
            'Price',
            'Sale Date',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 10,
            'G' => 25,
        ];
    }
}
