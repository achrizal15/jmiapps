<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilters($query, $filters)
    {
        if (isset($filters['date']) ? $filters['date'] : false) {
            return $query->whereYear("created_at", date("Y", strtotime($filters['date'])))
                ->whereMonth("created_at", date("m", strtotime($filters['date'])));
        }
        if (isset($filters['search']) ? $filters['search'] : false) {
            $search = $filters['search'];
            return $query->whereHas("user", function ($query) use ($search) {
                return $query->where("name", "like", "%" . $search . "%");
            })->orWhere("port","=",$search);
        }
    }
    public function inventorys()
    {
        return $this->belongsToMany(Inventory::class)
            ->withPivot(['stock']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function technician()
    {
        return $this->belongsTo(User::class, "technician_id");
    }
    public function payments(){
        return $this->hasMany(Payment::class,"installation_id");
    }
    public function bloks(){
        return $this->belongsTo(Blok::class,"blok_id");
    }
}
