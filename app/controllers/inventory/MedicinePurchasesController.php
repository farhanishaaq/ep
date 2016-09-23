<?php
namespace inventory;
use App\Globals\Ep;
use App\Globals\GlobalsConst;
use BusinessUnit;
use Illuminate\Support\Facades\View;


class MedicinePurchasesController extends \BaseController
{


    public function index()
    {

    }

    public function create()
    {

        $formMode = GlobalsConst::FORM_CREATE;
        $business_unit = BusinessUnit::lists('name','id');
        dd($business_unit);
        $medicines = null;

         return View::make('medicine_purchases.create')->nest('_form','medicine_purchases.partials._form',compact('formMode','medicines','business_unit','menufacturer_id','code','date'));

    }


    public function store()
    {
        $data = Input::all();
       // dd($data);
        $result = Prescription::savePrescription($data);
        return $result;
    }


    public function show($id)
    {
    }


    public function edit($id)
    {

    }

    public function update($id)
    {
    }


    public function destroy($id)
    {
    }


}
