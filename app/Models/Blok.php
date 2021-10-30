<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function collectors()
    {
        return $this->belongsTo(User::class, "collector_id");
    }
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            return $query->whereYear("created_at", Date("Y", strtotime($date)))
                ->whereMonth("created_at", Date("m", strtotime($date)));
        });
        // make yang lebih sulit
        if (isset($filters['search']) ? $filters['search'] : false) {
            $search = $filters['search'];
            $query->whereHas('collectors', function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%");
            })->orWhere("name", "like", "%" . $search . "%");;
        }
    }
    public function installations()
    {
        return $this->hasOne(Installation::class, "blok_id", "id");
    }
}
