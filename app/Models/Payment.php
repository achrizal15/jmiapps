<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function installations(){
        return $this->belongsTo(Installation::class,"installation_id","id");
    }
    public function member(){
        return $this->belongsTo(User::class,"member_id","id");
    }
}
