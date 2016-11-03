<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 10/6/2016
 * Time: 4:07 AM
 */

namespace App\Controllers\Inventory;
use App\Globals\Ep;
use App\Globals\GlobalsConst;
use Illuminate\Support\Facades\Input;
use \MedicineMenufacturer;
use \View;

class MedicineMenufacturersController extends \BaseController
{

    public function index()
    {
        $medicineMenufacturers = MedicineMenufacturer::fetchMedicineMenufacturers();
        return View::make('inventory.medicine_menufacturers.index')->nest('_list','inventory.medicine_menufacturers.partials._list', compact('medicineMenufacturers'));
    }


    public function create()
    {
        $formMode = GlobalsConst::FORM_CREATE;
        return View::make('inventory.medicine_menufacturers.create')->nest('_form','inventory.medicine_menufacturers.partials._form',compact('formMode'));
    }


    public function store()
    {
        $data = Input::all();
        $result = MedicineMenufacturer::saveMedicineMenufacturer($data);
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