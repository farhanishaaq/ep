<?php

class MedicalSpecialty extends \Eloquent
{

    protected $fillable = ['parent_id', 'name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->belongsToMany('Doctor', 'doctor_medical_specialty', 'medical_specialty_id', 'doctor_id');
    }


    public function getDoctorBySpeciality($city, $speciality)
    {

        $qry = self::select('id')->where('name', 'like', $speciality)->get();
        $doctors = $this->find($qry[0]['id'])->doctors;
        return $doctors;
    }

    public function medSpecialityForSelect()
    {
        $medSpeciality = self::select('name', 'id')
            ->get();
        return $medSpeciality;
    }


}