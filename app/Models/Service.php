<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'services';

    protected $fillable = [
        'company_id', 'name', 'description', 'price',
    ];

    protected $casts = [
        'price' => 'float',
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

    public function leads()
    {
        return $this->hasMany(Lead::class, 'service_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'service_id');
    }

    public function leadsCount(): int { return $this->leads()->count(); }
    public function dealsCount(): int { return $this->deals()->count(); }
}

