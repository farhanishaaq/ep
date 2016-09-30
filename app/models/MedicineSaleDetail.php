<?php



class MedicineSaleDetail extends \Eloquent {
	public $timestamps = false;
	protected $fillable = ['medicine_id','sale_id','quantity'];

	public static $rules = [
		'medicine_id' => 'required',
		'quantity' => 'required',
		'unit_price' => 'required',

	];
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function medicineSale()
	{
		return $this->belongsTo('MedicineSale');
	}

	public function medicine()
	{
		return $this->belongsTo('Medicine');
	}

	/**
		Function to save Medicine sale detail
	 */

	public static function saveMedicineSaleDetail($data,$dataProcessType=GlobalsConst::DATA_SAVE)
	{
		$vRules = MedicineSaleDetail::$rules;
		$response = null;
		$medicineIds = $data['medicine_id'];
		foreach($medicineIds as $k => $mId)
		{
			if($k == -1){
				continue;
			}
			if($dataProcessType==GlobalsConst::DATA_SAVE){
				$medicine_sale_detail = new MedicineSaleDetail();

			}elseif($dataProcessType==GlobalsConst::DATA_UPDATE) {
				$id = isset($data['MedicineSaleDetailId']) ? $data['MedicineSaleDetailId'] : '';
				if($id != null){
					$medicine_sale_detail = MedicineSaleDetail::find($id);
				}
				else{
					return $response = ['success'=>false, 'error'=>true,'message' => ' Medicine sale detail record did not find for updation! '];
				}
			}

			//*****Start Rules Validators
			$validator = Validator::make($data, $vRules);
			if ($validator->fails())
			{
				return ['success'=>false, 'error'=> true, 'validatorErrors'=>$validator->errors()];
			}
			//*****End Rules Validators

			$medicine_sale_detail->sale_id			=	$data['MedicineSaleID'];
			$medicine_sale_detail->medicine_id 		= 	$data['medicine_id'][$k];
			$medicine_sale_detail->unit_price		= 	$data['unit_price'][$k];
			$medicine_sale_detail->quantity			=	$data['quantity'][$k];
			$medicine_sale_detail->save();
		}
		$response = ['success'=>true, 'error'=> false, 'message'=> 'Medicine Sale Detail has been saved successfully!'];
		return $response;

	}
} //*** end of MedicineSaleDetail class












