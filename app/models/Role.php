<?php

use \App\Globals\Ep;
use App\Globals\GlobalsConst;

class Role extends \Eloquent
{

    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'description'];

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

    /**
     * @param array|null $filterParams
     * @param int $offset
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function fetchRoles(array $filterParams = null, $offset = 0, $limit = GlobalsConst::LIST_DATA_LIMIT)
    {
        try {
            if (Ep::currentUserType() == GlobalsConst::SUPER_ADMIN) {
                $roles = self::all();
            } elseif (Ep::currentUserType() == GlobalsConst::ADMIN) {
                $roles = self::where('company_id', Ep::currentCompanyId());
            } else {
                $roles = self::select(['roles.id', 'roles.name'])
                    ->leftJoin('role_user AS ru', 'ru.role_id', '=', 'roles.id')
                    ->leftJoin('users AS u', 'u.id', '=', 'ru.user_id')
                    ->where('roles.company_id', '=', Ep::currentCompanyId())
                    ->whereRaw('(`u`.`user_type` != "' . GlobalsConst::ADMIN . '" || `u`.`user_type` IS NULL)')
                    ->groupBy('roles.name');
            }
            if ($filterParams) {
                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'] . '%' : '';
                $roles->where('full_name', 'LIKE', $searchKey);
            }
            /*dd($roles->skip($offset)->take($limit)
                ->orderBy('roles.id','DESC')->toSql());*/

            return $roles->skip($offset)->take($limit)
                ->orderBy('roles.id', 'DESC')->get();
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }


}