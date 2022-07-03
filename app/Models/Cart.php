<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $product_id
 * @property string $shipping_address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer $customer
 * @property Product $product
 *
 * @package App\Models
 */
class Cart extends Model
{
	use HasFactory;
	protected $table = 'carts';

	protected $casts = [
		'customer_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'product_id',
		'shipping_address'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
