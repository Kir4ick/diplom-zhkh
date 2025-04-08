<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Address
 *
 * @property int $id
 * @property string $street
 * @property string $house_type
 * @property int $number
 * @property int|null $block
 * @property int|null $postal_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|CustomerNotification[] $customer_notifications
 * @property Collection|Customer[] $customers
 *
 * @package App\Models
 */
class Address extends Model
{

    use AsSource, Filterable;

	protected $table = 'addresses';

	protected $casts = [
		'number' => 'int',
		'block' => 'int',
		'postal_code' => 'int',
	];

	protected $fillable = [
		'street',
		'house_type',
		'number',
		'block',
		'postal_code',
	];

    public function getFullAttribute(): string
    {
        return sprintf(
            'ул. %s, дом %s, %s, почтовый индекс: %s',
            $this->street,
            $this->number,
            $this->block == null ? '' : 'к. ' . $this->block,
            $this->postal_code
        );
    }

	public function customer_notifications()
	{
		return $this->hasMany(CustomerNotification::class);
	}

	public function customers()
	{
		return $this->hasMany(Customer::class);
	}
}
