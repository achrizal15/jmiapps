<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ["id"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            return $query
                ->whereYear("created_at", Date('Y', strtotime($date)))
                ->whereMonth("created_at", Date("m", strtotime($date)));
        });
        if (isset($filters['search'])) {
            return $query->where('name', "like", "%" . $filters['search'] . "%")
                ->orWhere('email', "like", "%" . $filters['search'] . "%")
                ->orWhere('phone', "like", "%" . $filters['search'] . "%");
        }
    }
    public function installations(){
     return   $this->hasOne(Installation::class);
    }
    public function salarys(){
        return $this->hasMany(Salary::class);
    }
}
