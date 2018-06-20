<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 12:47:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Account
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $username
 * @property string $password
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $groups
 *
 * @package App\Models
 */
class Account extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'url',
		'username',
		'password',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}

	public function groups()
	{
		return $this->belongsToMany(\App\Group::class, 'group_account');
	}
}
