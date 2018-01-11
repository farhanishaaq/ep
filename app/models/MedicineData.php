<?php

class MedicineData extends \Eloquent {
    protected $fillable = [''];


    public function getMedicineList(){

        $queryBuilder = DB::table('medicine_data')
            ->get();
        return $queryBuilder;

    }


}