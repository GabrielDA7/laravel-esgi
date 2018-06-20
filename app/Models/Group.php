<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 12:47:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Group
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $accounts
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Group extends Eloquent
{
	protected $fillable = [
		'name',
		'author'
	];

	public function accounts()
	{
		return $this->belongsToMany(\App\Models\Account::class, 'group_account');
	}

	public function users()
	{
		return $this->belongsToMany(\App\User::class);
	}
}
