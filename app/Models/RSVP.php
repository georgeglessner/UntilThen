<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSVP extends Model
{
    /** @use HasFactory<\Database\Factories\RSVPFactory> */
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rsvp';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'response',
        'event_id',
        'comment'
    ];

    public function get_rsvps_for_event(string $eventHash) {
        return RSVP::where('event_id', $eventHash)->latest('created_at')->get();
    }
}
