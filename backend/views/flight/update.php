<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */

$this->title = 'Update Flight: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Flights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flight-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'airports' => $airports,
        'airplanes' => $airplanes,
    ]) ?>

</div>
