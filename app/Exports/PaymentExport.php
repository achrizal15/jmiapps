<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    private  $date;
    public function __construct(string $date = null)
    {
        $this->date = $date;
    }
    public function query()
    {
        $payment = Payment::query()->with(['member', "installations.package", "installations.bloks.collectors"]);
        if ($this->date != null) {
            $payment = $payment->whereYear("created_at", intval(date("Y", strtotime($this->date))));
            $payment = $payment->whereMonth("created_at", intval(date("m", strtotime($this->date))));
        }
        return $payment;
    }
    public function headings(): array
    {
        return ["MEMBER", "PENAGIH", "NAMA PAKET", "TIPE PEMBAYARAN", "HARGA", "TANGGAL PEMBAYARAN", "STATUS"];
    }
    public function map($payment): array
    {
        return [
            $payment->member->name,
            $payment->installations->bloks->collectors->name,
            $payment->installations->package->name,
            $payment->type_payment,
         "Rp.".number_format( $payment->installations->package->price, 2,',','.'),
            date("Y-m-d", strtotime($payment->created_at)),
            $payment->status
        ];
    }
}
