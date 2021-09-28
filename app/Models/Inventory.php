<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            return $query->whereYear('created_at', "=", Date('Y', strtotime($date)))
                ->whereMonth('created_at', "=", Date('m', strtotime($date)));
        });
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
