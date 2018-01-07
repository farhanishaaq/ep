<?php


use App\Globals\GlobalsConst;
use \App\Globals\Ep;

class MedicinePurchase extends \Eloquent
{

    protected $fillable = ['business_unit_id', 'manufacturer_id', 'date'];
    public static $rules = [
        'business_unit_id' => 'required',
        'menufacturer_id' => 'required',
    ];

    public function purchaseDetails()
    {
        return $this->hasMany('MedicinePurchaseDetail');
    }

    public function businessUnit()
    {
        return $this->belongsTo('BusinessUnit');
    }

    public function manufacturer()
    {
        return $this->belongsTo('MedicineManufacturer');
    }

    public static function saveMedicinePurchase($data, $dataProcessType = GlobalsConst::DATA_SAVE)
    {

        $vRules = MedicinePurchase::$rules;
        $response = null;
        if ($dataProcessType == GlobalsConst::DATA_SAVE) {
            $medicine_purchase = new MedicinePurchase();
        } else {
            $id = isset($data['medicine_purchaseId']) ? $data['medicine_purchaseId'] : '';
            if ($id != "") {
                $medicine_purchase = MedicinePurchase::find($id);
                //Delete purchase Detail on purchase Edit
                MedicinePurchaseDetail::where('purchase_id', '=', $id)->delete();
            } else {
                return $response = ['success' => false, 'error' => true, 'message' => 'Medicine Purchase record did not find for updation! '];
            }
        }

        //*****Start Rules Validators
        $validator = Validator::make($data, $vRules);
        if ($validator->fails()) {
            return ['success' => false, 'error' => true, 'validatorErrors' => $validator->errors()];
        }
        //*****End Rules Validators

        $medicine_menufacturerId = isset($data['menufacturer_id']) ? $data['menufacturer_id'] : null;

        $medicine_purchase->menufacturer_id = $medicine_menufacturerId;
        $medicine_purchase->business_unit_id = Ep::currentBusinessUnitId();
        $medicine_purchase->date = $data['date'];
        $medicine_purchase->code = $data['code'];
        $medicine_purchase->save();

        //passing dummy data to purchaseDetail for testing
        //$data = ['MedicinePurchaseID'=>$medicine_purchases->id,'medicine_id'=>['0'=>1,'1'=>2],'unit_price'=>['0'=>10,'1'=>20],'quantity'=>['0'=>100,'1'=>200]];
        $data['MedicinePurchaseID'] = $medicine_purchase->id;
        $mpdResult = MedicinePurchaseDetail::saveMedicinePurchaseDetail($data, GlobalsConst::DATA_SAVE);

        //passing dummy data to purchaseDetail for testing
        //$data 	   = ['medicine_id'=>1,'business_unit_id'=>1,'location_id'=>1,'minimum_quantity'=>5,'quantity'=>7];

        //$msResult  = MedicineStock::saveMedicineStock($data,GlobalsConst::DATA_SAVE);
        $response = ['success' => 'true', 'error' => 'false', 'message' => 'Medicine purchase has been saved successfully!'];
        return $response;
    }

    public static function createPurchaseCode($purchaseNextCount)
    {

        $date = date('ymd');
        $purchaseCode = $date . "-" . $purchaseNextCount;
        return $purchaseCode;
    }

    //
    public static function fetchMedicinePurchases(array $filterParams = null, $offset = 0, $limit = GlobalsConst::LIST_DATA_LIMIT)
    {
        try {
            if (Auth::user()->user_type == GlobalsConst::SUPER_ADMIN) {
                $medicinePurchases = self::join('business_units', 'business_units.id', '=', 'medicine_purchases.business_unit_id')
                    ->join('companies', 'companies.id', '=', 'business_units.company_id');
                $selectArr = ['companies.name As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            } elseif (Ep::currentUserType() == GlobalsConst::ADMIN) {
                $medicinePurchases = self::join('business_units', 'business_units.id', '=', 'medicine_purchases.business_unit_id')
                    ->join('companies', 'companies.id', '=', 'business_units.company_id')
                    ->where('company_id', Ep::currentCompanyId());
                $selectArr = ['companies.name As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            } else {
                $medicinePurchases = User::where('company_id', Ep::currentCompanyId())
                    ->where('business_unit_id', '=', Ep::currentBusinessUnitId());
                $selectArr = ['"" As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            }
            if ($filterParams) {
                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'] . '%' : '';
                $medicinePurchases->where('full_name', 'LIKE', $searchKey);
            }

            return $medicinePurchases->select($selectArr)->skip($offset)->take($limit)
                ->orderBy('id', 'DESC')->get();
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * This function fetch medicine stock data from database
     */
    public static function fetchMedicineStock(array $filterParams = null, $offset = 0, $limit = GlobalsConst::LIST_DATA_LIMIT)
    {
        try {
            if (Auth::user()->user_type == GlobalsConst::SUPER_ADMIN) {
                $medicinePurchases = self::join('business_units', 'business_units.id', '=', 'medicine_purchases.business_unit_id')
                    ->join('companies', 'companies.id', '=', 'business_units.company_id');
                $selectArr = ['companies.name As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            } elseif (Ep::currentUserType() == GlobalsConst::ADMIN) {
                $medicinePurchases = self::join('business_units', 'business_units.id', '=', 'medicine_purchases.business_unit_id')
                    ->join('companies', 'companies.id', '=', 'business_units.company_id')
                    ->where('company_id', Ep::currentCompanyId());
                $selectArr = ['companies.name As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            } else {
                $medicinePurchases = User::where('company_id', Ep::currentCompanyId())
                    ->where('business_unit_id', '=', Ep::currentBusinessUnitId());
                $selectArr = ['"" As company_name', 'business_units.name AS business_unit_name', 'medicine_purchases.id', 'business_unit_id', 'menufacturer_id', 'date'];
            }
            if ($filterParams) {
                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'] . '%' : '';
                $medicinePurchases->where('full_name', 'LIKE', $searchKey);
            }

            return $medicinePurchases->select($selectArr)->skip($offset)->take($limit)
                ->orderBy('id', 'DESC')->get();
        } catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}