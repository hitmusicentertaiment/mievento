<?php

namespace api\modules\v1\controllers;

use common\models\BusinessProfile;
use common\models\BusinessProfileSearch;
use common\models\Email;
use common\models\Kyc;
use common\models\Phone;
use common\models\SocialNetwork;
use common\models\StateSearch;
use Da\User\Traits\ContainerAwareTrait;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;

class BusinessProfileController extends BaseActiveController
{
    public $modelClass = \common\models\BusinessProfile::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions ['index']['prepareDataProvider'] = function ($action) {
            $requestParams = Yii::$app->getRequest()->getBodyParams();
            if (empty($requestParams)) {
                $requestParams = Yii::$app->getRequest()->getQueryParams();
            }

            $searchModel = new BusinessProfileSearch();
            if (Yii::$app->user->can('client')) {
                $searchModel->user_id = Yii::$app->user->identity->getId();
            }
            $dataProvider = $searchModel->search($requestParams, true);
            $dataProvider->pagination = false;
            return $dataProvider;
        };

        unset($actions['create']);

        return $actions;
    }

//    public function actionCreate()
//    {
//        $businessProfile = new BusinessProfile();
//        $post = Yii::$app->request->post();
//
//
//        $errors = [];
//        if($businessProfile->load($post, '') and $businessProfile->save()){
//            $phone = new Phone([
//                'business_profile_id' => $businessProfile->id
//            ]);
//            $email = new Email([
//                'business_profile_id' => $businessProfile->id
//            ]);
//            $socialNetwork = new SocialNetwork([
//                'business_profile_id' => $businessProfile->id
//            ]);
//            $kyc = new Kyc([
//                'business_profile_id' => $businessProfile->id
//            ]);
//            if(!$phone->load($post, '') or !$phone->validate()){
//                $errors = array_merge($errors, $phone->errors);
//            }
//            if(!$email->load($post, '') or !$email->validate()){
//                $errors = array_merge($errors, $email->errors);
//            }
//            if(!$socialNetwork->load($post, '') or !$socialNetwork->validate()){
//                $errors = array_merge($errors, $socialNetwork->errors);
//            }
//            if(!$kyc->load($post, '') or !$kyc->validate()){
//                $errors = array_merge($errors, $kyc->errors);
//            }
//
//            if(!empty($errors)){
//                $phone->save(false);
//                $email->save(false);
//                $socialNetwork->save(false);
//                $kyc->save(false);
//            }
//        }
//
//        return $businessProfile;
//
//    }
}
