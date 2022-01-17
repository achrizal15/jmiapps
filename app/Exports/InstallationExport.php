<?php

namespace App\Exports;

use App\Models\Installation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InstallationExport implements FromQuery, WithHeadings, WithMapping
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
        $payment = Installation::query()->with(['user', "package", "bloks.collectors", "technician"])->orderBy("created_at", "ASC");
        if ($this->date != null) {
            $payment = $payment->whereYear("created_at", intval(date("Y", strtotime($this->date))));
            $payment = $payment->whereMonth("created_at", intval(date("m", strtotime($this->date))));
        }
        return $payment;
    }
    public function headings(): array
    {
        return ["MEMBER", "ALAMAT", "HANDPHONE", "TEKNISI", "BLOK", "PENAGIH", "PAKET", "HARGA", "PORT", "NO MODEM", "REDAMAN", "SPLITER", "STATUS", "PEMASANGAN"];
    }
    public function map($installation): array
    {
        return [
            $installation->user->name,
            $installation->user->alamat,
            $installation->user->phone,
            $installation->technician->name,
            $installation->bloks->name,
            $installation->bloks->collectors->name,
            $installation->package->name,
            "Rp." .$installation->package->price,
            $installation->port,
            $installation->number_modem, $installation->redaman, $installation->spliter, $installation->status, date("Y-M-d", strtotime($installation->created_at))
        ];
    }
}
