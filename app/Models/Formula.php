<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formula extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'formulas';

    protected $fillable = [
        'ingredient_id',
        'product_id',
        'ingredient_proportion'
    ];


    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

    public function outcome()
    {
        return $this->hasMany(Outcome::class);
    }
}
