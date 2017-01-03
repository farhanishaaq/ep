<?php

use \App\Globals\GlobalsConst;

class ResourcesTableSeeder extends Seeder
{

    private $publicResources = [
        'HomeController@All',
        'AuthController@showLogin',
        'AuthController@doLogin',
    ];
    private $resources = [
        0 => [
            'parent_id' => 0,
            'name' => 'Hospital Management',
            'type' => 'Module',
        ],

        //***Start Auth Controller and its Action
        1 => [
            'parent_id' => 1,
            'name' => 'AuthController',
            'display' => 'Auth Controller',
            'type' => 'Controller',
            'is_public' => 'No',
        ],
        2 => [
            'parent_id' => 2,
            'name' => 'logout',
            'display' => 'Logout Action',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        //***End Auth Controller and its Action

        //Start Appointments Controller and its Action
        3 => [
            'parent_id' => 1,
            'name' => 'AppointmentsController',
            'display' => 'Appointments Controller',
            'type' => 'Controller',
            'is_public' => 'No',
        ],
        4 => [
            'parent_id' => 4,
            'name' => 'index',
            'display' => 'List',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        5 => [
            'parent_id' => 4,
            'name' => 'create',
            'display' => 'Create Form',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        6 => [
            'parent_id' => 4,
            'name' => 'store',
            'display' => 'Save',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        7 => [
            'parent_id' => 4,
            'name' => 'show',
            'display' => 'View',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        8 => [
            'parent_id' => 4,
            'name' => 'edit',
            'display' => 'Edit Form',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        9 => [
            'parent_id' => 4,
            'name' => 'update',
            'display' => 'Update',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        10 => [
            'parent_id' => 4,
            'name' => 'destroy',
            'display' => 'Delete',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        11 => [
            'parent_id' => 4,
            'name' => 'fetchTimeSlotsAndBookedAppointments',
            'display' => 'Fetch TimeSlots And Booked Appointments',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        //End Appointments Controller and its Action

        //***Start Companies Controller and its Action
        12 => [
            'parent_id' => 1,
            'name' => 'CompaniesController',
            'display' => 'Companies Controller',
            'type' => 'Controller',
            'is_public' => 'No',
        ],
        13 => [
            'parent_id' => 13,
            'name' => 'index',
            'display' => 'List',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        14 => [
            'parent_id' => 13,
            'name' => 'create',
            'display' => 'Create Form',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        15 => [
            'parent_id' => 13,
            'name' => 'store',
            'display' => 'Save',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        16 => [
            'parent_id' => 13,
            'name' => 'show',
            'display' => 'View',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        17 => [
            'parent_id' => 13,
            'name' => 'edit',
            'display' => 'Edit Form',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        18 => [
            'parent_id' => 13,
            'name' => 'update',
            'display' => 'Update',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        19 => [
            'parent_id' => 13,
            'name' => 'destroy',
            'display' => 'Delete',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        20 => [
            'parent_id' => 13,
            'name' => 'destroy',
            'display' => 'Delete',
            'type' => 'Action',
            'is_public' => 'No',
        ],
        //***End Companies Controller and its Action
    ];

    public function run()
    {
        DB::table('resources')->truncate();
        //1
        $resource = [
            'parent_id' => 0,
            'name' => 'Hospital Management',
            'display' => 'Hospital Management',
            'type' => 'Module',
        ];
        $moduleResource = Resource::create($resource);

        //*** Add Groups Resources
        foreach (GlobalsConst::$RESOURCE_GROUPS as $k => $rg) {
            $resource = [
                'parent_id' => $moduleResource->id,
                'name' => $rg,
                'display' => $rg,
                'type' => 'Group',
            ];
            $controllerResource = Resource::create($resource);
        }


        //*** Add Controller Resources
        $controllers = \App\Globals\Ep::getAllEpControllers();
        foreach ($controllers as $controller) {
            switch ($controller){
                case 'CompaniesController':
                case 'BusinessUnitsController':
                case 'RolesController':
                case 'ResourcesController':
                case 'UsersController':
                    $parentId = GlobalsConst::RG_ADMINISTRATION;
                    break;

                case 'AppointmentsController':
                case 'DoctorsController':
                case 'PatientsController':
                case 'DutyDaysController':
                case 'TimeSlotsController':
                case 'PrescriptionsController':
                    $parentId = GlobalsConst::RG_CLINIC;
                    break;

                case 'HomeController':
                case 'AuthController':
                    $parentId = GlobalsConst::RG_PUBLIC;
                    break;

                default:
                    $parentId = GlobalsConst::RG_OTHERS;
                    break;
            }
            $resource = [
                'parent_id' => $parentId,
                'name' => $controller,
                'display' => ucwords($controller),
                'type' => 'Controller',
            ];
            $controllerResource = Resource::create($resource);

            //*******Add Actions of controllers
            $class = new ReflectionClass(trim($controller));
            $cMethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
            $cUniqueMethods = array_unique($cMethods);
            foreach ($cUniqueMethods as $m) {
                if ($m->class == $controller) {
                    Resource::create([
                        'parent_id' => $controllerResource->id,
                        'name' => $m->name,
                        'display' => ucwords($m->name),
                        'type' => 'Action',
                    ]);

                }
            }
        }
    }

    private function addResources()
    {
        DB::table('resources')->truncate();
        $resources = [
            0 => [
                'parent_id' => null,
                'name' => 'Hospital Management',
                'type' => 'Module',
            ],
        ];

        $ParentId = 1;
        $controllers = \App\Globals\Ep::getAllEpControllers();
        foreach ($controllers as $controller) {

            //*******Add controllers
            $resources[] = [
                'parent_id' => $ParentId,
                'name' => $controller,
                'type' => 'Controller',
            ];

            //*******Add Actions of controllers
            echo $controller;
            $class = new ReflectionClass(trim($controller));
            $cMethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
            $cUniqueMethods = array_unique($cMethods);
            foreach ($cUniqueMethods as $m) {
                if ($m->class == $controller)
                    $resources[] = [
                        'parent_id' => $ParentId,
                        'name' => $m->name,
                        'type' => 'Action',
                    ];
            }
            $ParentId++;
        }
        $result = Resource::insert($resources);
        return $result;
    }
}