<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\LeadStatus;

class Lead extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'leads';

    protected $fillable = [
        'company_id', 'client_id', 'source', 'status', 'service_id',
        'budget', 'assigned_user',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'budget' => 'float',
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_user');
    }
}

