<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblVendor
 * 
 * @property int $vendor_id
 * @property string $vendor_sage_id
 * @property int $vendor_creating_user_id
 * @property string $vendor_name
 * @property string $vendor_address
 * @property string $vendor_address2
 * @property int $vendor_state
 * @property int $vendor_city
 * @property string $vendor_zipcode
 * @property string $vendor_finance_phoneno
 * @property string $vendor_sales_phoneno
 * @property string $vendor_fax
 * @property string $vendor_email
 * @property string $vendor_contact_person
 * @property string $vendor_account_number
 * @property string $vendor_tax
 * @property float $vendor_taxrate
 * @property float $vendor_discount
 * @property string $vendor_notes
 * @property bool $vendor_is_approved
 * @property Carbon $vendor_creation_datetime
 *
 * @package App\Models
 */
class TblVendor extends Model
{
	protected $table = 'tbl_vendor';
	protected $primaryKey = 'vendor_id';
	public $timestamps = false;

	protected $casts = [
		'vendor_creating_user_id' => 'int',
		'vendor_state' => 'int',
		'vendor_city' => 'int',
		'vendor_taxrate' => 'float',
		'vendor_discount' => 'float',
		'vendor_is_approved' => 'bool'
	];

	protected $dates = [
		'vendor_creation_datetime'
	];

	protected $fillable = [
		'vendor_sage_id',
		'vendor_creating_user_id',
		'vendor_name',
		'vendor_address',
		'vendor_address2',
		'vendor_state',
		'vendor_city',
		'vendor_zipcode',
		'vendor_finance_phoneno',
		'vendor_sales_phoneno',
		'vendor_fax',
		'vendor_email',
		'vendor_contact_person',
		'vendor_account_number',
		'vendor_tax',
		'vendor_taxrate',
		'vendor_discount',
		'vendor_notes',
		'vendor_is_approved',
		'vendor_creation_datetime'
	];
}
