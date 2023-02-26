<?php

namespace api\modules\v1\controllers;

use common\models\Reservation;

class ReservationController extends BaseActiveController
{
    public $modelClass = Reservation::class;
}
