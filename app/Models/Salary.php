<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Salary extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            return $query->whereYear("created_at", Date("Y", strtotime($date)))
                ->whereMonth("created_at", Date("m", strtotime($date)));
        });
        // make yang lebih sulit
        if (isset($filters['search']) ? $filters['search'] : false) {
            $search = $filters['search'];
            return $query->whereHas('user', function ($query) use ($search) {
                $query->where("name", "like", "%" . $search . "%");
            });
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
