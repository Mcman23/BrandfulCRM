<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ActivityType;

class Activity extends Model
{
    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'activities';

    protected $fillable = [
        'client_id', 'user_id', 'type', 'description', 'date',
    ];

    protected $casts = [
        'type' => ActivityType::class,
        'date' => 'datetime',
        'created_at' => 'datetime',
    ];

    public const UPDATED_AT = null;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = \Illuminate\Support\Str::uuid()->toString();
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

