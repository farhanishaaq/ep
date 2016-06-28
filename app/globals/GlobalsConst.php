<?php
/**
 * Created by PhpStorm.
 * User: mrashid
 * Date: 4/13/2016
 * Time: 8:11 PM
 */

namespace App\Globals;


class GlobalsConst {

    const YES = "Yes";
    const NO = "No";
    const STATUS_ON = "Active";
    const STATUS_OFF = "Inactive";
    const MALE = "Male";
    const FEMALE = "Female";
    const FORM_CREATE = 1;
    const FORM_EDIT = 2;
    const TIME_SLOT_INTERVAL = 20;
    const LIST_DATA_LIMIT = 60;


    const EP_DEMO_COMPANY_ONE = 1;
    const EP_DEMO_COMPANY_TWO = 2;
    const EP_DEMO_BUSINESS_UNIT_ONE = 1;
    const EP_DEMO_BUSINESS_UNIT_TWO = 2;
    const EP_DEMO_BUSINESS_UNIT_THREE = 3;
    const EP_DEMO_BUSINESS_UNIT_FOUR = 4;



    const LAHORE_OF_PAK = 1;
    
    const SUPER_ADMIN_ID = 1;
    const COMPANY_ADMIN_ID = 2;


    const PROFILE_PHOTO_DIR = 'uploaded-data/profile-photos';
    const DUMMY_EMAIL_DOMAIN = '@test.com';


    //Roles
    const SUPER_ADMIN_ROLE = 1;
    const COMPANY_ADMIN_ROLE = 2;


    //Branches
    const DHA = "DHA";
    const GULBERG = "Gulberg";
    const CANAL_VIEW = "Canal View";
    const GARDEN_TOWN = "Garden Town";
    const JOHAR_TOWN = "Johar Town";

    //PUBLIC RESOURCES LIST
    public static $PUBLIC_RESOURCES = [
        'HomeController@index',
        'AuthController@showLogin',
        'AuthController@doLogin',
        'AuthController@unauthorized',
        'UsersController@uploadProfilePic', //@todo It is not public, remove from here
        'PatientsController@getPatientForm', //@todo It is not public, remove from here
        'DoctorsController@index', //@todo It is not public, remove from here
        'DoctorsController@create', //@todo It is not public, remove from here
        'DoctorsController@store', //@todo It is not public, remove from here
        'DoctorsController@show', //@todo It is not public, remove from here
        'DoctorsController@edit', //@todo It is not public, remove from here
    ];

    //User Types
    const SUPER_ADMIN = "Super Admin";
    const ADMIN = "Admin";
    const EMPLOYEE = "Employee";
    const WORKER = "Worker";//laborer
    const DOCTOR = "Doctor";
    const PATIENT = "Patient";
    const PORTAL_USER = "Portal User";


    //Data Process Type
    const DATA_SAVE = 1;
    const DATA_UPDATE = 2;




    //User Types List
    public static $USER_TYPES = [self::SUPER_ADMIN=>self::SUPER_ADMIN,
        self::ADMIN=>self::ADMIN,
        self::EMPLOYEE=>self::EMPLOYEE,
        self::WORKER=>self::WORKER,
        self::DOCTOR=>self::DOCTOR,
        self::PATIENT=>self::PATIENT,
        self::PORTAL_USER=>self::PORTAL_USER
        ];

    public static $BRANCHES = ['DHA'=>self::DHA,
                                'Gulberg'=>self::GULBERG,
                                'Canal View'=>self::CANAL_VIEW,
                                'Garden Town'=>self::GARDEN_TOWN,
                                'Johar Town'=>self::JOHAR_TOWN
                                ];



    //Days
    const SUNDAY = "Sunday";
    const MONDAY = "Monday";
    const TUESDAY = "Tuesday";
    const WEDNESDAY = "Wednesday";
    const THURSDAY = "Thursday";
    const FRIDAY = "Friday";
    const SATURDAY = "Saturday";

    public static $DAYS = ['Sunday'=>self::SUNDAY,
        'Monday'=>self::MONDAY,
        'Tuesday'=>self::TUESDAY,
        'Wednesday'=>self::WEDNESDAY,
        'Thursday'=>self::THURSDAY,
        'Friday'=>self::FRIDAY,
        'Saturday'=>self::SATURDAY];

    public static $DAYS_WITH_NUM_KEYS = [
        '1'=>self::MONDAY,
        '2'=>self::TUESDAY,
        '3'=>self::WEDNESDAY,
        '4'=>self::THURSDAY,
        '5'=>self::FRIDAY,
        '6'=>self::SATURDAY,
        '7'=>self::SUNDAY,
    ];

    public static $DP_DAYS = ['2013-03-24'=>self::SUNDAY,
        '2013-03-25'=>self::MONDAY,
        '2013-03-26'=>self::TUESDAY,
        '2013-03-27'=>self::WEDNESDAY,
        '2013-03-28'=>self::THURSDAY,
        '2013-03-29'=>self::FRIDAY,
        '2013-03-30'=>self::SATURDAY];


    public static $APPOINTMENT_STATUSES = [
                                        1 => 'Advance Booking',
                                        2 => 'Waiting',
                                        3 => 'Walk In',
                                        4 => 'Cancelled',
                                        5 => 'Completed',
                                        ];


    //Countries
    public static $COUNTRIES = [
        "Afghanistan" => "Afghanistan"
        , "Albania" => "Albania"
        , "Algeria" => "Algeria"
        , "American Samoa" => "American Samoa"
        , "Andorra" => "Andorra"
        , "Angola" => "Angola"
        , "Anguilla" => "Anguilla"
        , "Antartica" => "Antarctica"
        , "Antigua and Barbuda" => "Antigua and Barbuda"
        , "Argentina" => "Argentina"
        , "Armenia" => "Armenia"
        , "Aruba" => "Aruba"
        , "Australia" => "Australia"
        , "Austria" => "Austria"
        , "Azerbaijan" => "Azerbaijan"
        , "Bahamas" => "Bahamas"
        , "Bahrain" => "Bahrain"
        , "Bangladesh" => "Bangladesh"
        , "Barbados" => "Barbados"
        , "Belarus" => "Belarus"
        , "Belgium" => "Belgium"
        , "Belize" => "Belize"
        , "Benin" => "Benin"
        , "Bermuda" => "Bermuda"
        , "Bhutan" => "Bhutan"
        , "Bolivia" => "Bolivia"
        , "Bosnia and Herzegowina" => "Bosnia and Herzegowina"
        , "Botswana" => "Botswana"
        , "Bouvet Island" => "Bouvet Island"
        , "Brazil" => "Brazil"
        , "British Indian Ocean Territory" => "British Indian Ocean Territory"
        , "Brunei Darussalam" => "Brunei Darussalam"
        , "Bulgaria" => "Bulgaria"
        , "Burkina Faso" => "Burkina Faso"
        , "Burundi" => "Burundi"
        , "Cambodia" => "Cambodia"
        , "Cameroon" => "Cameroon"
        , "Canada" => "Canada"
        , "Cape Verde" => "Cape Verde"
        , "Cayman Islands" => "Cayman Islands"
        , "Central African Republic" => "Central African Republic"
        , "Chad" => "Chad"
        , "Chile" => "Chile"
        , "China" => "China"
        , "Christmas Island" => "Christmas Island"
        , "Cocos Islands" => "Cocos (Keeling) Islands"
        , "Colombia" => "Colombia"
        , "Comoros" => "Comoros"
        , "Congo" => "Congo"
        , "Congo" => "Congo, the Democratic Republic of the"
        , "Cook Islands" => "Cook Islands"
        , "Costa Rica" => "Costa Rica"
        , "Cota D'Ivoire" => "Cote d'Ivoire"
        , "Croatia" => "Croatia (Hrvatska)"
        , "Cuba" => "Cuba"
        , "Cyprus" => "Cyprus"
        , "Czech Republic" => "Czech Republic"
        , "Denmark" => "Denmark"
        , "Djibouti" => "Djibouti"
        , "Dominica" => "Dominica"
        , "Dominican Republic" => "Dominican Republic"
        , "East Timor" => "East Timor"
        , "Ecuador" => "Ecuador"
        , "Egypt" => "Egypt"
        , "El Salvador" => "El Salvador"
        , "Equatorial Guinea" => "Equatorial Guinea"
        , "Eritrea" => "Eritrea"
        , "Estonia" => "Estonia"
        , "Ethiopia" => "Ethiopia"
        , "Falkland Islands" => "Falkland Islands (Malvinas)"
        , "Faroe Islands" => "Faroe Islands"
        , "Fiji" => "Fiji"
        , "Finland" => "Finland"
        , "France" => "France"
        , "France Metropolitan" => "France, Metropolitan"
        , "French Guiana" => "French Guiana"
        , "French Polynesia" => "French Polynesia"
        , "French Southern Territories" => "French Southern Territories"
        , "Gabon" => "Gabon"
        , "Gambia" => "Gambia"
        , "Georgia" => "Georgia"
        , "Germany" => "Germany"
        , "Ghana" => "Ghana"
        , "Gibraltar" => "Gibraltar"
        , "Greece" => "Greece"
        , "Greenland" => "Greenland"
        , "Grenada" => "Grenada"
        , "Guadeloupe" => "Guadeloupe"
        , "Guam" => "Guam"
        , "Guatemala" => "Guatemala"
        , "Guinea" => "Guinea"
        , "Guinea-Bissau" => "Guinea-Bissau"
        , "Guyana" => "Guyana"
        , "Haiti" => "Haiti"
        , "Heard and McDonald Islands" => "Heard and Mc Donald Islands"
        , "Holy See" => "Holy See (Vatican City State)"
        , "Honduras" => "Honduras"
        , "Hong Kong" => "Hong Kong"
        , "Hungary" => "Hungary"
        , "Iceland" => "Iceland"
        , "India" => "India"
        , "Indonesia" => "Indonesia"
        , "Iran" => "Iran (Islamic Republic of)"
        , "Iraq" => "Iraq"
        , "Ireland" => "Ireland"
        , "Israel" => "Israel"
        , "Italy" => "Italy"
        , "Jamaica" => "Jamaica"
        , "Japan" => "Japan"
        , "Jordan" => "Jordan"
        , "Kazakhstan" => "Kazakhstan"
        , "Kenya" => "Kenya"
        , "Kiribati" => "Kiribati"
        , "Democratic People's Republic of Korea" => "Korea, Democratic People's Republic of"
        , "Korea" => "Korea, Republic of"
        , "Kuwait" => "Kuwait"
        , "Kyrgyzstan" => "Kyrgyzstan"
        , "Lao" => "Lao People's Democratic Republic"
        , "Latvia" => "Latvia"
        , "Lebanon" => "Lebanon"
        , "Lesotho" => "Lesotho"
        , "Liberia" => "Liberia"
        , "Libyan Arab Jamahiriya" => "Libyan Arab Jamahiriya"
        , "Liechtenstein" => "Liechtenstein"
        , "Lithuania" => "Lithuania"
        , "Luxembourg" => "Luxembourg"
        , "Macau" => "Macau"
        , "Macedonia" => "Macedonia, The Former Yugoslav Republic of"
        , "Madagascar" => "Madagascar"
        , "Malawi" => "Malawi"
        , "Malaysia" => "Malaysia"
        , "Maldives" => "Maldives"
        , "Mali" => "Mali"
        , "Malta" => "Malta"
        , "Marshall Islands" => "Marshall Islands"
        , "Martinique" => "Martinique"
        , "Mauritania" => "Mauritania"
        , "Mauritius" => "Mauritius"
        , "Mayotte" => "Mayotte"
        , "Mexico" => "Mexico"
        , "Micronesia" => "Micronesia, Federated States of"
        , "Moldova" => "Moldova, Republic of"
        , "Monaco" => "Monaco"
        , "Mongolia" => "Mongolia"
        , "Montserrat" => "Montserrat"
        , "Morocco" => "Morocco"
        , "Mozambique" => "Mozambique"
        , "Myanmar" => "Myanmar"
        , "Namibia" => "Namibia"
        , "Nauru" => "Nauru"
        , "Nepal" => "Nepal"
        , "Netherlands" => "Netherlands"
        , "Netherlands Antilles" => "Netherlands Antilles"
        , "New Caledonia" => "New Caledonia"
        , "New Zealand" => "New Zealand"
        , "Nicaragua" => "Nicaragua"
        , "Niger" => "Niger"
        , "Nigeria" => "Nigeria"
        , "Niue" => "Niue"
        , "Norfolk Island" => "Norfolk Island"
        , "Northern Mariana Islands" => "Northern Mariana Islands"
        , "Norway" => "Norway"
        , "Oman" => "Oman"
        , "Pakistan" => "Pakistan"
        , "Palau" => "Palau"
        , "Panama" => "Panama"
        , "Papua New Guinea" => "Papua New Guinea"
        , "Paraguay" => "Paraguay"
        , "Peru" => "Peru"
        , "Philippines" => "Philippines"
        , "Pitcairn" => "Pitcairn"
        , "Poland" => "Poland"
        , "Portugal" => "Portugal"
        , "Puerto Rico" => "Puerto Rico"
        , "Qatar" => "Qatar"
        , "Reunion" => "Reunion"
        , "Romania" => "Romania"
        , "Russia" => "Russian Federation"
        , "Rwanda" => "Rwanda"
        , "Saint Kitts and Nevis" => "Saint Kitts and Nevis"
        , "Saint LUCIA" => "Saint LUCIA"
        , "Saint Vincent" => "Saint Vincent and the Grenadines"
        , "Samoa" => "Samoa"
        , "San Marino" => "San Marino"
        , "Sao Tome and Principe" => "Sao Tome and Principe"
        , "Saudi Arabia" => "Saudi Arabia"
        , "Senegal" => "Senegal"
        , "Seychelles" => "Seychelles"
        , "Sierra" => "Sierra Leone"
        , "Singapore" => "Singapore"
        , "Slovakia" => "Slovakia (Slovak Republic)"
        , "Slovenia" => "Slovenia"
        , "Solomon Islands" => "Solomon Islands"
        , "Somalia" => "Somalia"
        , "South Africa" => "South Africa"
        , "South Georgia" => "South Georgia and the South Sandwich Islands"
        , "Span" => "Spain"
        , "SriLanka" => "Sri Lanka"
        , "St. Helena" => "St. Helena"
        , "St. Pierre and Miguelon" => "St. Pierre and Miquelon"
        , "Sudan" => "Sudan"
        , "Suriname" => "Suriname"
        , "Svalbard" => "Svalbard and Jan Mayen Islands"
        , "Swaziland" => "Swaziland"
        , "Sweden" => "Sweden"
        , "Switzerland" => "Switzerland"
        , "Syria" => "Syrian Arab Republic"
        , "Taiwan" => "Taiwan, Province of China"
        , "Tajikistan" => "Tajikistan"
        , "Tanzania" => "Tanzania, United Republic of"
        , "Thailand" => "Thailand"
        , "Togo" => "Togo"
        , "Tokelau" => "Tokelau"
        , "Tonga" => "Tonga"
        , "Trinidad and Tobago" => "Trinidad and Tobago"
        , "Tunisia" => "Tunisia"
        , "Turkey" => "Turkey"
        , "Turkmenistan" => "Turkmenistan"
        , "Turks and Caicos" => "Turks and Caicos Islands"
        , "Tuvalu" => "Tuvalu"
        , "Uganda" => "Uganda"
        , "Ukraine" => "Ukraine"
        , "United Arab Emirates" => "United Arab Emirates"
        , "United Kingdom" => "United Kingdom"
        , "United States" => "United States"
        , "United States Minor Outlying Islands" => "United States Minor Outlying Islands"
        , "Uruguay" => "Uruguay"
        , "Uzbekistan" => "Uzbekistan"
        , "Vanuatu" => "Vanuatu"
        , "Venezuela" => "Venezuela"
        , "Vietnam" => "Viet Nam"
        , "Virgin Islands (British)" => "Virgin Islands (British)"
        , "Virgin Islands (U.S)" => "Virgin Islands (U.S.)"
        , "Wallis and Futana Islands" => "Wallis and Futuna Islands"
        , "Western Sahara" => "Western Sahara"
        , "Yemen" => "Yemen"
        , "Yugoslavia" => "Yugoslavia"
        , "Zambia" => "Zambia"
        , "Zimbabwe" => "Zimbabwe"
    ];
}