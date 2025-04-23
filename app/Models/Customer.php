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
use Illuminate\Foundation\Auth\User;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $name
 * @property string $middle_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $number
 * @property string $password
 * @property int $address_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Address $address
 * @property Collection|Feedback[] $feedback
 * @property Collection|Request[] $requests
 *
 * @package App\Models
 */
class Customer extends User
{

    use AsSource, Filterable;

	protected $table = 'customers';

	protected $casts = [
		'address_id' => 'int',
	];

	protected $hidden = [
		'password',
	];

	protected $fillable = [
		'name',
		'middle_name',
		'last_name',
		'email',
		'number',
		'password',
		'address_id',
	];

    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->middle_name} {$this->last_name}";
    }

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public function feedback()
	{
		return $this->hasMany(Feedback::class);
	}

	public function requests()
	{
		return $this->hasMany(Request::class);
	}
}
