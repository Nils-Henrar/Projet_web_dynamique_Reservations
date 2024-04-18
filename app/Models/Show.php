<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;


    protected $fillable = [
        'slug',
        'title',
        'poster_url',
        'duration',
        'created_in',
        'location_id',
        'bookable',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'shows';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the representations for the show.
     */

    public function representations()
    {
        return $this->hasMany(Representation::class); //hasMany est utilisé pour la relation one to many
    }

    /**
     * Get the location that owns the show.
     */

    public function location()
    {
        return $this->belongsTo(Location::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the performances(artists in a type of collaboration) for the show.
     */

    public function artistTypes()
    {
        return $this->belongsToMany(ArtistType::class); //belongsToMany est utilisé pour la relation many to many
    }

    /**
     * Get the reviews for the show.
     */

    public function reviews()
    {
        return $this->hasMany(Review::class); //hasMany est utilisé pour la relation one to many
    }

    public function getStartDateAttribute()
    {
        // Utilise la relation `representations` pour trouver la date la plus ancienne
        $startDate = $this->representations()->orderBy('schedule', 'asc')->first();
        return optional($startDate)->schedule->format('d M');
    }

    public function getEndDateAttribute()
    {
        // Utilise la relation `representations` pour trouver la date la plus récente
        $endDate = $this->representations()->orderBy('schedule', 'desc')->first();
        return optional($endDate)->schedule->format('d M');
    }

    public function getAuteursAttribute()
    {
        $auteurs = [];
        foreach ($this->artistTypes as $artistType) {
            if ($artistType->type->type == 'auteur') {
                $auteurs[] = $artistType->artist;
            }
        }
        return $auteurs;
    }

    public function getComediensAttribute()
    {
        $comediens = [];
        foreach ($this->artistTypes as $artistType) {
            if ($artistType->type->type == 'comédien') {
                $comediens[] = $artistType->artist;
            }
        }
        return $comediens;
    }


    // Le scope pour filtrer par commune reste le même
    public function scopeByCommune($query, $communeId)
    {
        if ($communeId) {
            $query->whereHas('location', function ($q) use ($communeId) {
                $q->where('locality_id', $communeId);

                // use ($communeId) permet de récupérer la valeur de $communeId dans la fonction anonyme,
                // on passe la valeur de $communeId à la fonction anonyme afin de pouvoir filtrer les données de la relation location
                // en gros, on récupère les spectacles qui ont une localité qui correspond à $communeId
            });
        }

        return $query; // Ajouté pour permettre le chaînage avec d'autres scopes
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereHas('representations', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('schedule', [$startDate->startOfDay(), $endDate->endOfDay()]);
            });
        }

        return $query;
    }

    public function scopeWithKeyword($query, $keyword)
    {
        if ($keyword) {
            return $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhereHas('artistTypes.artist', function ($subQuery) use ($keyword) {
                    $subQuery->where('firstname', 'LIKE', "%{$keyword}%")
                        ->orWhere('lastname', 'LIKE', "%{$keyword}%");
                });
        }

        return $query;
    }
}
