<?php
use \App\Globals\Ep;


class MedicineSale extends \Eloquent {
	
	protected $fillable = ['patient_id','business_unit_id', 'code','date'];

	public static $rules = [

	];

	public function medicineSaleDetails()
	{
		return $this->hasMany('MedicineSaleDetail');
	}

	public function patient()
	{
		return $this->belongsTo('Patient');
	}

	/**
		Function to save Medicine sale
	 */

	public static function saveMedicineSale($data,$dataProcessType=GlobalsConst::DATA_SAVE)
	{
		$vRules = MedicineSale::$rules;
		$response = null;
		if($dataProcessType==GlobalsConst::DATA_SAVE)
		{
			$medicine_sale = new MedicineSale();
		}else{
			$id = isset($data['medicine_saleId']) ? $data['medicine_saleId'] : '';
			if($id != ""){
				$medicine_sale = MedicineSale::find($id);
				//Delete sale detail on sale edit
				MedicineSaleDetail::where('sale_id','=',$id)->delete();
			}else{
				return $response = ['success'=>false, 'error'=>true, 'message'=>'Medicine Sale record did not find for updation!'];
			}
		}

		//***Start Rules Validators
		$validator = Validator::make($data,$vRules);
		if($validator->fails())
		{
			return ['success'=>false, 'error'=>true, 'validatorErrors'=>$validator->errors()];
		}
		//***End Rules Validators

		$patient_Id = isset($data['patient_id']) ? $data['patient_id'] : null;
		$medicine_sale->business_unit_id = Ep::currentBusinessUnitId();
		$medicine_sale->patient_id 	= $patient_Id;
		$medicine_sale->date 		= $data['date'];
		$medicine_sale->save();

		//passing dumy data to MedicineSaleDetail for testing
		//$data	= ['medicine_id'=>[2,3],'business_unit_id'=>[2,3],'unit_price'=>[2,3],'quantity'=>[2,3]];
		$data['MedicineSaleID'] = $medicine_sale->id;
		$msdResult = MedicineSaleDetail::saveMedicineSaleDetail($data,GlobalsConst::DATA_SAVE);

		$response = ['success'=>true, 'error'=>false, 'message'=>'Medicine Sale has been saved successfully'];
		return $response;
	}

	/**
	 	function to generate code for medicine sale
	 */

	public static function createSaleCode($saleNextCount){

		$date = date('ymd');
		$saleCode = $date ."-". $saleNextCount;
		return $saleCode;
	}

    public static function fetchMedicineSales(array $filterParams = null, $offset=0, $limit=GlobalsConst::LIST_DATA_LIMIT){
        try{
            if(Auth::user()->user_type == GlobalsConst::SUPER_ADMIN){
                $medicinePurchases = self::join('business_units','business_units.id','=','medicine_sales.business_unit_id')
                    ->join('companies','companies.id','=','business_units.company_id');
                $selectArr = ['companies.name As company_name','business_units.name AS business_unit_name', 'medicine_sales.id','business_unit_id','menufacturer_id', 'date'];
            }elseif(Ep::currentUserType() == GlobalsConst::ADMIN){
                $medicinePurchases = self::join('business_units','business_units.id','=','medicine_sales.business_unit_id')
                    ->join('companies','companies.id','=','business_units.company_id')
                    ->where('company_id', Ep::currentCompanyId());
                $selectArr = ['companies.name As company_name','business_units.name AS business_unit_name', 'medicine_sales.id','business_unit_id','menufacturer_id', 'date'];
            }else{
                $medicinePurchases = User::where('company_id', Ep::currentCompanyId())
                    ->where('business_unit_id','=',Ep::currentBusinessUnitId());
                $selectArr = ['"" As company_name','business_units.name AS business_unit_name', 'medicine_sales.id','business_unit_id','menufacturer_id', 'date'];
            }
            if($filterParams){
                $searchKey = isset($filterParams['searchKey']) ? '%' . $filterParams['searchKey'].'%' : '';
                $medicinePurchases->where('full_name','LIKE',$searchKey);
            }

            return $medicinePurchases->select($selectArr)->skip($offset)->take($limit)
                ->orderBy('id','DESC')->get();
        }
        catch (Throwable $t) {
            // Executed only in PHP 7, will not match in PHP 5.x
            dd($t->getMessage());
        }
        catch (Exception $e){
            dd($e->getMessage());
        }

    }
}