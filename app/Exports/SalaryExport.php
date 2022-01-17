<?php

namespace App\Exports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalaryExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    private $date;
    public function __construct($date = null)
    {
        $this->date = $date;
    }
    public function query()
    {
        $salary = Salary::query();
        if ($this->date != null) {
            $salary = $salary->whereYear("created_at", intval(date("Y", strtotime($this->date))));
        }
        return $salary;
    }
    public function headings(): array
    {
        return ["TANGGAL","NAMA","GAJI","POTONGAN","BONUS"];
    }
}
