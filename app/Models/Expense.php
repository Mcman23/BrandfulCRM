<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ExpenseCategory;

class Expense extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'expenses';

    protected $fillable = [
        'company_id', 'deal_id', 'title', 'category', 'amount', 'expense_date', 'notes',
    ];

    protected $casts = [
        'category' => ExpenseCategory::class,
        'amount' => 'float',
        'expense_date' => 'date',
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

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
}
