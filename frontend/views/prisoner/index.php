<?php

use frontend\models\Prisoner;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\PrisonerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = "Prisoners";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="prisoner-index">
    <p>
        <?php
        if (Yii::$app->user->identity->role == "Admin" || Yii::$app->user->identity->role == "Registrar Officer") {

            echo Html::a('Register New Prisoner', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <p>
        <?php
        echo Html::a('See Report', ['report'], ['class' => 'btn btn-success']);

        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'prisoner_id',
            'first_name',
            'last_name',
            'age',
            'sex',
            'region',
            //'entry_date',
            //'release_date',
            'status',
            [
                'format' => 'raw',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'value' => function ($data) {
                    if (Yii::$app->user->identity->role == "Admin" || Yii::$app->user->identity->role == "Registrar Officer") {

                        return Html::a('See more', ["prisoner/view", 'prisoner_id' => $data->prisoner_id,], ['class' => 'btn btn-xs btn-warning glyphicon glyphicon-eye']);
                    } else {
                        return Html::a('See more', ["prisoner/view", 'prisoner_id' => $data->prisoner_id,], ['class' => 'btn btn-xs btn-warning glyphicon glyphicon-eye']);
                    }
                }
            ],
            [
                'format' => 'raw',
                'value' => function ($data) {
                    if (Yii::$app->user->identity->role == "Admin" || Yii::$app->user->identity->role == "Registrar Officer") {
                        return  Html::a(
                            'Release',
                            ["prisoner/released", 'prisoner_id' => $data->prisoner_id,],
                            ['class' => 'btn btn-xs btn-danger glyphicon glyphicon-lock'],
                            [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to release this prisoner?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    } else {
                        return "";
                    }
                }
            ],
            [

                'format' => 'raw',
                'value' => function ($data) {
                    if (Yii::$app->user->identity->role == "Admin" || Yii::$app->user->identity->role == "Registrar Officer") {
                        return  Html::a(
                            'Transfer',
                            ["prisoner/transferred", 'prisoner_id' => $data->prisoner_id,],
                            ['class' => 'btn btn-xs btn-danger glyphicon glyphicon-lock'],
                            [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to release this prisoner?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    } else {
                        return "";
                    }
                }

            ],
        ],
    ]); ?>


</div>
<style type="text/css">