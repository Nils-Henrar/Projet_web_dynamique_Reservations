<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentationReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'representation_id',
        'reservation_id',
        'price_id',
        'quantity',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'representation_reservation';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the representation for the reservation.
     */

    public function representation()
    {
        return $this->belongsTo(Representation::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the reservation for the representation.
     */

    public function reservation()
    {
        return $this->belongsTo(Reservation::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the price for the representation.
     */

    public function price()

    {
        return $this->belongsTo(Price::class); //belongs to est utilisé pour la relation many to one

    }
}
