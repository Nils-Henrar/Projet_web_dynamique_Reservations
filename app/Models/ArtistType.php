<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistType extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'type_id',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'artist_type';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the shows of the performance(artist in a typeof collaboration for a show).
     */

    public function shows()
    {
        return $this->belongsToMany(Show::class); //belongsToMany est utilisé pour la relation many to many
    }

    /**
     * Get the artist for that association.
     */

    public function artist()
    {
        return $this->belongsTo(Artist::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the type for that association.
     */

    public function type()
    {
        return $this->belongsTo(Type::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the performances(artists in a type of collaboration for a show) for the show.
     */

    public function artistTypes()

    {
        return $this->belongsToMany(ArtistType::class); //belongs to many est utilisé pour la relation many to many
    }
}
