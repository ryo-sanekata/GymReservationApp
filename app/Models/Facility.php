<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    // テーブル名（省略時、モデル名の複数形が使用されるため、明示的に設定）
    protected $table = 'facilities';

    // マスアサインメント可能なカラム
    protected $fillable = [
        'name',
        'address',
        'description',
        'price_per_hour',
        'category',
    ];
}

