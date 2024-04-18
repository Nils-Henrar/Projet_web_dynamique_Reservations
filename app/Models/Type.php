<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    protected $table = 'types';

    public $timestamps = false;

    /**
     * the artists that belong to the type.
     */

    public function artists()
    {
        return $this->belongsToMany(Artist::class); //belongsToMany est utilisé pour la relation many to many
    }

    public function artistTypes()
    {
        return $this->hasMany(ArtistType::class); //hasMany est utilisé pour la relation one to many
    }
}
