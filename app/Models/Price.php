<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'start_date',
        'end_date',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'prices';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the representation_reservations that belong to the price.
     */

    public function representationReservations()

    {
        return $this->hasMany(RepresentationReservation::class); //hasMany est utilisé pour la relation one to many

    }
}
