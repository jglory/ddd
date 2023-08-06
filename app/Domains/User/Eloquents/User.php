<?php

namespace App\Domains\User\Eloquents;

use Database\Factories\UserFactory;
use App\Values\EmailAddress;
use App\Values\Password;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * User eloquent class
 *
 * @property int $id bigint
 * @property string $name varchar(255)
 * @property EmailAddress $email varchar(255)
 * @property Carbon|null $email_verified_at timestamp
 * @property Password $password varchar(255)
 * @property string|null $remember_token varchar(100)
 * @property Carbon|null $created_at timestamp
 * @property Carbon|null $updated_at timestamp
 * @property Carbon|null $deleted_at timestamp
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }


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

    public function getEmailAttribute(string $val): EmailAddress
    {
        return new EmailAddress($val);
    }

    public function setEmailAddressAttribute(EmailAddress $val): static
    {
        $this->attributes['email'] = (string) $val;

        return $this;
    }

    public function getPasswordAttribute(string $val): Password
    {
        return new Password($val, true);
    }

    public function setPasswordAttribute(Password $password): static
    {
        $this->attributes['password'] = $password->value;

        return $this;
    }
}
