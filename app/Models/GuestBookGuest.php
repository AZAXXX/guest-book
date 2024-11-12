<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBookGuest extends Model
{
    use HasFactory;

    protected $table = 'guest_book_guest';
    public $timestamps = false;

    protected $fillable = [
        'guest_id',
        'guest_book_id',
    ];

    // Relasi dengan model Guest
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    // Relasi dengan model GuestBook
    public function guestBook()
    {
        return $this->belongsTo(GuestBook::class, 'guest_book_id');
    }
}
