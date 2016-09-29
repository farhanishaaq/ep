<?php

namespace App\Controllers\Inventory;

use App\Globals\Ep;
use App\Globals\GlobalsConst;
use BusinessUnit;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use MedicinePurchase;

class MedicineSalesController extends \BaseController
{


    public function index()
    {
        dd('KKKK');
    }

    public function create()
    {

        $formMode = GlobalsConst::FORM_CREATE;
       // $company_id = 1;
        //return "i am here";
        $date = date('ymd');
        $company_id = current_company_id();
        return View::make('inventory.medicine_purchases.create')->nest('_form','inventory.medicine_purchases.partials._form',compact('formMode','company_id','code','date'));

    }


    public function store()
    {
        $data = Input::all();
        $result = MedicinePurchase::saveMedicinePurchase($data);
//        dd($data);
//        $result = Prescription::savePrescription($data);
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
