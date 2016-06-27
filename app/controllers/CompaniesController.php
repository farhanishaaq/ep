<?php

class CompaniesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /companies
	 *
	 * @return Response
	 */
	public function index()
	{
		$companies = Company::paginate(10);
        return View::make('companies.index', compact('companies'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /companies/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('companies.create');
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
        $validator = Validator::make($data, array('password' => 'min:6','email' => 'unique:users', 'status' => 'required', 'company_name' => 'required', 'company_address' => 'required'));

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $company = Company::create(['name' => $data['company_name'], 'address' => $data['company_address']]);

        $employee = new Employee();
        $employee->company_id = $company->id;
        $employee->name = Input::get('name');
        $employee->password = Hash::make(Input::get('password'));
        $employee->email = Input::get('email');
        $employee->gender = Input::get('gender');
        $employee->age = Input::get('age');
        $employee->city = Input::get('city');
        $employee->country = Input::get('country');
        $employee->address = Input::get('address');

        if(Input::get('phone') == ''){
            $employee->phone = 'N/A';
        }else {
            $employee->phone = Input::get('phone');
        }

        if(Input::get('cnic') == ''){
            $employee->cnic = 'N/A';
        }else {
            $employee->cnic = Input::get('cnic');
        }

        if(Input::get('branch') == ''){
            $employee->branch = 'N/A';
        }else {
            $employee->branch = Input::get('branch');
        }

        if(Input::get('note') == ''){
            $employee->note = 'N/A';
        }else {
            $employee->note = Input::get('note');
        }

        $employee->status = Input::get('status');
        $employee->role = 'Administrator';
        $employee->save();

        $data = ['link' => URL::to('login'), 'name' => Input::get('name')];
//      Send email to employee
        Mail::queue('emails.welcome', $data, function($message)
        {
            $message->to(Input::get('email'), Input::get('name'))->subject('Welcome to EMR!');
        });

        return Redirect::route('companies.index');
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
        $company = Company::find($id);
        $admin = Employee::where('role', 'Administrator')->where('company_id', $company->id)->first();
        return View::make('companies.show', compact('company', 'admin'));
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
		$company = Company::find($id);
        $admin = Employee::where('role', 'Administrator')->where('company_id', $company->id)->first();
        return View::make('companies.edit', compact('company', 'admin'));
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
        $company = Company::findOrFail($id);
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

        return Redirect::route('companies.index');
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
        Company::destroy($id);

        return Redirect::route('companies.index');
	}

}