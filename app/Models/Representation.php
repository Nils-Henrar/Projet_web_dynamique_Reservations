<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Representation extends Model implements Feedable
{
    use HasFactory;

    protected $fillable = [
        'show_id',
        'location_id',
        'schedule',
    ];

    protected $casts = ['schedule' => 'datetime',];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'representations';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = false;

    /**
     * Get the show that owns the representation.
     */

    public function show()

    {
        return $this->belongsTo(Show::class); //belongs to est utilisé pour la relation many to one

    }

    /**
     * Get the location that owns the representation.
     */

    public function location()

    {
        return $this->belongsTo(Location::class); //belongs to est utilisé pour la relation many to one

    }

    //relation many to many avec la table representation_reservations

    /**
     * The representation_reservations that belong to the representation.
     */

    public function representationReservations()

    {
        return $this->hasMany(RepresentationReservation::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id) //$this cest la Represenation 
            ->title($this->show->title)
            ->summary($this->show->description)
            ->updated(Carbon::now()) //todo timestamps true
            //->updated($this->updated_at) todo timestamps true
            ->link(route('representation_show',$this->id))//lien vers le show de la representation
            ->authorName("Bob Sull")
            ->authorEmail("bob@sull.com");
    }

    public static function getFeedItems()
    {
        return Representation::whereYear('schedule', date('Y'))
        ->whereMonth('schedule', date('n'))->get(); //todo representation du mois     
    }
}
