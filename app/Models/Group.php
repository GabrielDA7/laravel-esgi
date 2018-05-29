<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 May 2018 14:13:35 +0000.
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
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \App\Models\Share $share
 *
 * @package App\Models
 */
class Group extends Eloquent
{
	protected $fillable = [
		'name'
	];

	public function users()
	{
		return $this->belongsToMany(\App\User::class);
	}

	public function share()
	{
		return $this->hasOne(\App\Models\Share::class);
	}
}
