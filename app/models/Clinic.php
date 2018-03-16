<?php



class Clinic extends \Eloquent {
	protected $fillable = ['name','address',"clinic_id"];

	public function doctor(){
       return $this->belongsToMany('Doctor');
    }

    public function city(){
        return $this->hasOne('City');
    }


    /**
     * @param string name
     * @return string
     */
    // for selector on search page
    public function getClinicForSelector(array $data){
        $name=$data['name'];
        $city_id=$data['city_id'];
        $clinics=DB::table('clinics')
            ->select("id","name")
            ->where("name","LIKE","%$name%");
        if($city_id !=""){
          $clinics=  $clinics->where("city_id",$city_id)
                ->paginate('10');
        }else{
            $clinics =$clinics->paginate('10');
        }

    return $clinics;
    }

}