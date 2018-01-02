<?php

class Resource extends \Eloquent
{


    /**
     * @var array
     */
    protected $fillable = ['name', 'parent_id', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Resource', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Resource', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'resource_role', 'resource_id', 'role_id')->withPivot('status');
    }

    public static function fetchResourcesTree($startWith = 0)
    {
        $sql = <<<SQL
SELECT  CONCAT(REPEAT('    ', level - 1), CAST(hi.id AS CHAR)) AS treeitem, parent_id, level
FROM    (
        SELECT  get_resources_tree_list(id) AS id, @level AS level
        FROM    (
                SELECT  @start_with := $startWith,
                        @id := @start_with,
                        @level := 0
                ) vars, resources
        WHERE   @id IS NOT NULL
        ) ho
JOIN    resources hi
ON      hi.id = ho.id;

SELECT  get_resources_tree_list();
SQL;
        dd($sql);
        DB:
        statement(DB::RAW($sql));
    }
}