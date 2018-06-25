<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Newproduct';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-12">

                <?php $form = ActiveForm::begin(['id' => 'Newproduct-form','action' => '/index.php?r=weishengjin/newproduct' , 'method' => 'POST']); ?>

                    <div class="col-lg-4">
					<?= $form->field($model, 'tb_item_id') ?>
                    <?= $form->field($model, 'name') ?>
					<?= $form->field($model, 'alias_bid') ?>
					<?= $form->field($model, 'avg_price') ?>
					<?= $form->field($model, 'p_num') ?>
					<?= $form->field($model, 'size') ?>
					<?= $form->field($model, 'series') ?>
					</div>
					
					<div class="col-lg-4">
					<?= $form->field($model, 'classification')->dropdownList($classification)?>
					<?= $form->field($model, 'is_import')->dropdownList($is_import)?>
					<?= $form->field($model, 'fragrance')->dropdownList($fragrance)?>
					<?= $form->field($model, 'insert_way')->dropdownList($insert_way)?>
					<?= $form->field($model, 'serface_material')->dropdownList($serface_material_list)?>
					<?= $form->field($model, 'image')->fileInput() ?>
					</div>
					


                    

            </div>
			<div class="col-lg-8">
                    <p align="right"><?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?></p>
            </div>

                <?php ActiveForm::end(); ?>
        </div>


</div>

