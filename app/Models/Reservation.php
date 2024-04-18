<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_date',
        'status',
    ];

    protected $table = 'reservations';

    public $timestamps = false;

    /**
     * Get the user that owns the reservation.
     */

    public function user()

    {
        return $this->belongsTo(User::class); //belongs to est utilisé pour la relation many to one

    }

    /**
     * Get the representation_reservations for the reservation.
     */

    public function representation_reservations()

    {
        return $this->hasMany(RepresentationReservation::class); //hasMany est utilisé pour la relation one to many

    }

    public function getDetailsAttribute()
    {
        $totalPrice = $this->representation_reservations->sum(function ($repReservation) {
            return $repReservation->price->price * $repReservation->quantity;
        });

        $totalPlaces = $this->representation_reservations->sum('quantity');

        // Optionnel : Obtenir le premier spectacle et la première représentation pour affichage
        $firstRepresentation = $this->representation_reservations->first(); // on récupère la première représentation car toutes les représentations de la réservation sont les mêmes

        $show = optional($firstRepresentation->representation)->show; // optional() permet de ne pas déclencher d'erreur si $firstRepresentation->representation est null
        $representation = $firstRepresentation->representation;

        return collect([
            'total_price' => $totalPrice,
            'total_places' => $totalPlaces,
            'show' => $show,
            'representation' => $representation,
        ]); // collect() crée une nouvelle collection à partir du tableau passé en paramètre
    }
}
