<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'categoryID',
        'name',
        'price',
        'quantity',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->hasMany(ProductCategories::class, 'id', 'categoryID');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
