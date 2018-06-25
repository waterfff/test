<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Newproduct';
$this->params['breadcrumbs'][] = $this->title;
$classification=['日用'=>'日用','夜用'=>'夜用','裤型'=>'裤型','卫生棉条'=>'卫生棉条','护垫'=>'护垫','迷你' => '迷你','其他'=>'其他'];
$is_import=['进口'=>'进口','国产'=>'国产','其他'=>'其他'];
$fragrance=['有香味'=>'有香味','无香味'=>'无香味','其他'=>'其他'];
$insert_way=['导管置入式'=>'导管置入式','指套置入式'=>'指套置入式','其他'=>'其他'];
$serface_material_list=['棉柔亲肤'=>'棉柔亲肤','干爽网面'=>'干爽网面','丝柔超薄'=>'丝柔超薄','液体胶'=>'液体胶','其他'=>'其他'];

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
					<?= $form->field($model, 'platform')->hiddenInput(['value'=>'jd']) ?>
					</div>
					


                    

            </div>
			<div class="col-lg-8">
                    <p align="right"><?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?></p>
            </div>

                <?php ActiveForm::end(); ?>
        </div>


</div>

