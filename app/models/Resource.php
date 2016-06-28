<?php

class Resource extends \Eloquent {

	
	/**
	 * @var array
	 */
	protected $fillable = ['name', 'parent_id', 'type'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children(){
		return $this->hasMany('Resource', 'parent_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent(){
		return $this->belongsTo('Resource', 'parent_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany('Role', 'resource_role', 'resource_id', 'role_id')->withPivot('status');
	}
}