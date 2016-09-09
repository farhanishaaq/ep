<?php


use App\Globals\GlobalsConst;

class MedicinePurchaseDetail extends \Eloquent {
	public $timestamps = false;
	protected $fillable = ['medicine_id','purchase_id','unit_price','quantity'];

	public static $rules = [
		'medicine_id' => 'required',
//		'purchase_id' => 'required',
		'unit_price' => 'required',
		'quantity' => 'required',

	];

	public function medicineSale()
	{
		return $this->belongsTo('MedicineSale');
	}

	public function medicinePurchases()
	{
		return $this->hasMany('MedicinePurchase');
	}

	public static function saveMedicinePurchaseDetail($data,$dataProcessType=GlobalsConst::DATA_SAVE){
		$vRules = MedicinePurchaseDetail::$rules;
		$response = NULL;
		$medicineIds = $data['medicine_id'];
		foreach ($medicineIds as $k => $mId){
			if($k == -1){
				continue;
			}
			if($dataProcessType==GlobalsConst::DATA_SAVE){
				$medicine_purchase_detail = new MedicinePurchaseDetail();
			}elseif($dataProcessType==GlobalsConst::DATA_UPDATE){

				$id = isset($data['MedicinePurchaseDetailId']) ? $data['MedicinePurchaseDetailId'] : '';
				if($id != ''){
					$medicine_purchase_detail = MedicinePurchaseDetail::find($id);
				}else{
					return $response = ['success'=>false, 'error'=> true, 'message' => ' Medicine purchase detail record did not find for updation! '];
				}
			}

			//*****Start Rules Validators
			$validator = Validator::make($data, $vRules);
			if ($validator->fails())
			{
				return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
			}
			//*****End Rules Validators

			$medicine_purchase_detail->purchase_id   = $data['MedicinePurchaseID'];
			$medicine_purchase_detail->medicine_id   = $data['medicine_id'][$k];
			$medicine_purchase_detail->unit_price    = $data['unit_price'][$k];
			$medicine_purchase_detail->quantity      = $data['quantity'][$k];

			$medicine_purchase_detail->save();

		}
		$response = ['success'=>true, 'error'=> false, 'message'=> 'Medicine Purchase Detail has been saved successfully!'];
		return $response;
	}

} // end of class