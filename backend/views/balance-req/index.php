<?php

use common\models\BalanceReq;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Balance Reqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="history">View history</a>
<div class="balance-req-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'requestDate',
            [
                'label' => 'Amount',
                'value' => function ($model) {
                    return $model->amount . '€';
                }
            ],
            [
                'label' => 'Client username',
                'value' => function ($model) {
                    return $model->client->user->username;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{accept} {decline}',
                'buttons' => [
                    'accept' => function ($url) {
                        return Html::a(
                            '<span>Accept</span>',
                            $url,
                            [
                                'title' => 'Accept',
                                'data-pjax' => '0',
                            ],
                            ['class' => 'btn btn-success']
                        );
                    },
                    'decline' => function ($url) {
                        return Html::a(
                            '<span>Decline</span>',
                            $url,
                            [
                                'title' => 'Decline',
                                'data-pjax' => '0',
                            ],
                            ['class' => 'btn btn-danger']
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
</div>
</div>
</div>
