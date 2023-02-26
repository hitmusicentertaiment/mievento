<?php

namespace console\controllers;

use common\models\Category;
use common\models\City;
use common\models\Country;
use common\models\Service;
use common\models\State;
use common\models\User;
use Symfony\Component\Yaml\Yaml;
use yii\base\ErrorException;

class InitController extends BaseController
{
    public function actionInitAll()
    {
        $this->actionInitRoles();
        $this->actionInitUsers();
        $this->actionInitGeo();
        $this->actionInitCategories();
    }

    public function actionInitRoles()
    {
        $roles = [
            'admin' => "System superadmin",
            'business' => "Business manager",
            'artist' => "Artist",
            'promoter' => "Promoter",
            'customer' => "Common client"
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
                'confirmed_at' => time(),
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

    public function actionInitGeo()
    {
        $path = \Yii::getAlias("@backend/web/vendors/countries_db/countries_data.json");
        $jsonRawData = file_get_contents($path);

        $jsonData = json_decode($jsonRawData, true);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($jsonData as $countryData) {
                $country = new Country(['available' => 1]);
                if (!$country->load($countryData, '') || !$country->save()) {
                    throw new ErrorException(json_encode($country->errors));
                }

                $this->success("Country {$country->name} => CREATED");
                foreach ($countryData['states'] as $stateData) {
                    $state = new State(['available' => 1]);
                    $state->country_id = $country->id;
                    if (!$state->load($stateData, '') || !$state->save(false)) {
                        throw new ErrorException(json_encode($state->errors));
                    }
                    $this->success("        State {$state->name} => CREATED");
                    foreach ($stateData['cities'] as $cityData) {
                        $city = new City(['available' => 1]);
                        $city->state_id = $state->id;
                        if (!$city->load($cityData, '') || !$city->save(false)) {
                            throw new ErrorException(json_encode($city->errors));
                        }
                        $this->success("             City {$city->name} => CREATED");
                    }
                }
                $this->success("=====================================================");
                $this->success("=====================================================");
                $this->success("=====================================================");
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->error(Yaml::dump(json_decode($e->getMessage())));
        }

    }

    public function actionInitCategories()
    {
        $categories = [
            [
                "name" => "Pool Party"
            ],
            [
                "name" => "Exposición de Arte"
            ],
            [
                "name" => "Obra de Teatro"
            ],
            [
                "name" => "Concierto"
            ],
            [
                "name" => "Fiesta Temática "
            ],
            [
                "name" => "Fiesta Playa"
            ],
            [
                "name" => "Festival"
            ],
            [
                "name" => "Carnaval"
            ],
            [
                "name" => "Lanzamiento Musical"
            ],
            [
                "name" => "Inauguración"
            ],
            [
                "name" => "Deportivo"
            ],
            [
                "name" => "Oferta Especial"
            ],
            [
                "name" => "Evento de Negocio"
            ],
            [
                "name" => "Fiestas Populares"
            ],
            [
                "name" => "Performances"
            ],
            [
                "name" => "Taller"
            ],
            [
                "name" => "Exhibición"
            ],
            [
                "name" => "Salud & Bienestar"
            ],
            [
                "name" => "Eventos Literarios"
            ],
            [
                "name" => "Artesanía"
            ],
            [
                "name" => "Fotografía"
            ],
            [
                "name" => "Cocina "
            ],
            [
                "name" => "Comedia"
            ],
            [
                "name" => "Viajes y Aventuras"
            ],
            [
                "name" => "Eventos Sin Fines De Lucro"
            ],
            [
                "name" => "Conferencias"
            ],
            [
                "name" => "Conferencias Para Niños"
            ],
            [
                "name" => "Eventos Virtuales "
            ],
            [
                "name" => "Eventos Tecnológicos"
            ],
            [
                "name" => "Matiné"
            ],
            [
                "name" => "After Party"
            ],
            [
                "name" => "Estreno"
            ],
            [
                "name" => "Feria "
            ],
            [
                "name" => "Festival De Cine"
            ],
            [
                "name" => "Eventos Ecológicos"
            ],
            [
                "name" => "Reality Show"
            ],
        ];

        foreach ($categories as $category){
            (new Category($category))->save();
        }
    }

}
