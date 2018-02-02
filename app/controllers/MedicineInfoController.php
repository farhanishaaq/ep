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

        $resultset="";



        if (empty($availableTags)){


            $resultset[] = "there is no data";



                    }
                    else{

                        foreach ($availableTags as $key=>$value){
//
                            $resultset[] = $value->PRODUCT_NAME;
                        }
                    }
        return $resultset;

    }
    public function medicineDetail(){

        $data = Input::all();


        $availableMedicine = $this->_medicine->medicinestack($data);

        $namejpge = "";
        $pathname = "";
        $namenull ="";
         $item1 = "";
         $para1 = "";
        $namecontent = "";
        $paratd  = "";
        $paralast  = "";
        $textpara = "";
          $medicineName = "";
        $medicineid = "";

      if (isset($availableMedicine)){

      foreach ($availableMedicine as $key=>$value){

          $medicineName = $value->PRODUCT_NAME;
          $medicineid = $value->id;

          $path = "medicineXML/".$value->SETID;
         if(file_exists($path)){
          $allfiles = File::allFiles($path);

          if(isset($allfiles)){




              foreach ($allfiles as $files){



                  $getpathname = $files->getPathname();
                  $name = $files->getfileName();

                  $file = new Symfony\Component\HttpFoundation\File\File($getpathname);
                  $mime = $file->getMimeType();


                 if ($mime=="application/xml"){



                     $pathname = $files->getPathname();




                 }

//                 elseif ($mime=="image/jpeg"){
//
//
//
//
//
//
//                 }


                 else{

//                     $namenull = $files->getfileName();


                     $namejpge = $files->getPathname();





                 }






              }

          }


         }else{
             $params = [
                 'medicineid'=>$medicineid,
                 'xmlfile' => "There is no Record",
                 'jpgfile'        => "/images/medicines-l.jpg",
                 'MedicineName'        => "No Record",
             ];

             return View::make('medicines.medicineSearch', compact('params'));

         }

      }
      }

        $xml=simplexml_load_file($pathname);

//        $components = $xml->component->structuredBody->component->section;

        if (isset($xml))
        {
        for($i=0;$i<10;$i++) {

            $body = $xml->component->structuredBody->component[$i];
            $bodypara = $xml->component->structuredBody->component[$i];
             $text = $bodypara->section->text;

             if(count($text>0)){

            $textpara = $text->paragraph;
             }else{

                 $textpara = "There is no Record";
             }
        }
        }else{

            $textpara = "There is no Record";

        }


        $params = [
            'medicineid'=>$medicineid,
            'xmlfile' => $textpara,
            'jpgfile'        => $namejpge,
            'MedicineName'        => $medicineName,
        ];













        return View::make('medicines.medicineSearch', compact('params'));





    }

    public function medicineResutl($id){




        $availableMedicine = $this->_medicine->medicineResultset($id);

        $namejpge = "";
        $pathname = "";
        $namenull ="";
        $item1 = "";
        $para1 = "";
        $namecontent = "";
        $paratd  = "";
        $paralast  = "";
        $text = "";
        $medicineName = "";

        if (isset($availableMedicine)){

            foreach ($availableMedicine as $key=>$value){

                $medicineName = $value->PRODUCT_NAME;

                $path = "medicineXML/".$value->SETID;
                if(file_exists($path)){
                    $allfiles = File::allFiles($path);

                    if(isset($allfiles)){




                        foreach ($allfiles as $files){



                            $getpathname = $files->getPathname();
                            $name = $files->getfileName();

                            $file = new Symfony\Component\HttpFoundation\File\File($getpathname);
                            $mime = $file->getMimeType();


                            if ($mime=="application/xml"){



                                $pathname = $files->getPathname();




                            }

//                 elseif ($mime=="image/jpeg"){
//
//
//
//
//
//
//                 }


                            else{

//                     $namenull = $files->getfileName();


                                $namejpge = $files->getPathname();





                            }






                        }

                    }


                }else{
                    $params = [
                        'xmlfile' => "There is no Record",
                        'jpgfile'        => "/images/medicines-l.jpg",
                        'MedicineName'        => "No Record",
                    ];

                    return View::make('medicines.medicineSearch', compact('params'));

                }

            }
        }

        $xml=simplexml_load_file($pathname);

//        $components = $xml->component->structuredBody->component->section;

        if (!$xml==0)
        {
            for($i=0;$i<10;$i++) {

                $body = $xml->component->structuredBody->component[$i];
                $bodypara = $xml->component->structuredBody->component[$i];
                $text = $bodypara->section->text;
                if(count($text>0)){

                    $text = $text->paragraph;
                }else{

                    $text = "There is no Record";
                }
            }
        }else{

            $text = "There is no Record";

        }


        $params = [
            'xmlfile' => $text,
            'jpgfile'        => $namejpge,
            'MedicineName'        => $medicineName,
        ];













        return View::make('medicines.medicineDetail', compact('params'));





    }



}
