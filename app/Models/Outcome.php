<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Outcome extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'outcomes';


    public function formula()
    {
        return $this->belongsTo(Formula::class,'formula_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'removed_by');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'ingredient_id');
    }

}
