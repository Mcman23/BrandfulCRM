<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'clients';

    protected $fillable = [
        'company_id', 'client_name', 'client_company_name', 'phone', 'whatsapp',
        'email', 'address', 'industry', 'notes',
    ];

    protected $casts = [
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
        return $this->hasMany(Lead::class, 'client_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'client_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'client_id');
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'client_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'client_id');
    }

    public function leadsCount(): int { return $this->leads()->count(); }
    public function dealsCount(): int { return $this->deals()->count(); }
    public function paymentsCount(): int { return $this->payments()->count(); }
}

