<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Newproduct';
$this->params['breadcrumbs'][] = $this->title;
$is_shelled_list=['无壳'=>'无壳','有壳'=>'有壳','其他'=>'其他'];
//print_r($fun);exit;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-12">

                <?php
				$actionID = Yii::$app->controller->action->id;
				$controllerID = Yii::$app->controller->id;
				//echo $actionID."\n";
				//echo $controllerID;
				//exit;
				if($actionID=='add'and $controllerID=='jianguo'){
					$form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=jianguo/newproduct' , 'method' => 'POST']); 	
				}else if($actionID=='add_sku'and $controllerID=='jianguo'){
					$form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=jianguo/newproduct&fun=sku' , 'method' => 'POST']); 
				}else if($actionID=='addjd_sku'and $controllerID=='jianguo'){
					$form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=jianguo/newproductjd&fun=sku' , 'method' => 'POST']); 	
				}else{
					$form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=jianguo/newproductjd' , 'method' => 'POST']); 	
				}
				
				?>

                    <div class="col-lg-6">
					<?= $form->field($model, 'tb_item_id') ?>
                    <?= $form->field($model, 'name') ?>
					<?= $form->field($model, 'cid') ?>
					<?= $form->field($model, 'alias_bid') ?>
					<?= $form->field($model, 'package') ?>
					<?= $form->field($model, 'origin') ?>
					</div>
					
					<div class="col-lg-6">
					<?= $form->field($model, 'weight') ?>
					<?= $form->field($model, 'series')?>
					<?= $form->field($model, 'flavor')?>
					<?= $form->field($model, 'date')?>
					<?= $form->field($model, 'brand_name')?>
					<?= $form->field($model, 'cname_new')?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model, 'type1')?>
					<?= $form->field($model, 'type2')?>
					<?= $form->field($model, 'size')?>
					<?= $form->field($model, 'number1')?>
					<?= $form->field($model, 'number2')?>
					<?= $form->field($model, 'sku')?>
					</div>
					<div class="col-lg-6">
					<?= $form->field($model, 'price')?>
					<?= $form->field($model, 'avg_price')?>
					<?= $form->field($model, 'gift')?>
					<?= $form->field($model, 'mix')?>
					<?= $form->field($model, 'flag')?>
					<?= $form->field($model, 'is_shelled')->dropdownList($is_shelled_list)?>
					<?= $form->field($model, 'image')->fileInput() ?>
					</div>
					


                    

            </div>
			<div class="col-lg-8">
                    <p align="right"><?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?></p>
            </div>

                <?php ActiveForm::end(); ?>
        </div>


</div>

