<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 May 2018 21:10:09 +0000.
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
 * @property \App\Models\Share $share
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
		return $this->belongsTo(\App\Models\User::class);
	}

	public function share()
	{
		return $this->hasOne(\App\Models\Share::class);
	}
}
