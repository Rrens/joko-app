<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'productID',
        'platformID',
        'userID',
        'quantity',
        'total_price',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'productID');
    }

    public function productWithCategory()
    {
        return $this->belongsTo(Products::class, 'productID', 'id')->with('category');
    }

    public function platform()
    {
        return $this->hasMany(Platform::class, 'id', 'platformID');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'userID');
    }
}
