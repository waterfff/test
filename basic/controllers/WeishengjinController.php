<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\WeishengjinForm;
use yii\web\UploadedFile;

class WeishengjinController extends Controller
{	public $enableCsrfValidation=false;

    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['explode','add','newproduct','explodejd','addjd'],
                'rules' => [
                    [
                        'actions' => ['explode','add','newproduct','explodejd','addjd'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
	
	
	public function actionExplode()
    {
		$user_id=Yii::$app->user->id;
			
		$data=[];
		if($user_id==100){
			$getmix="select * from artificial.entity_1359_mix where checked=0 and checked_month=1804 order by tb_item_id   limit 1";
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else if($user_id==101){
			$getmix="select * from artificial.entity_1359_mix where checked=0 and checked_month=1804 order by tb_item_id desc  limit 1";	
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else{
			echo "erro!!";	
		}
        
		if($mix){
			$data['mix']=$mix[0];
			//print_r($mix);
			$alias_mix_id=$mix[0]['alias_bid'];
			$sql1="select * from artificial.entity_vida_product  where alias_bid=$alias_mix_id order by series,classification,size,p_num";
			$products = Yii::$app->db->createCommand($sql1)->queryAll();
			$data['products']=$products;
			$sql3="select count(*) from artificial.entity_vida_product  where alias_bid=$alias_mix_id order by series,classification,size,p_num";
			$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
			$data['numofproduct']=$numofproduct[0]['count(*)'];
			$tii=$mix[0]['tb_item_id'];
			$sql2="select * from apollo2.mall_item_201801 where tb_item_id=$tii";
			$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
			$data['miximg']=$getmixoldimg[0]['img'];	
			$data['platform']='ali';
			//print_r($data);	
			return $this->render('index',['data'=>$data]);
		}else{
			return $this->render('end');
		}
    }
	
	public function actionExplodejd()
    {
		$user_id=Yii::$app->user->id;
			
		$data=[];
		if($user_id==100){
			$getmix="select * from artificial.entity_1359_jd_mix where checked=0 and checked_month=1804 order by tb_item_id   limit 1";
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else if($user_id==101){
			$getmix="select * from artificial.entity_1359_jd_mix where checked=0 and checked_month=1804 order by tb_item_id desc  limit 1";	
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else{
			echo "erro!!";	
		}
        
		if($mix){
			$data['mix']=$mix[0];
			//print_r($mix);
			$alias_mix_id=$mix[0]['alias_bid'];
			$sql1="select * from artificial.entity_vida_product  where alias_bid=$alias_mix_id order by series,classification,size,p_num";
			$products = Yii::$app->db->createCommand($sql1)->queryAll();
			$data['products']=$products;
			$sql3="select count(*) from artificial.entity_vida_product  where alias_bid=$alias_mix_id order by series,classification,size,p_num";
			$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
			$data['numofproduct']=$numofproduct[0]['count(*)'];
			$tii=$mix[0]['tb_item_id'];
			$sql2="select * from jd.jd_item where tb_item_id=$tii";
			$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
			$data['miximg']=$getmixoldimg[0]['img'];
			$data['platform']='jd';
			
			//print_r($data);	
			return $this->render('index',['data'=>$data]);
		}else{
			return $this->render('end');
		}
    }
	

	
	public function actionAdd(){
		
		//echo "this is Addpacge";
		//print_r($_POST);
		$model = new  WeishengjinForm();
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update artificial.entity_1359_mix set checked=2 where tb_item_id=$tb_item_id_checked and checked_month=1804";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update artificial.entity_1359_mix set checked=1 where tb_item_id=$tb_item_id_checked and checked_month=1804";
				Yii::$app->db->createCommand($sql)->execute();
			}
			foreach($_POST as $key=>$v){

				if(preg_match("/num([0-9]+)/",$key,$num)){
					if($v){
						$nums.=$v.',';
						$ids.=$num[1].',';
					}
				}
				
				$ids=str_replace(",0,",",",$ids);
				
				$nums=str_replace(",0,",",",$nums);
				
			}
			if($if_out_alias!=0){
				
				$sql1="insert into artificial.entity_vida_exploded(tb_item_id,p_ids,p_nums) values($tb_item_id_checked,'$ids','$nums')";
				echo $sql1;
				//exit;
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update artificial.entity_1359_mix set checked=3 where tb_item_id=$tb_item_id_checked and checked_month=1804";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			
			return $this->actionExplode();

		}else if($_REQUEST['new']){
			//return $this->actionNewproduct();
				$model->alias_bid=$mix_alias_bid;
				return $this->render('newproduct',['model'=>$model,]);
			
				
		}else{
			foreach($_REQUEST as $key=>$v){
				if(preg_match("/addlike([0-9]+)/",$key,$id)){
					//echo $id[1];
					$dataid='r_str'.$id[1];
					
					$data= $_POST[$dataid];
					$datas=explode(',',$data);
					//print_r($datas);
					//print_r($_REQUEST);
					//print_r($_POST);
					print_r($datas);
					
					$model->name=$datas[0];
					$model->alias_bid=$datas[1];
					$model->classification=$datas[2];
					$model->avg_price=$datas[3];
					$model->p_num=$datas[4];
					$model->serface_material=$datas[5];
					$model->is_import=$datas[6];
					$model->fragrance=$datas[7];
					$model->insert_way=$datas[8];
					$model->size=$datas[9];
					$model->series=$datas[10];
					$model->tb_item_id=$datas[11];
			
					//return $this->actionNewproduct();
					return $this->render('newproduct',['model'=>$model,]);
				}
			}


		}
		
	}
	
	public function actionAddjd(){
		
		//echo "this is Addpacge";
		//print_r($_POST);
		$model = new  WeishengjinForm();
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update artificial.entity_1359_jd_mix set checked=2 where tb_item_id=$tb_item_id_checked and checked_month=1804";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update artificial.entity_1359_jd_mix set checked=1 where tb_item_id=$tb_item_id_checked and checked_month=1804";
				Yii::$app->db->createCommand($sql)->execute();
			}
			foreach($_POST as $key=>$v){

				if(preg_match("/num([0-9]+)/",$key,$num)){
					if($v){
						$nums.=$v.',';
						$ids.=$num[1].',';
					}
				}
				
				$ids=str_replace(",0,",",",$ids);
				
				$nums=str_replace(",0,",",",$nums);
				
			}
			if($if_out_alias!=0){
				
				$sql1="insert into artificial.entity_vida_exploded_jd(tb_item_id,p_ids,p_nums) values($tb_item_id_checked,'$ids','$nums')";
				echo $sql1;
				//exit;
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update artificial.entity_1359_jd_mix set checked=3 where tb_item_id=$tb_item_id_checked and checked_month=1804";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			
			return $this->actionExplodejd();

		}else if($_REQUEST['new']){
			//return $this->actionNewproduct();
				$model->alias_bid=$mix_alias_bid;
				return $this->render('newproductjd',['model'=>$model,]);
			
				
		}else{
			foreach($_REQUEST as $key=>$v){
				if(preg_match("/addlike([0-9]+)/",$key,$id)){
					//echo $id[1];
					$dataid='r_str'.$id[1];
					
					$data= $_POST[$dataid];
					$datas=explode(',',$data);
					//print_r($datas);
					//print_r($_REQUEST);
					//print_r($_POST);
					print_r($datas);
					
					$model->name=$datas[0];
					$model->alias_bid=$datas[1];
					$model->classification=$datas[2];
					$model->avg_price=$datas[3];
					$model->p_num=$datas[4];
					$model->serface_material=$datas[5];
					$model->is_import=$datas[6];
					$model->fragrance=$datas[7];
					$model->insert_way=$datas[8];
					$model->size=$datas[9];
					$model->series=$datas[10];
					$model->tb_item_id=$datas[11];
			
					//return $this->actionNewproduct();
					return $this->render('newproductjd',['model'=>$model,]);
				}
			}


		}
		
	}
	
	
	public function actionNewproduct(){
		//print_r (Yii::$app->request->post());
		$model = new  WeishengjinForm();
		$model->load(Yii::$app->request->post());
		//print_r($model);
		//exit;
		
		$sqldc="select name from dw_entity.brand where bid =".$model['alias_bid'];
		
		$resultdc = Yii::$app->db->createCommand($sqldc)->queryAll();
		$brandname=$resultdc[0]['name'];
		if($model['classification']=='日用'||$model['classification']=='夜用'||$model['classification']=='迷你'){
			$finalname=$brandname.' '.$model['series'].' '.$model['serface_material'].' '.$model['is_import'].' '.$model['size'].'mm '.$model['p_num'].'片 '.$model['classification'].' '.$model['fragrance'];
		}else if($model['classification']=='卫生棉条'){
			$finalname=$brandname.' '.$model['series'].' '.$model['serface_material'].' '.$model['is_import'].' '.$model['size'].' '.$model['p_num'].''.$model['classification'].' '.$model['fragrance'];
	    }else{
			$finalname=$brandname.' '.$model['series'].' '.$model['serface_material'].' '.$model['is_import'].' '.$model['size'].' '.$model['p_num'].'片 '.$model['classification'].' '.$model['fragrance'];
		}
		//echo $finalname."\n";
		
		
	   $model->image = UploadedFile::getInstance($model, "image");

	    if ($model->image && $model->validate()){  
			$model->image->saveAs("image/image/" . $model['tb_item_id'] . '.jpg');
	    } 

		$sqltail='(\''.$finalname.'\','.$model['alias_bid'].',\'D:\\\\10.14\\\\Dataway\\\\web\\\\image\\\\image\\\\'.$model['tb_item_id'].'.jpg\',\''.$model['classification'].'\',\''.$model['avg_price'].'\','.$model['p_num'].','.'1'.',\''.$model['serface_material'].'\',\''.$model['is_import'].'\',\''.$model['fragrance'].'\',\''.$model['insert_way'].'\',\''.$model['size'].'\',\''.$model['series'].'\',\''.$model['tb_item_id'].'\')';
		$sql="insert ignore artificial.entity_vida_product(name,alias_bid,image ,classification ,avg_price,p_num ,b_num  ,serface_material ,is_import ,fragrance ,insert_way ,size ,series ,tb_item_id) values $sqltail";
		//echo  $sql;
		$liang=Yii::$app->db->createCommand($sql)->execute();
		if($liang){
			echo "<script>alert('添加单品成功')</script>";
		}else{
			echo "<script>alert('item_id重复')</script>";
		}
		if($model->platform=='ali'){
			return $this->actionExplode();
		}else{
			return $this->actionExplodejd();
		}

		
		
	}
	

	
}
