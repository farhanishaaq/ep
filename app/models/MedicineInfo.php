<?php

class MedicineInfo extends \Eloquent {
    protected $fillable = ['SETID','SPL_VERSION','PRODUCT_NAME ','PRODUCT_CODE','NDC','PACKAGE_DESCRIPTION','FORM_CODE','TOTAL_PRODUCT_QUANTITY'];


    public function getMedicineList(){

        $queryBuilder = DB::table('medicine_data')
            ->get();
        return $queryBuilder;

    }

    public function medicineresult($data){

//        $queryBuilder = DB::table('medicine_data')
//            ->get('PRODUCT_NAME');
        $queryBuilder = DB::table('medicineinfo')->select('PRODUCT_NAME')
            ->where('PRODUCT_NAME','LIKE','%'.$data['name'].'%')
            ->paginate(7);
//            ->get();


        return $queryBuilder;

    }

    public function medicinestack($data){


        $queryBuilder = DB::table('medicineinfo')
            ->where('PRODUCT_NAME','like','%'.$data['medicine'].'%')
            ->get();



        return $queryBuilder;


    }


    public function medicineResultset($id){


        $queryBuilder = DB::table('medicineinfo')
            ->where('id','=',$id)
            ->get();



        return $queryBuilder;

    }




}