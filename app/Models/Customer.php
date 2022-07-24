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
 * Class Customer
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Cart[] $carts
 *
 * @package App\Models
 */
class Customer extends Model
{
	use HasFactory, HasApiTokens;
	protected $table = 'customers';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}
}
