<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGoods extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Supplies()
    {
        return $this->hasMany(Supplies::class, 'master_goods_id');
    }
}
