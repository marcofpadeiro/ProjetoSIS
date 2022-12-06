<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class SelectDate extends Model
{
    public $airportDeparture_id;
    public $airportArrival_id;
    public $departureDate;
    public $arrivalDate;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['airportDeparture_id', 'required'],
            ['airportArrival_id', 'required'],
            ['departureDate', 'required'],
        ];
    }
}
