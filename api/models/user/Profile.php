<?php


namespace api\models\user;

use Yii;
use yii\base\InvalidConfigException;


/**

 */
class Profile extends \common\models\Profile
{

    public function formName()
    {
        return '';
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['username'] = function(Profile $profile){
            return $profile->user->username;
        };
        $fields['email'] = function(Profile $profile){
            return $profile->user->username;
        };
//        $fields['roles'] = function(Profile $profile){
//            $userId = $profile->user_id;
//            $authManager = Yii::$app->authManager;
//            $roles = $authManager->getRolesByUser($userId);
//            return $roles;
//        };


        return $fields;
    }


}
