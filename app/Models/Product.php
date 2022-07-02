<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property int $merchant_id
 * @property float $price
 * @property float $shipping_cost
 * @property bool $is_vat_included
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Merchant $merchant
 * @property Collection|Cart[] $carts
 * @property Collection|ProductDetail[] $product_details
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'merchant_id' => 'int',
		'price' => 'float',
		'shipping_cost' => 'float',
		'is_vat_included' => 'bool'
	];

	protected $fillable = [
		'name',
		'merchant_id',
		'price',
		'shipping_cost',
		'is_vat_included'
	];

	public function merchant()
	{
		return $this->belongsTo(Merchant::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function product_details()
	{
		return $this->hasMany(ProductDetail::class);
	}
}
