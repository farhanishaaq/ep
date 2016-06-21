<?php
use App\Globals\Ep;
use App\Globals\GlobalsConst;

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of employees
	 *
	 * @return Response
	 */
	public function index()
	{
		$employees = Employee::where('company_id', Auth::user()->company_id)->paginate(10);

		return View::make('employees.index', compact('employees'));
	}

	/**
	 * Show the form for creating a new employee
	 *
	 * @return Response
	 */
	public function create()
	{
        $formMode = GlobalsConst::FORM_CREATE;
		return View::make('employees.create')->nest('_form','employees.partials._form',compact('formMode'));
	}

	/**
	 * Store a newly created employee in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
        $validator = Validator::make($data, array('password' => 'min:6','email' => 'unique:employees', 'status' => 'required', 'role' => 'required'));

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $employee = new Employee();
        $employee->name = Input::get('name');
        $employee->company_id = Auth::user()->company_id;
        $employee->password = Hash::make(Input::get('password'));
        $employee->email = Input::get('email');
//        $employee->gender = Ep::getSwitchButtonVal(Input::get('gender'),GlobalsConst::MALE,GlobalsConst::FEMALE);
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

        $employee->status = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
        $employee->role = Input::get('role');
        $employee->save();

        $data = ['link' => URL::to('login'), 'name' => Input::get('name')];
//      Send email to employee
        Mail::queue('emails.welcome', $data, function($message)
        {
            $message->to(Input::get('email'), Input::get('name'))->subject('Welcome to EMR!');
        });

		return Redirect::route('employees.index');
	}

	/**
	 * Display the specified employee.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$employee = Employee::findOrFail($id);
        return View::make('employees.show')->nest('_view','employees.partials._view', compact('employee'));
	}

	/**
	 * Show the form for editing the specified employee.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formMode = GlobalsConst::FORM_EDIT;
		$employee = Employee::find($id);
		return View::make('employees.edit')->nest('_form','employees.partials._form',compact('formMode','employee'));
	}

	/**
	 * Update the specified employee in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$employee = Employee::findOrFail($id);

        if (Input::get('email') !== $employee->email) {
            $input = array('email' => Input::get('email'));
            $validator = Validator::make($input, array('email' => 'unique:employees'));

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

        }

        $data = Input::all();
        $validator = Validator::make($data, array('status' => 'required', 'role' => 'required'));

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data['status'] = Ep::getSwitchButtonVal(Input::get('status'),GlobalsConst::STATUS_ON,GlobalsConst::STATUS_OFF);
//        $data['gender'] = Ep::getSwitchButtonVal(Input::get('gender'),GlobalsConst::MALE,GlobalsConst::FEMALE);
		$employee->update($data);

		return Redirect::route('employees.index');
	}

	/**
	 * Remove the specified employee from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Employee::destroy($id);
		return Redirect::route('employees.index');
	}


    // ========================= User Validation ========================= //
    



}
