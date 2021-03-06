<?php

namespace App\Models;

use App\Events\Attached;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cake extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'weight',
        'value',
        'quantity',
        'active'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsToMany
     */
    public function interested(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'customer_cakes',
            'cake_id',
            'customer_id'
        )->withTimestamps();
    }
}
