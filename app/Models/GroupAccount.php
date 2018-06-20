<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 12:47:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GroupAccount
 *
 * @property int $group_id
 * @property int $account_id
 *
 * @property \App\Models\Account $account
 * @property \App\Models\Group $group
 *
 * @package App\Models
 */
class GroupAccount extends Eloquent
{
	protected $table = 'group_account';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int',
		'account_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'account_id'
	];

	public function account()
	{
		return $this->belongsTo(\App\Models\Account::class);
	}

	public function group()
	{
		return $this->belongsTo(\App\Models\Group::class);
	}
}
