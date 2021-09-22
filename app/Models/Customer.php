<?php

namespace App\Models;

use App\Events\Attached;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email'
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
    public function cakes(): BelongsToMany
    {
        return $this->belongsToMany(
            Cake::class,
            'customer_cakes',
            'customer_id',
            'cake_id'
        )->withTimestamps();
    }

    public function syncCakes($ids, $detaching = true)
    {
        $result = $this->cakes()->sync($ids, $detaching);

        if ($attached = $result['attached']) {
            static::$dispatcher->dispatch(new Attached($this, $attached));
        }
    }
}
