<?php

class Role extends \Eloquent {

	protected $table = 'roles';

	/**
	 * @var array
	 */
	protected $fillable = ['company_id','name', 'description'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('User');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function resources()
	{
		return $this->belongsToMany('Resource', 'resource_role', 'role_id', 'resource_id')->withPivot('status');
	}
}