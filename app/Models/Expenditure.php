<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('name_product', 'like', '%' . $filters['search'] . '%')->orWhere('name_suplier', 'like', '%' . $filters['search'] . '%');
        // }
        // or
        $query->when($filters['date'] ?? false, function ($query, $dat) {
            return $query->whereYear('created_at', "=", Date('Y', strtotime($dat)))->whereMonth('created_at', '=', Date('m', strtotime($dat)));
        });
        $query->when($filters['status'] ?? false, function ($query, $sts) {
            return $query->where('status', $sts);
        });
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name_product', 'like', '%' . $search . '%')->orWhere('name_suplier', 'like', '%' . $search . '%');
        });
    }
}
