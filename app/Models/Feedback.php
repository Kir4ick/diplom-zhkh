<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsMultiSource;

/**
 * Class Feedback
 *
 * @property int $id
 * @property string $subject
 * @property string $message
 * @property int $customer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Customer $customer
 *
 * @package App\Models
 */
class Feedback extends Model
{

    use AsMultiSource;
	protected $table = 'feedbacks';

	protected $casts = [
		'customer_id' => 'int'
	];

	protected $fillable = [
		'subject',
		'message',
		'customer_id'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
