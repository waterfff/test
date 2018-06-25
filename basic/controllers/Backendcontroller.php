<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\web\UploadedFile;

class BackendController extends Controller
{	public $enableCsrfValidation=false;

    public function actionIndex()
    {
		$user_id=Yii::$app->user->id;
		if($user_id==102){
			return $this->render('index');
		}else{
			echo "<script>alert('你没有后台权限')</script>";
			echo '<script>location.href="index.php?r=site%2Findex"</script>';
				 
		}
    }
	
	
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
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
	
	
	
	
}
	
	
	
