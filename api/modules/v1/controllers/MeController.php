<?php

namespace api\modules\v1\controllers;

use api\models\user\ChangePasswordForm;
use api\models\user\Profile;
use api\models\user\User;
use Da\User\Module;
use Da\User\Traits\ContainerAwareTrait;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Json;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class MeController extends Controller
{
    use ContainerAwareTrait;

    /**
     * App user module
     *
     * @var Module
     */
    protected $userModule;

    public function __construct($id, $module, $config = [])
    {
        $this->userModule = Yii::$app->getModule('user');
        parent::__construct($id, $module, $config);
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                \yii\filters\auth\HttpBearerAuth::className(),
            ],

        ];

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'update-profile' => ['post'],
                'set-profile-image' => ['post'],
                'change-password' => ['post'],
                'me' => ['get', 'post'],
//                'statistics' => ['get']
            ],
        ];

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = [
            'options'
        ];

        return $behaviors;
    }

    public function actionMe()
    {
        $user = User::findIdentity(\Yii::$app->user->getId());
        if ($user) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return $user;
        } else {
            // Validation error
            throw new NotFoundHttpException('Object not found');
        }
    }

    public function actionUpdateProfile()
    {
        $user = User::findIdentity(Yii::$app->user->id);
        if ($user) {
            $profile = $user->profile;
            if (!$profile) {
                $profile = new \common\models\Profile([
                    'user_id' => $user->id
                ]);
            }

            if ($profile->load(Yii::$app->request->post(), '') && $profile->save()) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
                $responseData = 'true';
                // send new athlete email to admins
//                if ($profile->isNewRecord) {
//                    $mailService = MailFactory::makeNewAthleteMailerService($user);
//                    $mailService->run();
//                }
                return $responseData;
            } else {
                // Validation error
                throw new HttpException(422, json_encode($profile->errors));
            }
        } else {
            // Validation error
            throw new NotFoundHttpException(Yii::t('app', 'Object not found'));
        }
    }

//    public function actionSetProfileImage()
//    {
//        $user = User::findIdentity(Yii::$app->user->id);
//        $profileModel = Profile::find()->where(['user_id' => $user->id])->one();
//        if ($user and !is_null($profileModel)) {
//            $profileModel->scenario = Profile::SCENARIO_SET_IMAGE;
//            $profileModel->load(Yii::$app->request->post());
//            if ($profileModel->validate() && $profileModel->save()) {
//                $response = \Yii::$app->getResponse();
//                $response->setStatusCode(200);
//                $responseData = 'true';
//                return $responseData;
//            } else {
//                // Validation error
//                throw new HttpException(422, json_encode($profileModel->errors));
//            }
//        } else {
//            // Validation error
//            throw new NotFoundHttpException(Yii::t('app', 'Object not found'));
//        }
//    }

    public function actionChangePassword()
    {
        $form = new ChangePasswordForm();
        $form->load(Yii::$app->request->post());
        if ($form->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            $responseData = 'true';
            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($form->errors));
        }
    }
}
