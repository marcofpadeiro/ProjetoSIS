<?php

use common\models\BalanceReq;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\helpers\TableBuilder;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Balance Reqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="history">View history</a>
<div class="balance-req-index">

    <?php
    $buttons = [
        [
            'label' => 'Accept',
            'class' => 'btn btn-success btn-sm mr-3',
            'href' => 'accept',
            'flags' => [
                'id' => 'id',
                'employee_id' => Yii::$app->user->identity->getId()
            ],
        ],
        [
            'label' => 'Decline',
            'class' => 'btn btn-danger btn-sm',
            'href' => 'decline',
            'flags' => [
                'id' => 'id',
                'employee_id' => Yii::$app->user->identity->getId()
            ],
        ],
    ];
    $headers = [
        [
            'label' => '#',
            'attr' => 'id',
            'class' => 'text-start',
        ],
        [
            'label' => 'Request Date',
            'attr' => 'requestDate',
            'class' => 'text-center',
        ],
        [
            'label' => 'Amount',
            'attr' => 'amount',
            'class' => 'text-center',
            'format' => [0, '€']
        ],
        [
            'label' => 'Client',
            'attr' => 'clientName',
            'class' => 'text-center',
        ],
    ];
    $tableBuilder = new TableBuilder($headers, $model, $buttons);
    $tableBuilder->generate();
    ?>
</div>
