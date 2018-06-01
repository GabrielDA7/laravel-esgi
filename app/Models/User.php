<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 May 2018 21:10:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $accounts
 * @property \Illuminate\Database\Eloquent\Collection $groups
 * @property \Illuminate\Database\Eloquent\Collection $posts
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'remember_token'
	];

	public function accounts()
	{
		return $this->hasMany(\App\Models\Account::class);
	}

	public function groups()
	{
		return $this->belongsToMany(\App\Models\Group::class);
	}

	public function posts()
	{
		return $this->hasMany(\App\Models\Post::class, 'author');
	}
}
