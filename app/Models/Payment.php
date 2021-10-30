<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function installations()
    {
        return $this->belongsTo(Installation::class, "installation_id", "id");
    }
    public function member()
    {
        return $this->belongsTo(User::class, "member_id", "id");
    }
    public function scopeFilters($query, $filters)
    {
        if (isset($filters['date']) ? $filters['date'] : false) {
            return $query->whereYear("created_at", date("Y", strtotime($filters['date'])))
                ->whereMonth("created_at", date("m", strtotime($filters['date'])));
        }
        if (isset($filters['search']) ? $filters['search'] : false) {
            $search = $filters['search'];
            return $query->whereHas("member", function ($query) use ($search) {
                return $query->where("name", "like", "%" . $search . "%");
            });
        }
    }
}
