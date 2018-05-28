<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 16 May 2018 17:20:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Post
 *
 * @property int $id
 * @property int $author
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Post extends Eloquent
{
	protected $casts = [
		'author' => 'int'
	];

	protected $fillable = [
		'author',
		'content'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'author');
	}
}
