<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class OrdersExport implements  WithHeadings, FromCollection, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }


    public function collection()
    {

        $orders = $this->orders;

        $data = [];

        foreach ($orders as $index => $order) {

            $data[] = [
                '#' => $index + 1,
                '0' => $order->customer_name,
                '1' => $order->phone,
                '2' => $order->review_date,
                '3' => $order->review_type,
                '4' => $order->order_directions->pluck('direction_car')->implode(PHP_EOL),
                '5' => $order->order_directions->pluck('direction_type')->implode(PHP_EOL),
                '6' => $order->order_directions->pluck('direction')->implode(PHP_EOL),
                '7' => $order->order_directions->pluck('direction_price')->implode(PHP_EOL),
                '8' => $order->order_directions->pluck('direction_quantity')->implode(PHP_EOL),
                '9' => $order->order_directions->pluck('direction_total')->implode(PHP_EOL),
                '10' => $order->order_masters->pluck('thing')->implode(PHP_EOL),
                '11' => $order->order_masters->pluck('thing_service')->implode(PHP_EOL),
                '12' => $order->order_masters->pluck('thing_price')->implode(PHP_EOL),
                '13' => $order->order_masters->pluck('thing_quantity')->implode(PHP_EOL),
                '14' => $order->order_masters->pluck('thing_total')->implode(PHP_EOL),
                '15' => $order->order_workers->pluck('worker')->implode(PHP_EOL),
                '16' => $order->order_workers->pluck('worker_price')->implode(PHP_EOL),
                '17' => $order->order_workers->pluck('worker_quantity')->implode(PHP_EOL),
                '18' => $order->order_workers->pluck('worker_total')->implode(PHP_EOL),
                '19' => ($order->order_directions->sum('direction_total')) + ($order->order_masters->sum('thing_total')) + ($order->order_workers->sum('worker_total'))
            ];
        }

        return collect($data);

    }

    public function headings(): array
    {
        return [
            '#',
            'Müştəri adı',
            'Nömrəsi',
            'Baxış tarixi',
            'Müştəri tipi',
            'Maşın',
            'Region',
            'İstiqamət',
            'Qiymət',
            'Reys sayı',
            'Ümumi qiymət',
            'Əşyalar',
            'Xidmət',
            'Qiyməti',
            'Sayı',
            'Ümumi qiymət',
            'İşçi qüvvəsi',
            'Qiyməti',
            'Sayi',
            'ümumi qiymət',
            'Total qiymət'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            // Add more columns if needed, e.g., 'C' => NumberFormat::FORMAT_TEXT
        ];
    }
}
