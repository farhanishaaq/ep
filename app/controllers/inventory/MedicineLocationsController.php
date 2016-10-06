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
use \MedicineLocation;
use \View;

class MedicineLocationsController extends \BaseController
{

    public function index()
    {
        dd('inside index');
   }


    public function create()
    {
          $formMode = GlobalsConst::FORM_CREATE;
          return View::make('inventory.medicine_locations.create')->nest('_form','inventory.medicine_locations.partials._form',compact('formMode'));
    }


    public function store()
    {
        $data = Input::all();
        $result = MedicineLocation::saveMedicineLocation($data);
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