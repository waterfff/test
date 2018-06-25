<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\JianguoForm;
use yii\web\UploadedFile;
use app\models\JianguoexForm;

class JianguoController extends Controller
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
		//$model = new  JianguoexForm();
		$change_data=$_POST['JianguoexForm'];
		
		//print_r($model);	
		
		
		$data=[];
		
			if($user_id==100){
				$getmix="select * from hengshi.hengshi_topitem_ali_mix where `check`=0 order by tb_item_id limit 1";
				$mix = Yii::$app->db->createCommand($getmix)->queryAll();
			}else if($user_id==101){
				$getmix="select * from hengshi.hengshi_topitem_ali_mix where `check`=0 order by tb_item_id  desc limit 1";	
				$mix = Yii::$app->db->createCommand($getmix)->queryAll();
			}else{
				echo "erro!!";	
			}
			
			if($mix){
				$data['mix']=$mix[0];
				//print_r($mix);
				$brand_name=$mix[0]['brand_name'];
				$sql1="select a.*,b.img from hengshi.hengshi_product_ali a left join apollo2.mall_item_201707 b on a.tb_item_id=b.tb_item_id where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9) order by type1,type2,flavor,size,number2";
				$products = Yii::$app->db->createCommand($sql1)->queryAll();
				$data['products']=$products;
				$sql3="select count(*) from hengshi.hengshi_product_ali where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9)";
				$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
				$data['numofproduct']=$numofproduct[0]['count(*)'];
				$tii=$mix[0]['tb_item_id'];
				$zsimg='';
				$flag=201707;
				while(!$zsimg&&$flag<=201712){
					$sql2="select * from apollo2.mall_item_$flag where tb_item_id=$tii";
					$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
					$zsimg=$getmixoldimg[0]['img'];
					$flag++;
				}
				$flag=201707;
				$data['miximg']=$getmixoldimg[0]['img'];	
				$data['platform']='ali';
				$data['change_data']=$change_data;
				//$data['last_data']=$last_data;

				return $this->render('index',['data'=>$data]);
			}else{
				return $this->render('end');
			}
	
    }
	
	public function actionExplode_sku()
    {
		$user_id=Yii::$app->user->id;
		//$model = new  JianguoexForm();
		$change_data=$_POST['JianguoexForm'];
		
		//print_r($model);	
		
		
		$data=[];
		
			if($user_id==100){
				$getmix="select * from hengshi.hengshi_topitem_ali_sku where `check`=0 order by tb_item_id limit 1";
				$mix = Yii::$app->db->createCommand($getmix)->queryAll();
			}else if($user_id==101){
				$getmix="select * from hengshi.hengshi_topitem_ali_sku where `check`=0 order by tb_item_id  desc limit 1";	
				$mix = Yii::$app->db->createCommand($getmix)->queryAll();
			}else{
				echo "erro!!";	
			}
			
			if($mix){
				$data['mix']=$mix[0];
				//print_r($mix);
				$brand_name=$mix[0]['brand_name'];
				$sql1="select a.*,b.img from hengshi.hengshi_product_ali a left join apollo2.mall_item_201707 b on a.tb_item_id=b.tb_item_id where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9) order by type1,type2,flavor,size,number2";
				$products = Yii::$app->db->createCommand($sql1)->queryAll();
				$data['products']=$products;
				$sql3="select count(*) from hengshi.hengshi_product_ali where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9)";
				$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
				$data['numofproduct']=$numofproduct[0]['count(*)'];
				$tii=$mix[0]['tb_item_id'];
				$zsimg='';
				$flag=201707;
				while(!$zsimg&&$flag<=201712){
					$sql2="select * from apollo2.mall_item_$flag where tb_item_id=$tii";
					$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
					$zsimg=$getmixoldimg[0]['img'];
					$flag++;
				}
				$flag=201707;
				$data['miximg']=$getmixoldimg[0]['img'];	
				$data['platform']='ali';
				$data['change_data']=$change_data;
				$data['fun']='sku';
				//$data['last_data']=$last_data;
				//print_r($data);	
				//exit;
				return $this->render('index',['data'=>$data]);
			}else{
				return $this->render('end');
			}
		
		
	}
	
	
	
	public function actionExplodejd()
    {
		$user_id=Yii::$app->user->id;
		$change_data=$_POST['JianguoexForm'];
			
		$data=[];
		if($user_id==100){
			$getmix="select * from hengshi.hengshi_topitem_jd_mix where `check`=0 order by tb_item_id limit 1";
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else if($user_id==101){
			$getmix="select * from hengshi.hengshi_topitem_jd_mix where `check`=0 order by tb_item_id  desc limit 1";	
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else{
			echo "erro!!";	
		}
        
		if($mix){
			$data['mix']=$mix[0];
			//print_r($mix);
			$brand_name=$mix[0]['brand_name'];
			$sql1="select a.*,b.img from hengshi.hengshi_product_ali a left join apollo2.mall_item_201707 b on a.tb_item_id=b.tb_item_id where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9) order by type1,type2,flavor,size,number2";
			$products = Yii::$app->db->createCommand($sql1)->queryAll();
			$data['products']=$products;
			$sql3="select count(*) from hengshi.hengshi_product_ali where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9)";
			$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
			$data['numofproduct']=$numofproduct[0]['count(*)'];
			$tii=$mix[0]['tb_item_id'];
			$sql2="select * from jd.jd_item where tb_item_id=$tii";
			$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
			$data['miximg']=$getmixoldimg[0]['img'];	
			$data['platform']='jd';
			$data['change_data']=$change_data;
			//$data['last_data']=$last_data;
			//print_r($data);	
			//exit;
			return $this->render('index',['data'=>$data]);
		}else{
			return $this->render('end');
		}
    }
	
	public function actionExplodejd_sku()
    {
		$user_id=Yii::$app->user->id;
		$change_data=$_POST['JianguoexForm'];
			
		$data=[];
		if($user_id==100){
			$getmix="select * from hengshi.hengshi_topitem_jd_sku where `check`=0 order by tb_item_id limit 1";
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else if($user_id==101){
			$getmix="select * from hengshi.hengshi_topitem_jd_sku where `check`=0 order by tb_item_id  desc limit 1";	
			$mix = Yii::$app->db->createCommand($getmix)->queryAll();
		}else{
			echo "erro!!";	
		}
        
		if($mix){
			$data['mix']=$mix[0];
			//print_r($mix);
			$brand_name=$mix[0]['brand_name'];
			$sql1="select a.*,b.img from hengshi.hengshi_product_ali a left join apollo2.mall_item_201707 b on a.tb_item_id=b.tb_item_id where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9) order by type1,type2,flavor,size,number2";
			$products = Yii::$app->db->createCommand($sql1)->queryAll();
			$data['products']=$products;
			$sql3="select count(*) from hengshi.hengshi_product_ali where brand_name='$brand_name' and gift=0 and (flag=0 or flag=9)";
			$numofproduct = Yii::$app->db->createCommand($sql3)->queryAll();
			$data['numofproduct']=$numofproduct[0]['count(*)'];
			$tii=$mix[0]['tb_item_id'];
			$sql2="select * from jd.jd_item where tb_item_id=$tii";
			$getmixoldimg = Yii::$app->db->createCommand($sql2)->queryAll();
			$data['miximg']=$getmixoldimg[0]['img'];	
			$data['platform']='jd';
			$data['change_data']=$change_data;
			$data['fun']='sku';
			
			//$data['last_data']=$last_data;
			//print_r($data);	
			//exit;
			return $this->render('index',['data'=>$data]);
		}else{
			return $this->render('end');
		}
    }
	

	
	public function actionAdd(){
		
		//echo "this is Addpacge";
		//print_r($_POST);exit;
		$model = new  JianguoForm();
	//	$id=$_POST["mix_id"];
	//	$if_out_alias=$_POST['if_out_alias'];
	//	$user_id=$_POST['user_id'];
	//	$mix_alias_bid=$_POST['mix_alias_bid'];
		
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		$date=$_POST['date'];
		$flavor=$_POST['flavor'];
		$id=$_POST['real_id'];
		$has_snacks=$_POST['has_snacks'];
		
		
		
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update hengshi.hengshi_topitem_ali_mix set `check`=2 where id=$id";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update hengshi.hengshi_topitem_ali_mix set `check`=1 where id=$id";
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
				
				$sql1="insert into hengshi.hengshi_exploded(tb_item_id,date,flavor,p_ids,p_nums,has_snacks) values($tb_item_id_checked,'$date','$flavor','$ids','$nums',$has_snacks)";
				//echo $sql1;
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update hengshi.hengshi_topitem_ali_mix set `check`=3 where id=$id";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			
			
			echo '<script>location.href="index.php?r=jianguo%2Fexplode"</script>';

		}else if($_REQUEST['new']){
			
		
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
				//	print_r($datas);
				
					$model->tb_item_id=$datas[0];
					$model->name=$datas[1];
					$model->cid=$datas[2];
					$model->alias_bid=$datas[3];
					$model->package=$datas[4];
					$model->origin=$datas[5];
					$model->weight=$datas[6];
					$model->series=$datas[7];
					$model->flavor=$datas[8];
					$model->date=$datas[9];
					$model->brand_name=$datas[10];
					$model->cname_new=$datas[11];
					$model->type1=$datas[12];
					$model->type2=$datas[13];
					$model->size=$datas[14];
					$model->number1=$datas[15];
					$model->number2=$datas[16];
					$model->sku=$datas[17];
					$model->price=$datas[18];
					$model->avg_price=$datas[19];
					$model->gift=$datas[20];
					$model->mix=$datas[21];
					$model->flag=$datas[22];
					$model->is_shelled=$datas[23];
					
					
					
			
					//return $this->actionNewproduct();
					return $this->render('newproduct',['model'=>$model,]);
				}
			}


		}
		
	}
	public function actionAdd_sku(){
		echo "!!!!!";
			
		//echo "this is Addpacge";
		//print_r($_POST);exit;
		$model = new  JianguoForm();

		
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		$date=$_POST['date'];
		$flavor=$_POST['flavor'];
		$id=$_POST['real_id'];
		$has_snacks=$_POST['has_snacks'];
		$mix_new=$_POST['mix_new'];
		$size=$_POST['size'];
		
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update hengshi.hengshi_topitem_ali_sku set `check`=2 where id=$id";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update hengshi.hengshi_topitem_ali_sku set `check`=1 where id=$id";
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
			if($has_snacks!=0){
				$ids.="9999,";
				$nums.="1,";
			}
			
			if($if_out_alias!=0){
				
				$sql1="insert into hengshi.hengshi_exploded_sku(alias_bid,mix_new,size,date,p_ids,p_nums,tb_item_id) values($mix_alias_bid,'$mix_new','$size','$date','$ids','$nums',$tb_item_id_checked)";
				
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update hengshi.hengshi_topitem_ali_sku set `check`=3 where id=$id";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			
			
			echo '<script>location.href="index.php?r=jianguo%2Fexplode_sku"</script>';
			//Yii::$app->user->setReturnUrl(Yii::$app->request->referrer);

		}else if($_REQUEST['new']){
			
		
				return $this->render('newproduct',['model'=>$model,'fun'=>'sku']);
			
				
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
				//	print_r($datas);
				//print_r($datas);exit;
					$model->tb_item_id=$datas[0];
					$model->name=$datas[1];
					$model->cid=$datas[2];
					$model->alias_bid=$datas[3];
					$model->package=$datas[4];
					$model->origin=$datas[5];
					$model->weight=$datas[6];
					$model->series=$datas[7];
					$model->flavor=$datas[8];
					$model->date=$datas[9];
					$model->brand_name=$datas[10];
					$model->cname_new=$datas[11];
					$model->type1=$datas[12];
					$model->type2=$datas[13];
					$model->size=$datas[14];
					$model->number1=$datas[15];
					$model->number2=$datas[16];
					$model->sku=$datas[17];
					$model->price=$datas[18];
					$model->avg_price=$datas[19];
					$model->gift=$datas[20];
					$model->mix=$datas[21];
					$model->flag=$datas[22];
					$model->is_shelled=$datas[23];
				
					
					
					
			
					//return $this->actionNewproduct();
					return $this->render('newproduct',['model'=>$model,'fun'=>'sku']);
				}
			}


		}
		
	}
	
	
	public function actionAddjd(){
		
		//echo "this is Addpacge";
		//print_r($_POST);
		$model = new  JianguoForm();
		//$id=$_POST["mix_id"];
		//$if_out_alias=$_POST['if_out_alias'];
		//$user_id=$_POST['user_id'];
		//$mix_alias_bid=$_POST['mix_alias_bid'];
		
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		$date=$_POST['date'];
		$flavor=$_POST['flavor'];
		$id=$_POST['real_id'];
		$has_snacks=$_POST['has_snacks'];
		
		
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update hengshi.hengshi_topitem_jd_mix set `check`=2 where id=$id";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update hengshi.hengshi_topitem_jd_mix set `check`=1 where id=$id";
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
				
				$sql1="insert into hengshi.hengshi_exploded_jd(tb_item_id,date,flavor,p_ids,p_nums,has_snacks) values($tb_item_id_checked,'$date','$flavor','$ids','$nums',$has_snacks)";
				echo $sql1;
				//exit;
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update hengshi.hengshi_topitem_jd_mix set `check`=3 where id=$id";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			

			echo '<script>location.href="index.php?r=jianguo%2Fexplodejd"</script>';

		}else if($_REQUEST['new']){
			//return $this->actionNewproduct();
		
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
				//	print_r($datas);
				
					$model->tb_item_id=$datas[0];
					$model->name=$datas[1];
					$model->cid=$datas[2];
					$model->alias_bid=$datas[3];
					$model->package=$datas[4];
					$model->origin=$datas[5];
					$model->weight=$datas[6];
					$model->series=$datas[7];
					$model->flavor=$datas[8];
					$model->date=$datas[9];
					$model->brand_name=$datas[10];
					$model->cname_new=$datas[11];
					$model->type1=$datas[12];
					$model->type2=$datas[13];
					$model->size=$datas[14];
					$model->number1=$datas[15];
					$model->number2=$datas[16];
					$model->sku=$datas[17];
					$model->price=$datas[18];
					$model->avg_price=$datas[19];
					$model->gift=$datas[20];
					$model->mix=$datas[21];
					$model->flag=$datas[22];
					$model->is_shelled=$datas[23];
				
					
					
					
			
					//return $this->actionNewproduct();
					return $this->render('newproduct',['model'=>$model,]);
				}
			}


		}
		
	}
	
	public function actionAddjd_sku(){
				
		//echo "this is Addpacge";
		//print_r($_POST);
		$model = new  JianguoForm();
		//$id=$_POST["mix_id"];
		//$if_out_alias=$_POST['if_out_alias'];
		//$user_id=$_POST['user_id'];
		//$mix_alias_bid=$_POST['mix_alias_bid'];
		
		$tb_item_id_checked=$_POST["mix_id"];
		$if_out_alias=$_POST['if_out_alias'];
		$user_id=$_POST['user_id'];
		$mix_alias_bid=$_POST['mix_alias_bid'];
		$date=$_POST['date'];
		$flavor=$_POST['flavor'];
		$id=$_POST['real_id'];
		$has_snacks=$_POST['has_snacks'];
		$mix_new=$_POST['mix_new'];
		$size=$_POST['size'];
		
		if($_REQUEST['explode'] ){
			if($if_out_alias==0){
				$sql="update hengshi.hengshi_topitem_jd_sku set `check`=2 where id=$id";
				Yii::$app->db->createCommand($sql)->execute();	
			}else{
				$sql="update hengshi.hengshi_topitem_jd_sku set `check`=1 where id=$id";
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
			
			if($has_snacks!=0){
				$ids.="9999,";
				$nums.="1,";
			}
			if($if_out_alias!=0){
				
				$sql1="insert into hengshi.hengshi_exploded_sku_jd(alias_bid,mix_new,size,date,p_ids,p_nums,tb_item_id) values($mix_alias_bid,'$mix_new','$size','$date','$ids','$nums',$tb_item_id_checked)";
				//echo $sql1;
				//exit;
				if($ids&&$nums){
					Yii::$app->db->createCommand($sql1)->execute();
					echo "<script>alert('拆分成功')</script>";
				}else{
					$sql="update hengshi.hengshi_topitem_jd_sku set `check`=3 where id=$id";
					Yii::$app->db->createCommand($sql)->execute();		
					echo "<script>alert('跳过成功')</script>";					
				}
			}else{
				echo "<script>alert('拆分失败')</script>";
			}
			

			echo '<script>location.href="index.php?r=jianguo%2Fexplodejd_sku"</script>';

		}else if($_REQUEST['new']){
			//return $this->actionNewproduct();
		
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
				//	print_r($datas);
				
					$model->tb_item_id=$datas[0];
					$model->name=$datas[1];
					$model->cid=$datas[2];
					$model->alias_bid=$datas[3];
					$model->package=$datas[4];
					$model->origin=$datas[5];
					$model->weight=$datas[6];
					$model->series=$datas[7];
					$model->flavor=$datas[8];
					$model->date=$datas[9];
					$model->brand_name=$datas[10];
					$model->cname_new=$datas[11];
					$model->type1=$datas[12];
					$model->type2=$datas[13];
					$model->size=$datas[14];
					$model->number1=$datas[15];
					$model->number2=$datas[16];
					$model->sku=$datas[17];
					$model->price=$datas[18];
					$model->avg_price=$datas[19];
					$model->gift=$datas[20];
					$model->mix=$datas[21];
					$model->flag=$datas[22];
				
					
					
					
			
					//return $this->actionNewproduct();
					return $this->render('newproduct',['model'=>$model,]);
				}
			}


		}
	}
	
	
	public function actionNewproduct(){
		//print_r (Yii::$app->request->post());
		$model = new  JianguoForm();
		$model->load(Yii::$app->request->post());
		//print_r($model);exit;
		//print_r($_GET);
		$fun=$_GET['fun'];
		//exit;
		 
		
		$model->image = UploadedFile::getInstance($model, "image");

	    if ($model->image && $model->validate()){  
			$model->image->saveAs("image/image_jianguo/" . $model['tb_item_id'] . '.jpg');
	    } 
		
		
		$sqltail='(\''.$model['tb_item_id'].'\',\''.$model['name'].'\','.$model['cid'].','.$model['alias_bid'].',\''.$model['package'].'\',\''.$model['origin'].'\',\''.$model['weight'].'\',\''.$model['series'].'\',\''.$model['flavor'].'\',\''.$model['date'].'\',\''.$model['brand_name'].'\',\''.$model['cname_new'].'\',\''.$model['type1'].'\',\''.$model['type2'].'\',\''.$model['size'].'\','.$model['number1'].','.$model['number2'].',\''.$model['sku'].'\','.$model['price'].','.$model['avg_price'].','.$model['gift'].','.$model['mix'].','.$model['flag'].',\''.$model['is_shelled'].'\')';
		//$sqltail='(\''.$model['name'].'\','.$model['alias_bid'].',\'D:\\\\10.14\\\\Dataway\\\\web\\\\image\\\\image\\\\'.$model['tb_item_id'].'.jpg\',\''.$model['classification'].'\',\''.$model['avg_price'].'\','.$model['p_num'].','.'1'.',\''.$model['serface_material'].'\',\''.$model['is_import'].'\',\''.$model['fragrance'].'\',\''.$model['insert_way'].'\',\''.$model['size'].'\',\''.$model['series'].'\',\''.$model['tb_item_id'].'\')';
		$sql="insert into hengshi.hengshi_product_ali(tb_item_id,name,cid,alias_bid ,package ,origin,weight,series,flavor,date,brand_name,cname_new,type1,type2,size,number1,number2,sku,price,avg_price,gift,mix,flag,is_shelled) values $sqltail";
		Yii::$app->db->createCommand($sql)->execute();		
		//echo $sql;exit;
		
		echo "<script>alert('添加单品成功')</script>";
		//return $this->actionExplode();
		if(isset($fun) and $fun=='sku'){
			echo '<script>location.href="index.php?r=jianguo%2Fexplode_sku"</script>';
		}else{	
			echo '<script>location.href="index.php?r=jianguo%2Fexplode"</script>';
		}
		//return $this->actionExplode();
		
		//echo  $sql;
		//$pdo->exec($sql);


		
		
	}
	
	public function actionNewproductjd(){
		//print_r (Yii::$app->request->post());
		$model = new  JianguoForm();
		$model->load(Yii::$app->request->post());
		//print_r($model);exit;
		$fun=$_GET['fun'];
		
		 
		
		$model->image = UploadedFile::getInstance($model, "image");

	    if ($model->image && $model->validate()){  
			$model->image->saveAs("image/image_jianguo/" . $model['tb_item_id'] . '.jpg');
	    } 
		
		
		$sqltail='(\''.$model['tb_item_id'].'\',\''.$model['name'].'\','.$model['cid'].','.$model['alias_bid'].',\''.$model['package'].'\',\''.$model['origin'].'\',\''.$model['weight'].'\',\''.$model['series'].'\',\''.$model['flavor'].'\',\''.$model['date'].'\',\''.$model['brand_name'].'\',\''.$model['cname_new'].'\',\''.$model['type1'].'\',\''.$model['type2'].'\',\''.$model['size'].'\','.$model['number1'].','.$model['number2'].',\''.$model['sku'].'\','.$model['price'].','.$model['avg_price'].','.$model['gift'].','.$model['mix'].','.$model['flag'].',\''.$model['is_shelled'].'\')';
		//$sqltail='(\''.$model['name'].'\','.$model['alias_bid'].',\'D:\\\\10.14\\\\Dataway\\\\web\\\\image\\\\image\\\\'.$model['tb_item_id'].'.jpg\',\''.$model['classification'].'\',\''.$model['avg_price'].'\','.$model['p_num'].','.'1'.',\''.$model['serface_material'].'\',\''.$model['is_import'].'\',\''.$model['fragrance'].'\',\''.$model['insert_way'].'\',\''.$model['size'].'\',\''.$model['series'].'\',\''.$model['tb_item_id'].'\')';
		$sql="insert into hengshi.hengshi_product_ali(tb_item_id,name,cid,alias_bid ,package ,origin,weight,series,flavor,date,brand_name,cname_new,type1,type2,size,number1,number2,sku,price,avg_price,gift,mix,flag,is_shelled) values $sqltail";
		Yii::$app->db->createCommand($sql)->execute();
		//echo $sql;exit;
		
		echo "<script>alert('添加单品成功')</script>";
		//return $this->actionExplode();
		
		if(isset($fun) and $fun=='sku'){
			echo '<script>location.href="index.php?r=jianguo%2Fexplodejd_sku"</script>';
		}else{	
			echo '<script>location.href="index.php?r=jianguo%2Fexplodejd"</script>';
		}
		
		
		//echo  $sql;
		//$pdo->exec($sql);


		
		
	}
	
	/*
	public function actionSidebar(){
		$model = new  JianguoForm();
		return $this->render('_sidebar',['model'=>$model,]);
		
	}
	*/
	public function actionQuickadd(){
		$model = new  JianguoForm();
		//print_r($_GET);
		$tb_item_id=$_GET['tb_item_id'];
		//$sql="select * from hengshi.hengshi_topitem_ali_mix where id=$mix_id";
		
		$sql="select tb_item_id,name,cid,alias_bid,package,origin,weight,series,flavor,date,brand_name,cname_new,type1,type2,size,number1,number2,sku,0 as price,0 as avg_price,gift,mix,0 as flag from hengshi.hengshi_item_ali_my where tb_item_id=$tb_item_id order by date desc limit 1;";

		
		$mixzs=Yii::$app->db->createCommand($sql)->queryAll();
		$mix=$mixzs[0];
		//print_r($mix);
		
		$model->tb_item_id=$mix['tb_item_id'];
		$model->name=$mix['name'];
		$model->cid=$mix['cid'];
		$model->alias_bid=$mix['alias_bid'];
		$model->package=$mix['package'];
		$model->origin=$mix['origin'];
		$model->weight=$mix['weight'];
		$model->series=$mix['series'];
		$model->flavor=$mix['flavor'];
		$model->date=$mix['date'];
		$model->brand_name=$mix['brand_name'];
		$model->cname_new=$mix['cname_new'];
		$model->type1=$mix['type1'];
		$model->type2=$mix['type2'];
		$model->size=$mix['size'];
		$model->number1=$mix['number1'];
		$model->number2=$mix['number2'];
		$model->sku=$mix['sku'];
		//$model->price=$mix['price'];
		$model->avg_price=$mix['avg_price'];
		$model->gift=$mix['gift'];
		$model->mix=$mix['mix'];
		$model->flag=$mix['flag'];
		//print_r($model);
		//exit;
		return $this->render('newproduct',['model'=>$model,]);
		
	}
	public function actionQuickaddjd(){
		$model = new  JianguoForm();
		//print_r($_GET);
		$tb_item_id=$_GET['tb_item_id'];
		//$sql="select * from hengshi.hengshi_topitem_jd_mix where id=$mix_id";
		$sql="select tb_item_id,name,cid,alias_bid,package,origin,weight,series,flavor,date,brand_name,cname_new,type1,type2,size,number1,number2,sku,0 as price,0 as avg_price,gift,mix,0 as flag from hengshi.hengshi_item_ali_my where tb_item_id=$tb_item_id order by date desc limit 1;";

		$mixzs=Yii::$app->db->createCommand($sql)->queryAll();
		$mix=$mixzs[0];
		//print_r($mix);
		
		$model->tb_item_id=$mix['tb_item_id'];
		$model->name=$mix['name'];
		$model->cid=$mix['cid'];
		$model->alias_bid=$mix['alias_bid'];
		$model->package=$mix['package'];
		$model->origin=$mix['origin'];
		$model->weight=$mix['weight'];
		$model->series=$mix['series'];
		$model->flavor=$mix['flavor'];
		$model->date=$mix['date'];
		$model->brand_name=$mix['brand_name'];
		$model->cname_new=$mix['cname_new'];
		$model->type1=$mix['type1'];
		$model->type2=$mix['type2'];
		$model->size=$mix['size'];
		$model->number1=$mix['number1'];
		$model->number2=$mix['number2'];
		$model->sku=$mix['sku'];
		//$model->price=$mix['price'];
		$model->avg_price=$mix['avg_price'];
		$model->gift=$mix['gift'];
		$model->mix=$mix['mix'];
		$model->flag=$mix['flag'];
		//print_r($model);
		//exit;
		return $this->render('newproduct',['model'=>$model,]);
		
	}
	
	
	
	
	public function actionCreate(){
		$model = new JianguoForm();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			return $this->renderAjax('_sidebar', [
				'model' => $model,
			]);
		}
		
		
	}
	
	public function actionChangeimg(){
		$model = new JianguoForm();
		print_r($_GET);
		
		$model->tb_item_id=$_GET['tb_item_id'];
		$platform=$_GET['platform'];
		$fun=$_GET['fun'];
		//echo $model->tb_item_id;
		
		return $this->render('addimg',['model' => $model,'platform'=>$platform,'fun'=>$fun]);
	}
	
	
	public function actionSolve(){
		
		//var_dump($_POST);
		//print_r($_elements);
		
		//print_r($_GET);
		$platform=$_GET['platform'];
		$fun=$_GET['fun'];
		//print_r($_POST);
		
		$model = new  JianguoForm();
		$model->load(Yii::$app->request->post());
		$model->image = UploadedFile::getInstance($model, "image");
		
		//print_r($model);
		
		if(file_exists("D:/excercise/basic/web/image/image_jianguo/".$model->tb_item_id.'.jpg')){
			echo "存在";
			unlink("D:/excercise/basic/web/image/image_jianguo/".$model->tb_item_id.'.jpg');
			echo "shanchu chenggong";
			if ($model->image){  
				$model->image->saveAs("image/image_jianguo/" . $model->tb_item_id . '.jpg');
				echo "<script>alert('修改成功')</script>";
			}else{
				echo "<script>alert('修改失败')</script>";
			} 
			
			
		}else{
			echo "空缺";
			if ($model->image){  
				$model->image->saveAs("image/image_jianguo/" . $model->tb_item_id . '.jpg');
				echo "<script>alert('修改成功')</script>";
			}else{
				echo "<script>alert('修改失败')</script>";
			} 
		}
		
		
		
		if($platform=='ali'){
			if($fun=='sku'){
				echo '<script>location.href="index.php?r=jianguo%2Fexplode_sku"</script>';
			}else{
				echo '<script>location.href="index.php?r=jianguo%2Fexplode"</script>';
			}
		}else{
			if($fun=='sku'){
				echo '<script>location.href="index.php?r=jianguo%2Fexplodejd_sku"</script>';	
			}else{
				echo '<script>location.href="index.php?r=jianguo%2Fexplodejd"</script>';	
			}
		}
		
		
		//echo '<script>location.href="index.php?r=jianguo%2Fexplode"</script>';
		
	}
	
	public function actionNewexplode(){
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$zs=$data->username;
			echo "<script>alert('$zs')</script>";
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			
			return [
				'username' => $zs,
			];
		}else{
			echo '!!!!!';
			exit;
		}
	
	}
	
	
	
}
