<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Merchant
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $store_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Merchant extends Model
{
	use HasFactory, HasApiTokens;

	protected $table = 'merchants';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'store_name'
	];

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
