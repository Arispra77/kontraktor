<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property string|null $nama_kary username
 * @property string|null $nama_kary1 nama pt/ perusahaan
 * @property string|null $bagian_kary kode sub kontraktor
 * @property string|null $Password hash
 * @property string $status 0=tidak_aktif,1=aktif
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBagianKary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNamaKary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNamaKary1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'ts_karyawan_sk';

    // Kolom yang dapat diisi (fillable) pada tabel 'siswa'
    protected $fillable = ['nama_kary','nama_kary1','bagian_kary', 'Password','status'];

    // Kolom yang harus di-hash (password)
    protected $hidden = ['Password'];

  //  Nama kolom yang digunakan untuk otentikasi
    public function getAuthIdentifierName()
    {
        return 'nama_kary';
    }

    // Nama kolom yang digunakan untuk password
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
