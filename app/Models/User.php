<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'login',
        'firstname',
        'lastname',
        'email',
        'password',
        'langue',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    //casts permet de définir le type de données des attributs
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //Relation many to many avec la table roles

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    //Relation one to many avec la table reservations

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    //Relation one to many avec la table reviews

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
