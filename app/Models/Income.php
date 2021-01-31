<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Income extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'incomes';

    protected $fillable = [
        'ingredient_id',
        'income_amount',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }
}
