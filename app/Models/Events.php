<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Events extends Model
{
    /** @use HasFactory<\Database\Factories\EventsFactory> */
    use HasFactory;
    use HasUlids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $fillable = [
        'event_name',   
        'description',
        'location',
        'start_date',
        'end_date',
        'created_by',
        'is_active'
    ];

    public static function get_events() {
        $user = Auth::user();
        if (!$user) {
            return collect(); 
        }
        return Events::with('user')->where('created_by', $user->id)->get();
    }

    public static function get_event(string $hash) {
        return Events::with('user')->findOrFail($hash);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
