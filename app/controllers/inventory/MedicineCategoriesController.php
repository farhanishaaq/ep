<?php
namespace App\Controllers\Inventory;
use App\Globals\Ep;
use App\Globals\GlobalsConst;
use Illuminate\Support\Facades\Input;
use \MedicineCategory;
use \View;

class MedicineCategoriesController extends \BaseController
{


    public function index()
    {
        $medicineCategories = MedicineCategory::fetchMedicineCategories();
        return View::make('inventory.medicine_categories.index')->nest('_list','inventory.medicine_categories.partials._list', compact('medicineCategories'));
    }


    public function create()
    {
        $formMode = GlobalsConst::FORM_CREATE;
        return View::make('inventory.medicine_purchases.create')->nest('_form','inventory.medicine_categories.partials._form',compact('formMode'));

    }


    public function store()
    {
        $data = Input::all();
        $result = MedicineCategory::saveMedicineCategories($data);
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
