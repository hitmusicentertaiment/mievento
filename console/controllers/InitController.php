<?php

namespace console\controllers;

use common\models\City;
use common\models\Country;
use common\models\Service;
use common\models\State;
use common\models\User;

class InitController extends BaseController
{
    public function actionInitAll()
    {
        $this->actionInitRoles();
        $this->actionInitUsers();
        $this->actionInitCountries();
        $this->actionInitServices();
    }

    public function actionInitRoles()
    {
        $roles = [
            'admin' => "System superadmin",
            'manager' => "System manager",
            'client' => "System client"
        ];

        $authManager = \Yii::$app->getAuthManager();

        foreach ($roles as $roleName => $roleDescription) {
            $role = $authManager->getRole($roleName);
            if (empty($role)) {
                $role = $authManager->createRole($roleName);
                $role->description = $roleDescription;
                $authManager->add($role);
                $this->success("Role {$roleName} has been created and added to the system");
            } else {
                $this->warning("Role {$roleName} already exists");
            }
        }
    }

    public function actionInitUsers()
    {
        $authManager = \Yii::$app->getAuthManager();

        $adminIds = $authManager->getUserIdsByRole('admin');
        if (empty($adminIds)) {
            $user = new User([
                'username' => \Yii::$app->params['admin.username'],
                'email' => \Yii::$app->params['admin.email'],
                'password' => \Yii::$app->params['admin.password'],
                'created_at' => time(),
                'auth_key' => '',
            ]);

            $user->save(false);
            $this->success("User admin has been created");

            $adminRole = $authManager->getRole('admin');
            $authManager->assign($adminRole, $user->id);

            $this->success("Role admin has been assigned to admin user");
        } else {
            $this->warning("User admin already exists");
        }

    }

    public function actionInitCountries()
    {
        $countries = [
            [
                'name' => "United States",
                'code_2' => "US",
                'code_3' => "USA",
                'longitude' => '',
                'latitude' => '',
                'statesInfo' => [
                    [
                        'name' => 'Arizona',
                        'code_2' => 'AZ',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => []
                    ],
                    [
                        'name' => 'Texas',
                        'code_2' => 'TX',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Austin',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                            [
                                'name' => 'Dallas',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                            [
                                'name' => 'Houston',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                        ]
                    ],
                    [
                        'name' => 'Massachusetts',
                        'code_2' => 'MA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Boston',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ]
                        ]
                    ],
                    [
                        'name' => 'Colorado',
                        'code_2' => 'CO',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Boston',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ]
                        ]
                    ],
                    [
                        'name' => 'Georgia',
                        'code_2' => 'GA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Illinois',
                        'code_2' => 'IL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Nevada',
                        'code_2' => 'NV',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Las Vegas',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ]
                        ]
                    ],
                    [
                        'name' => 'California',
                        'code_2' => 'CA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Los Angeles',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                            [
                                'name' => 'San Francisco',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ]
                        ]
                    ],
                    [
                        'name' => 'Florida',
                        'code_2' => 'FL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Miami',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                            [
                                'name' => 'Naples',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],

                        ]
                    ],
                    [
                        'name' => 'Michigan',
                        'code_2' => 'MI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Minnesota',
                        'code_2' => 'MN',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'New Jersey',
                        'code_2' => 'NJ',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'New York',
                        'code_2' => 'NY',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'North Carolina',
                        'code_2' => 'NC',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'South Carolina',
                        'code_2' => 'SC',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Utah',
                        'code_2' => 'UT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Virginia',
                        'code_2' => 'VA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [

                        ]
                    ],
                    [
                        'name' => 'Washington',
                        'code_2' => 'WA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'citiesInfo' => [
                            [
                                'name' => 'Washington DC',
                                'code_2' => '',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => ''
                            ],
                        ]
                    ],
                ]
            ]
        ];

        foreach ($countries as $countryInfo) {
            $country = new Country();
            if ($country->load($countryInfo, '') and $country->save()) {
                $this->success("Country {$country->name} has been created");
                foreach ($countryInfo['statesInfo'] as $stateInfo) {
                    $state = new State();
                    $state->country_id = $country->id;
                    if ($state->load($stateInfo, '') and $state->save()) {
                        $this->success("State {$state->name} has been created");
                        foreach ($stateInfo['citiesInfo'] as $cityInfo) {
                            $city = new City();
                            $city->state_id = $state->id;
                            if ($city->load($cityInfo, '') and $city->save()) {
                                $this->success("City {$city->name} has been created");
                            } else {
                                $this->error(json_encode($city->errors));
                            }
                        }
                    } else {
                        $this->error(json_encode($state->errors));
                    }
                }
            } else {
                $this->error(json_encode($country->errors));
            }

        }
    }

    public function actionInitServices()
    {
        $services = [
            [
                'name' => 'Escort',
                'price' => 30,
            ],
            [
                'name' => 'Massage',
                'price' => 25,
            ],
            [
                'name' => 'Tantra',
                'price' => 25,
            ],
            [
                'name' => 'Fantasy',
                'price' => 25,
            ],
            [
                'name' => 'Bdsm',
                'price' => 25,
            ],
            [
                'name' => 'Dancer',
                'price' => 25,
            ],
        ];

        foreach ($services as $serviceInfo) {
            $service = new Service();
            if ($service->load($serviceInfo, '') and $service->save()) {
                foreach (City::find()->all() as $city) {
                    $service->link('cities', $city);
                }
            }
        }
    }


}
