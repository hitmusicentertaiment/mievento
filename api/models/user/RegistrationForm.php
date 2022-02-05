<?php


namespace api\models\user;


use Yii;
use yii\helpers\Html;

class RegistrationForm extends \Da\User\Form\RegistrationForm
{

    public function formName()
    {
        return '';
    }
}