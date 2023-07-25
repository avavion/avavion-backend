<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Dto\User\UserDto;
use App\Enums\UserRolesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property string $email
 * @property string $last_name
 * @property string $first_name
 * @property string $username
 * @property string $password
 * @property string $email_verified_at
 * @property UserRolesEnum $role
 *
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereUsername($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereRole($value)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'email_verified_at',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRolesEnum::class
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function modelToDto(): UserDto
    {
        return new UserDto(
            id: $this->id,
            firstName: $this->first_name,
            lastName: $this->last_name,
            username: $this->username,
            email: $this->email,
            role: $this->role,
            emailVerifiedAt: $this->email_verified_at
        );
    }
}
