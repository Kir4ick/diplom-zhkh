<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Request
 * 
 * @property int $id
 * @property int $customer_id
 * @property string|null $phone
 * @property string $status
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer $customer
 * @property User $user
 *
 * @package App\Models
 */
class Request extends Model
{
	protected $table = 'requests';

	protected $casts = [
		'customer_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'phone',
		'status',
		'user_id'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
