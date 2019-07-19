<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $guarded = ['_token'];

    public function template_goods()
    {
        return $this->hasMany(TemplateGoods::class, 'supplier_id');
    }
}
