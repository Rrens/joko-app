<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'platforms';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
