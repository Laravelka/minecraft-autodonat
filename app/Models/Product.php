<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'price',
        'duration',
        'extra_payment',
        'luckperms_group',
        'command_month',
        'command_three_months',
        'command_forever',
        'allow_promocodes',
        'description',
    ];


    /**
     * Get the category.
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the purchases history.
     */
    public function purchaseHistory(): HasMany
    {
        return $this->hasMany(PurchaseHistory::class);
    }
}
