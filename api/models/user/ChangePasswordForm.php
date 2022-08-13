<?php


namespace api\models\user;


use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{

    public $current_password;
    public $new_password;
    public $confirm_password;

    private $_user;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['current_password', 'new_password', 'confirm_password'], 'required'],
            'currentPasswordValidate' => [
                'current_password',
                function ($attribute) {
                    if (!Yii::$app->security->validatePassword($this->$attribute, $this->getUser()->password_hash)) {
                        $this->addError($attribute, Yii::t('usuario', 'Current password is not valid'));
                    }
                },
            ],
            'newPasswordLength' => ['new_password', 'string', 'max' => 72, 'min' => 6],
            'confirmNewPasswordValidate' => [
                'confirm_password',
                function ($attribute) {
                    if ($this->$attribute != $this->new_password) {
                        $this->addError($attribute, Yii::t('usuario', 'Confirm password must match with new password'));
                    }
                }
            ]
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->password = $this->new_password;
            $user->save();
            return true;
        }
        return false;
    }

    private function getUser()
    {
        if ($this->_user == null) {
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }

}