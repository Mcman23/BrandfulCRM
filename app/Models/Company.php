<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CompanyStatus;

class Company extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'companies';

    protected $fillable = [
        'company_name', 'logo', 'phone', 'email', 'address', 'description', 'status',
    ];

    protected $casts = [
        'status' => CompanyStatus::class,
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

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'company_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'company_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'company_id');
    }

    public function clientsCount(): int
    {
        return $this->clients()->count();
    }

    public function usersCount(): int
    {
        return $this->users()->count();
    }

    public function servicesCount(): int
    {
        return $this->services()->count();
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'company_id');
    }

}

