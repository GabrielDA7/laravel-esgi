<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 May 2018 21:10:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Share
 * 
 * @property int $group_id
 * @property int $account_id
 * 
 * @property \App\Models\Account $account
 * @property \App\Models\Group $group
 *
 * @package App\Models
 */
class Share extends Eloquent
{
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
