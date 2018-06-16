<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Jun 2018 09:59:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Group
 *
 * @property int $id
 * @property string $name
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
		'name'
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
