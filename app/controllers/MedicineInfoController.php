<?php
use App\Globals\GlobalsConst;

class MedicineInfoController extends \BaseController {

    private $_medicine;
    public function __construct(MedicineInfo $medicine)
    {
        $this->_medicine = $medicine;
    }

    public function index()
    {

    }

    public function getMedicineList()
    {
        $data = $this->_medicine->getMedicineList();
        dd($data);

        return View::make('medicines.medicineList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function medicineSearch(){



        return View::make('medicines.medicineSearch');
    }


    public function medicinename(){

        $data = Input::all();

        $availableTags = $this->_medicine->medicineresult($data);
//         dd($availableTags);
        if (empty($availableTags)){


            $resultset[] = "there is no data";



                    }
                    else{

                        foreach ($availableTags as $key=>$value){
//                    array_push($resultset,$value);
                            $resultset[] = $value->PRODUCT_NAME;
                        }
                    }
        return $resultset;
    }


}
