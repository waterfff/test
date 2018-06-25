<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use kartik\datetime\DateTimePicker; 
use kartik\date\DatePicker; 

$step=array(100,60,40,35,72,84,100,25,44,31,5);
?>


<div style="padding:20px 0px 20px 20px;width:250px;">

	数据初始化
	<?php if($step[0]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active" >
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[0]?>%;">
			 
			<span class="sr-only">40% 完成</span>
		</div>
		
	</div>
	
	


	数据检查
	<?php if($step[1]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[1]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>

	第一次数据清洗
	<?php if($step[2]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[2]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>

	第二次数据清洗
	<?php if($step[3]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[3]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>

	导入拆分表
	<?php if($step[4]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[4]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


	导入拆分表
	<?php if($step[5]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[5]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


	人工拆分
	<?php if($step[6]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[6]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


	copy备份
	<?php if($step[7]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[7]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


	拆分
	<?php if($step[8]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[8]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>



	系列清洗
	<?php if($step[9]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[9]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


	数据格式整理
	<?php if($step[10]==100){?>
	(已完成)
	<?php }?>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" role="progressbar"
			 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
			 style="width: <?php echo $step[10]?>%;">
			<span class="sr-only">40% 完成</span>
		</div>
	</div>


</div>




