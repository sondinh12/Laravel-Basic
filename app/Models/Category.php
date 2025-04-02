<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    //mặc đính sử dụng eloquent luôn có 2 trường created_at, updated_at nên sử dụng hàm timestamps để tắt
    public $timestamps = false;
    protected $fillable = [
        'name',
        'status'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
