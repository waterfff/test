<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '图片操作';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-12">

                <?php
				$actionID = Yii::$app->controller->action->id;
				$controllerID = Yii::$app->controller->id;
				$form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=jianguo/solve&platform='.$platform.'&fun='.$fun , 'method' => 'POST']); 	
				
				?>

                    <div class="col-lg-6">
					<?= $form->field($model, 'tb_item_id') ?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model, 'image')->fileInput() ?>
					</div>
					


                    

            </div>
			<div class="col-lg-8">
                    <p align="right"><?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?></p>
            </div>

                <?php ActiveForm::end(); ?>
        </div>


</div>

