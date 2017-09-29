<?php
use \App\Globals\GlobalsConst;

class BusinessUnitsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /companies
	 *
	 * @return Response
	 */
	public function index()
	{
		$companies = BusinessUnit::skip(0)->take(GlobalsConst::LIST_DATA_LIMIT)->orderBy('id','DESC')->get();
        return View::make('business_units.index', compact('companies'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /companies/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $formMode = GlobalsConst::FORM_CREATE;
        return View::make('business_units.create')->nest('_form','business_units.partials._form',compact('formMode'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /companies
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $data['comeFrom'] = 'Company';
        $response = BusinessUnit::createBusinessUnit($data);
        return $response;
	}

	/**
	 * Display the specified resource.
	 * GET /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $company = BusinessUnit::find($id);
        $admin = User::where('user_type', 'Admin')->where('business_unit_id', $company->id)->first();
        return View::make('business_units.show', compact('company', 'admin'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /companies/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formMode = GlobalsConst::FORM_EDIT;
		$company = BusinessUnit::find($id);
        $admin = User::where('user_type', 'Admin')->where('business_unit_id', $company->id)->first();
        return View::make('business_units.edit')->nest('_form','business_units.partials._form',compact('formMode','company','admin'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = Input::all();
        $company = BusinessUnit::findOrFail($id);
        $admin = Employee::where('role', 'Administrator')->where('company_id', $company->id)->first();

        if ($data['email'] !== $admin->email) {
            $validator = Validator::make($data, array('email' => 'unique:users'));

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

        }

        $company->update(['name' => $data['company_name'], 'address' => $data['company_address']]);

        $admin->name = Input::get('name');
        $admin->email = Input::get('email');
        $admin->gender = Input::get('gender');
        $admin->age = Input::get('age');
        $admin->city = Input::get('city');
        $admin->country = Input::get('country');
        $admin->address = Input::get('address');

        if(Input::get('phone') == ''){
            $admin->phone = 'N/A';
        }else {
            $admin->phone = Input::get('phone');
        }

        if(Input::get('cnic') == ''){
            $admin->cnic = 'N/A';
        }else {
            $admin->cnic = Input::get('cnic');
        }

        if(Input::get('branch') == ''){
            $admin->branch = 'N/A';
        }else {
            $admin->branch = Input::get('branch');
        }

        if(Input::get('note') == ''){
            $admin->note = 'N/A';
        }else {
            $admin->note = Input::get('note');
        }

        $admin->status = Input::get('status');
        $admin->update();

        return Redirect::route('business_units.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        BusinessUnit::destroy($id);

        return Redirect::route('business_units.index');
	}

}