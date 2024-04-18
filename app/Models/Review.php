<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'show_id',
        'review',
        'stars',
        'validated',
    ];

    /**
     * The table associated with the model.
     * 
     * @var string
     */

    protected $table = 'reviews';

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */

    public $timestamps = true;

    /**
     * Get the user that owns the review.
     */

    public function user()

    {
        return $this->belongsTo(User::class); //belongs to est utilisé pour la relation many to one
    }

    /**
     * Get the show that owns the review.
     */

    public function show()

    {
        return $this->belongsTo(Show::class); //belongs to est utilisé pour la relation many to one
    }
}
