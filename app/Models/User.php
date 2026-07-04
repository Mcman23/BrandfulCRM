<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Role;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'email', 'password_hash', 'role', 'company_id',
    ];

    protected $hidden = [
        'password_hash', 'remember_token',
    ];

    protected $casts = [
        'role' => Role::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = \Illuminate\Support\Str::uuid()->toString();
            }
        });
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'assigned_user');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'user_id');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === Role::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [Role::SUPER_ADMIN, Role::ADMIN]);
    }

    public function isManager(): bool
    {
        return $this->role === Role::MENEGER;
    }
}

