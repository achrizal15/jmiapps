<?php

namespace App\Exports;

use App\Models\Expenditure;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpenditureExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    protected $year;
    protected $status;
    public function __construct(string $year = null, string $status = null)
    {
        $this->year = $year;
        $this->status = $status;
    }
    public function query()
    {
        $expenditure = Expenditure::query();
        if ($this->year != null) {
            $expenditure = $expenditure->whereYear("created_at", intval(date("Y", strtotime($this->year))));
        }
        if ($this->status != null) {
            $expenditure = $expenditure->where("status", strtolower($this->status));
        }
        return $expenditure;
    }
    public function map($expenditure): array
    {
        return [
            $expenditure->name_product,
            $expenditure->name_suplier,
            $expenditure->balance,
           "Rp.".$expenditure->price,
            $expenditure->stock,
            $expenditure->type,
            $expenditure->status,
            $expenditure->notes,
            date("Y-m-d H:i:s", strtotime($expenditure->created_at)),
        ];
    }
    public function headings(): array
    {
        return ["NAMA PRODUK", "NAMA SUPLIER", "ANGGARAN", "HARGA", "STOK", "TIPE PEMBELIAN", "STATUS", "CATATAN", "TANGGAL PENGAJUAN"];
    }
}
