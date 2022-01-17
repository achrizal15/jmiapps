<?php

namespace App\Exports;

use App\Models\Finance;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    private $date;
    public function __construct(string $date = null)
    {
        $this->date = $date;
    }
    public function query()
    {
        $keuangan = Finance::query();
        if ($this->date != null) {
            $keuangan = $keuangan->whereYear("created_at", intval(date("Y", strtotime($this->date))));
        }
        return $keuangan;
    }
    public function headings(): array
    {
        return ["TANGGAL", "TYPE", "KATEGORI", "BALANCE", "DETAIL"];
    }
    public function map($row): array
    {
        return [date("d-M-Y", strtotime($row->created_at)), $row->type, $row->category, "Rp." . $row->balance, $row->detail];
    }
}
