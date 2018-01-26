<?php

class Image extends \Eloquent {
    protected $fillable = ['article_id','doctor_id','image'];

    public function article(){

        return $this->belongsTo("Article");
    }

    public function saveImage ($filename,$articleid){
//          dd($destinationPath,$filename);
        $doctor_id = Auth::user()->id;


        $imagepath=$filename;


        $this->article_id = $articleid;
        $this->doctor_id = $doctor_id;

        $this->image = $imagepath;
        $this->save();
        return 'sucess';
    }

    public function updateImage ($filename, $articleid, $destinationPath){
//          dd($destinationPath,$filename);
        $doctor_id = Auth::user()->id;


        $imagepath=$filename;




        DB::table('images')
            ->where('id', $articleid)
            ->update(array('image' => $imagepath, 'doctor_id' => $doctor_id));

        $this->update();


        return 'sucess';
    }
    public function saveProfileImage ($filename,$articleid){
//          dd($destinationPath,$filename);
        $doctor_id = Auth::user()->id;

        $imagepath=$filename;

        $this->ImagePath = $imagepath;
        $this->save();
        return 'sucess';
    }







}