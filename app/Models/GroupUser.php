<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Jun 2018 09:59:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GroupUser
 *
 * @property int $group_id
 * @property int $user_id
 *
 * @property \App\Models\Group $group
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class GroupUser extends Eloquent
{
	protected $table = 'group_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'user_id'
	];

	public function group()
	{
		return $this->belongsTo(\App\Models\Group::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}
