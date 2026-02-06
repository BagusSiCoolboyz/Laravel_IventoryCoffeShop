<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function MasterGoods()
    {
        return $this->belongsTo(MasterGoods::class, 'master_goods_id');
    }

    public function GoodsOut()
    {
        return $this->hasMany(GoodsOut::class);
    }
}
