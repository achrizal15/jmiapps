<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            return $query->whereYear("created_at", Date("Y", strtotime($date)))
                ->whereMonth("created_at", Date("m", strtotime($date)));
        });
        // make yang lebih sulit
        if (isset($filters['search']) ? $filters['search'] : false) {
            $search = $filters['search'];
            return $query->whereHas('member', function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%");
            })->orWhere("constraint", "like", "%" . $search . "%");
        }
    }
    public function member(){
        return $this->belongsTo(User::class,"member_id","id");
    }
    public function technician(){
        return $this->belongsTo(User::class,"technician_id","id");
    }
}
