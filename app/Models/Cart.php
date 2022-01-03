<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'carts';
    protected $guarded = [];

    /* relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }

    /* methods */

    public function addProducts()
    {
        foreach (request()->products as $item) {
            $this->products()->create($item);
            $product = Product::findOrFail($item['product_id']);
            $product->update([
                'stock' => $product->stock - $item['quantity']
            ]);
        }

        return $this;
    }

    public function setTotal()
    {
        $this->total = $this->products()->sum('total');
        $this->save();
        return $this;
    }
}
