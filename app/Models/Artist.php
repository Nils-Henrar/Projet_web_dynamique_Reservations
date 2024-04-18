<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
    ];

    protected $table = 'artists';

    public $timestamps = false;

    /**
     * the types that belong to the artist.
     */

    public function types()
    {
        return $this->belongsToMany(Type::class); //belongsToMany est utilisé pour la relation many to many
    }

    public function artistTypes()
    {
        return $this->hasMany(ArtistType::class); //hasMany est utilisé pour la relation one to many
    }
}
