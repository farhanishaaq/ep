<?php
namespace App\Controllers\Inventory;
use App\Globals\Ep;
use App\Globals\GlobalsConst;
use \MedicinePurchase;
use \View;

class MedicinePurchasesController extends \BaseController
{


    public function index()
    {
        $medicinePurchases = MedicinePurchase::fetchMedicinePurchases();
        return View::make('inventory.medicine_purchases.index')->nest('_list','inventory.medicine_purchases.partials._list', compact('medicinePurchases'));
    }


    public function create()
    {
        $data = Input::all();
        $formMode = GlobalsConst::FORM_CREATE;
       // $company_id = 1;
        //return "i am here";
        $date = date('Y-m-d');
        $company_id = current_company_id();
        $purchaseNextCount= MedicinePurchase::max('id')+1;
        $code = MedicinePurchase::createPurchaseCode($purchaseNextCount);
        return View::make('inventory.medicine_purchases.create')->nest('_form','inventory.medicine_purchases.partials._form',compact('formMode','company_id','date','purchaseNextCount','code'));

    }


    public function store()
    {
        $data = Input::all();
        $result = MedicinePurchase::saveMedicinePurchase($data);
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
