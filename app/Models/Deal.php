<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\DealStatus;

class Deal extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'deals';

    protected $fillable = [
        'client_id', 'service_id', 'amount', 'status', 'close_date',
    ];

    protected $casts = [
        'status' => DealStatus::class,
        'amount' => 'float',
        'close_date' => 'datetime',
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

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'deal_id');
    }

    public function expensesTotal(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    public function profit(): float
    {
        return (float) $this->amount - $this->expensesTotal();
    }

}

