<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /roles
	 *
	 * @return Response
	 */
	private $_role;
	public function __construct(Role $role)
    {
        $this->_role=$role;
    }

    public function index()
	{
		$roles = Role::fetchRoles();
		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = null;
		$controllers=Resource::fetchControllers();
		$actions=Resource::fetchActions();
		$roles = Role::all();

		$formMode = GlobalsConst::FORM_CREATE;
		return View::make('roles.create')->nest('_form','roles.partials._form',compact('formMode','user','controllers','actions','roles'));
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /roles
	 *
	 * @return Response
	 */
	public function store()
	{

     $actions=  array_map('intval', explode(',', Input::get('actions')));
     $role = Input::get('roles');
//    dd($actions);


     if ($actions[0] != 0){
         $this->_role->assignResourceToRole($role,$actions);
         return $this->index();
     }else{

         return $this->index();
     }

	}

	/**
	 * Display the specified resource.
	 * GET /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /roles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}