<?php

namespace App\Controllers\Inventory;

use App\Globals\Ep;
use App\Globals\GlobalsConst;
use BusinessUnit;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use MedicinePurchase;
use MedicineSale;

class MedicineSalesController extends \BaseController
{


    public function index()
    {
        $medicinePurchases = MedicineSale::fetchMedicineSales();
        return View::make('inventory.medicine_purchases.index')->nest('_list','inventory.medicine_purchases.partials._list', compact('medicinePurchases'));
    }

    public function create()
    {

        $formMode = GlobalsConst::FORM_CREATE;
        $date = date('Y-m-d');
        $company_id = current_company_id();
        $saleNextCount= MedicineSale::max('id')+1;
        $code = MedicineSale::createSaleCode($saleNextCount);
        return View::make('inventory.medicine_sales.create')->nest('_form','inventory.medicine_sales.partials._form',compact('formMode','company_id','code','date'));

    }


    public function store()
    {
        $data = Input::all();
        $result = MedicineSale::saveMedicineSale($data);
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
