<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 以下のカラムへのデータ保存を許可します
    protected $fillable = [
        'name',
        'email',
        'tel',
        'content'
    ];
}