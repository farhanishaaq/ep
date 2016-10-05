<?php
namespace App\Controllers\Inventory;
use App\Globals\Ep;
use App\Globals\GlobalsConst;
use Illuminate\Support\Facades\Input;
use MedicineStock;
use \View;

class MedicineStocksController extends \BaseController
{


    public function index()
    {

    }


    public function create()
    {
        $formMode = GlobalsConst::FORM_CREATE;
        $company_id = current_company_id();
        return View::make('inventory.medicine_stocks.create')->nest('_form','inventory.medicine_stocks.partials._form',compact('formMode','company_id'));
    }


    public function store()
    {
        $data = Input::all();
        $result = MedicineStock::saveMedicineStock($data,GlobalsConst::DATA_SAVE);
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
