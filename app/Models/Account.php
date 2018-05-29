<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 May 2018 14:13:35 +0000.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Share $share
 *
 * @package App\Models
 */
class Account extends Eloquent
{
	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'url',
		'username',
		'password'
	];

	public function share()
	{
		return $this->hasOne(\App\Models\Share::class);
	}
}
