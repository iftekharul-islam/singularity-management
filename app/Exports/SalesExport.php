<?php

namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements FromCollection, WithHeadings, WithColumnWidths, WithCustomStartCell, WithEvents, WithStyles
{
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

                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', "Summary of Viser X E-commerce");

                $sheet->mergeCells('A2:F2');
                $sheet->setCellValue('A2', "Sales Report Date :". Carbon::today()->format('d-m-Y'));

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:F1'; // All headers
                $columnCellRange = 'A3:F3'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle($columnCellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension('3')->setRowHeight(20);
            },
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $sales = Sale::all();

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
