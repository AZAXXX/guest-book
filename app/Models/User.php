<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * Nama tabel yang berhubungan dengan model ini.
     * Laravel biasanya otomatis menebak nama tabel,
     * tapi ini bisa diubah secara eksplisit jika diperlukan.
     */
    protected $table = 'users';

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     * Kolom ini mencegah Laravel dari 'Mass Assignment Vulnerability'.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'nik',
        'phone',
    ];

    /**
     * Relasi Many-to-Many dengan model Organization melalui tabel pivot 'structures'.
     * Setiap pengguna dapat terhubung ke banyak organisasi.
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'structures', 'user_id', 'organization_id');
    }

    /**
     * Relasi One-to-Many dengan model GuestBook.
     * Misalnya, user ini sebagai 'host' di buku tamu.
     */
    public function guestBooks(): HasMany
    {
        return $this->hasMany(GuestBook::class, 'host_id');
    }

    /**
     * Relasi tambahan atau metode lain jika diperlukan
     */
    // Tambahkan metode atau relasi tambahan jika diperlukan
}
