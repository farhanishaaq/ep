<?php

class Image extends \Eloquent {
	protected $fillable = ['article_id','doctor_id','image'];

    public function saveImage ($destinationPath,$filename){
//          dd($destinationPath,$filename);
        $doctor_id = Auth::user()->id;

        $imagepath=$filename;
//        dd($imagepath);

        $this->doctor_id = $doctor_id;

        $this->image = $imagepath;
        $this->save();
        return 'sucess';
    }




}