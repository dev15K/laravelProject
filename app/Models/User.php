<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Check if email is valid or not
     * @param string $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        $is_valid = true;
        $user = User::where('email', $email)->where('status', '!=', UserStatus::DELETED)->first();
        if ($user) {
            $is_valid = false;
        }
        return $is_valid;
    }

    /**
     * Check if phone number is valid or not
     * @param string $phone
     * @return bool
     */
    public static function checkPhone($phone)
    {
        $is_valid = true;
        $user = User::where('phone', $phone)->where('status', '!=', UserStatus::DELETED)->first();
        if ($user) {
            $is_valid = false;
        }
        return $is_valid;
    }

    /**
     * Check if username is valid or not
     * @param string $username
     * @return bool
     */
    public static function checkUsername($username)
    {
        $is_valid = true;
        $user = User::where('username', $username)->where('status', '!=', UserStatus::DELETED)->first();
        if ($user) {
            $is_valid = false;
        }
        return $is_valid;
    }
}
