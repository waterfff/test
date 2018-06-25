<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '主页',
        'brandUrl' => ['/site/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
		

			
			[
				'label' => '卫生巾拆分',
				'items' => [
				  ['label' => '卫生巾拆分阿里', 'url' => ['/weishengjin/explode']],
				  ['label' => '卫生巾拆分京东', 'url' => ['/weishengjin/explodejd']],
				],
			],
			[
				'label' => '坚果拆分',
				'items' => [
				  ['label' => '坚果拆分阿里', 'url' => ['/jianguo/explode']],
				  ['label' => '坚果拆分京东', 'url' => ['/jianguo/explodejd']],
				],
			],
			[
				'label' => '卫生巾top宝贝检查',
				'items' => [
				  ['label' => '京东自营', 'url' => ['/mixcheck/jdcheck']],
				  ['label' => '天猫', 'url' => ['/mixcheck/tmcheck']],
				  ['label' => '天猫超市', 'url' => ['/mixcheck/tmcscheck']],
				],
			],
			[
				'label' => '坚果SKU拆分',
				'items' => [
				  ['label' => '坚果SKU拆分阿里', 'url' => ['/jianguo/explode_sku']],
				  ['label' => '坚果SKU拆分京东', 'url' => ['/jianguo/explodejd_sku']],
				],
			],
        
			['label' => '后台报表生成', 'url' => ['/backend/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
	
	
	$actionID = Yii::$app->controller->action->id;
	$controllerID = Yii::$app->controller->id;
	//echo $controllerID;exit;
	if((($actionID=='explode'||$actionID=='explodejd')||($actionID=='newproduct'||$actionID=='explodejd')||($actionID=='explode_sku'||$actionID=='explodejd_sku'))and $controllerID=='jianguo'){
    ?>


    <div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>	
        <?= $content ?>
    </div>
	<?php }else if($controllerID=='backend'){?>
	<div>
		 <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>	
        <?= $content ?>
	</div>
	<?php }else{?>
	<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
	<?php }?>
</div>
<?php if((($actionID=='explode'||$actionID=='explodejd')||($actionID=='newproduct'||$actionID=='explodejd')||($actionID=='explode_sku'||$actionID=='explodejd_sku'))and $controllerID=='jianguo'){?>
<?php }else{?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right">BY Frequent</p>
    </div>
</footer>
<?php }?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
