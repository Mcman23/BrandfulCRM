<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FollowUpStatus;

class FollowUp extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'follow_ups';

    protected $fillable = [
        'client_id', 'user_id', 'title', 'reminder_date', 'status',
    ];

    protected $casts = [
        'status' => FollowUpStatus::class,
        'reminder_date' => 'datetime',
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

