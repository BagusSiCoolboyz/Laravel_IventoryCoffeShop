<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsOut extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Supplies()
    {
        return $this->belongsTo(Supplies::class);
    }
     // Jika GoodsOut langsung terhubung ke MasterGoods
     public function MasterGoods()
     {
         return $this->belongsTo(MasterGoods::class);
     }
}
