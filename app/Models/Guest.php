<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'name',
        'email',
        'phone',
        'address',
        'organization',
        'identity_id',
        'identity_file',
        'guest_token',
    ];

    public function guestBooks(): BelongsToMany
    {
        return $this->belongsToMany(GuestBook::class, 'guest_book_guest', 'guest_id', 'guest_book_id');
    }
}
