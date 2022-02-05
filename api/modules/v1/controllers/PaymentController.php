<?php

namespace api\modules\v1\controllers;

use common\models\Payment;

class PaymentController extends BaseActiveController
{
    public $modelClass = Payment::class;
}
