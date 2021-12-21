<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable;
    protected $header_teknisi = ["NAME", "EMAIL", "HANDPHONE", "ALAMAT", "MAPS", "CREATED"];
    public function __construct(string $role)
    {
        $this->role = $role;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 20,
            'D' => 50,
        ];
    }
    public function query()
    {

        return User::query()->where("role_id", $this->role);
    }
    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->phone,
            $user->alamat,
            $user->location,
            date("Y-m-d", strtotime($user->created_at)),
        ];
    }
    public function headings(): array
    {
        return $this->header_teknisi;
    }
}
