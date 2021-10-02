<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function inventorys()
    {
        return $this->belongsToMany(Inventory::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function packages(){
        return $this->belongsTo(Package::class);
    }
}
