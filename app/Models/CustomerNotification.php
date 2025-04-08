<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsMultiSource;

/**
 * Class CustomerNotification
 *
 * @property int $id
 * @property int $address_id
 * @property string $message
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Address $address
 * @property User $user
 *
 * @package App\Models
 */
class CustomerNotification extends Model
{

    use AsMultiSource;

	protected $table = 'customer_notifications';

	protected $casts = [
		'address_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'address_id',
		'message',
		'user_id'
	];

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
