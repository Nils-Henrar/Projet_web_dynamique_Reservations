<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'designation',
        'address',
        'locality_id',
        'website',
        'phone',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'locations';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the locality that owns the location.
     */

    public function locality()
    {
        return $this->belongsTo(Locality::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the shows for the location.
     */

    public function shows()
    {
        return $this->hasMany(Show::class); //hasMany est utilisé pour la relation one to many
    }

    /**
     * Get the representations for the location.
     */

    public function representations()
    {
        return $this->hasMany(Representation::class); //hasMany est utilisé pour la relation one to many
    }
}
