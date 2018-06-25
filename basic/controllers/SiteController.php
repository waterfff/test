<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$getall="select count(*) from artificial.entity_1359_mix where checked_month=1804";
		$all = Yii::$app->db->createCommand($getall)->queryAll();
		
		$getfinish="select count(*) from artificial.entity_1359_mix where checked=1 and checked_month=1804";
		$finish = Yii::$app->db->createCommand($getfinish)->queryAll();
		
		$getnot="select count(*) from artificial.entity_1359_mix where checked=0 and checked_month=1804";
		$not = Yii::$app->db->createCommand($getnot)->queryAll();
		
		$getskip="select count(*) from artificial.entity_1359_mix where (checked=2 or checked=3) and checked_month=1804";
		$skip = Yii::$app->db->createCommand($getskip)->queryAll();
		
		$data['wsal']['allnum']=$all[0]['count(*)'];
		$data['wsal']['finishnum']=$finish[0]['count(*)'];
		$data['wsal']['notnum']=$not[0]['count(*)'];
		$data['wsal']['skipnum']=$skip[0]['count(*)'];
		
		if($data['wsal']['allnum']){
			$data['wsal']['finishle']=round(150*$data['wsal']['finishnum']/$data['wsal']['allnum']);
			$data['wsal']['notle']=round(150*$data['wsal']['notnum']/$data['wsal']['allnum']);
			$data['wsal']['skiple']=round(150*$data['wsal']['skipnum']/$data['wsal']['allnum']);
		}
		
		
		$getall="select count(*) from artificial.entity_1359_jd_mix where checked_month=1804";
		$alljd = Yii::$app->db->createCommand($getall)->queryAll();
		
		$getfinish="select count(*) from artificial.entity_1359_jd_mix where checked=1 and checked_month=1804";
		$finishjd = Yii::$app->db->createCommand($getfinish)->queryAll();
		
		$getnot="select count(*) from artificial.entity_1359_jd_mix where checked=0 and checked_month=1804";
		$notjd = Yii::$app->db->createCommand($getnot)->queryAll();
		
		$getskip="select count(*) from artificial.entity_1359_jd_mix where (checked=2 or checked=3) and checked_month=1804";
		$skipjd = Yii::$app->db->createCommand($getskip)->queryAll();
		
		$data['wsjd']['allnum']=$alljd[0]['count(*)'];
		$data['wsjd']['finishnum']=$finishjd[0]['count(*)'];
		$data['wsjd']['notnum']=$notjd[0]['count(*)'];
		$data['wsjd']['skipnum']=$skipjd[0]['count(*)'];
		
		if($data['wsjd']['allnum']){
			$data['wsjd']['finishle']=round(150*$data['wsjd']['finishnum']/$data['wsjd']['allnum']);
			$data['wsjd']['notle']=round(150*$data['wsjd']['notnum']/$data['wsjd']['allnum']);
			$data['wsjd']['skiple']=round(150*$data['wsjd']['skipnum']/$data['wsjd']['allnum']);
		}
		
		//print_r($data);exit;
		
		$getall="select count(*) from hengshi.hengshi_topitem_ali_mix ";
		$all = Yii::$app->db->createCommand($getall)->queryAll();
		$getfinish="select count(*) from hengshi.hengshi_topitem_ali_mix where `check`=1";
		$finish = Yii::$app->db->createCommand($getfinish)->queryAll();
		$getnot="select count(*) from hengshi.hengshi_topitem_ali_mix where  `check`=0";
		$not = Yii::$app->db->createCommand($getnot)->queryAll();
		
		$data['jgal']['allnum']=$all[0]['count(*)'];
		$data['jgal']['finishnum']=$finish[0]['count(*)'];
		$data['jgal']['notnum']=$not[0]['count(*)'];
		$data['jgal']['skipnum']=0;
		
		if($data['jgal']['allnum']){
		$data['jgal']['finishle']=round(150*$data['jgal']['finishnum']/$data['jgal']['allnum']);
		$data['jgal']['notle']=round(150*$data['jgal']['notnum']/$data['jgal']['allnum']);
		$data['jgal']['skiple']=round(150*$data['jgal']['skipnum']/$data['jgal']['allnum']);
		}
		
		
		
		$getall="select count(*) from hengshi.hengshi_topitem_jd_mix ";
		$all = Yii::$app->db->createCommand($getall)->queryAll();
		$getfinish="select count(*) from hengshi.hengshi_topitem_jd_mix where `check`=1";
		$finish = Yii::$app->db->createCommand($getfinish)->queryAll();
		$getnot="select count(*) from hengshi.hengshi_topitem_jd_mix where  `check`=0";
		$not = Yii::$app->db->createCommand($getnot)->queryAll();
		
		$data['jgjd']['allnum']=$all[0]['count(*)'];
		$data['jgjd']['finishnum']=$finish[0]['count(*)'];
		$data['jgjd']['notnum']=$not[0]['count(*)'];
		$data['jgjd']['skipnum']=0;
		
		if($data['jgjd']['allnum']){
		$data['jgjd']['finishle']=round(150*$data['jgjd']['finishnum']/$data['jgjd']['allnum']);
		$data['jgjd']['notle']=round(150*$data['jgjd']['notnum']/$data['jgjd']['allnum']);
		$data['jgjd']['skiple']=round(150*$data['jgjd']['skipnum']/$data['jgjd']['allnum']);
		}

		
		$getall="select count(*) from hengshi.hengshi_topitem_ali_sku ";
		$all = Yii::$app->db->createCommand($getall)->queryAll();
		$getfinish="select count(*) from hengshi.hengshi_topitem_ali_sku where `check`=1";
		$finish = Yii::$app->db->createCommand($getfinish)->queryAll();
		$getnot="select count(*) from hengshi.hengshi_topitem_ali_sku where  `check`=0";
		$not = Yii::$app->db->createCommand($getnot)->queryAll();
		$getskip="select count(*) from hengshi.hengshi_topitem_ali_sku where `check`=2 or `check`=3";
		$skip = Yii::$app->db->createCommand($getskip)->queryAll();
		
		$data['jgalsku']['allnum']=$all[0]['count(*)'];
		$data['jgalsku']['finishnum']=$finish[0]['count(*)'];
		$data['jgalsku']['notnum']=$not[0]['count(*)'];
		$data['jgalsku']['skipnum']=$skip[0]['count(*)'];
		
		if($data['jgalsku']['allnum']){
		$data['jgalsku']['finishle']=round(150*$data['jgalsku']['finishnum']/$data['jgalsku']['allnum']);
		$data['jgalsku']['notle']=round(150*$data['jgalsku']['notnum']/$data['jgalsku']['allnum']);
		$data['jgalsku']['skiple']=round(150*$data['jgalsku']['skipnum']/$data['jgalsku']['allnum']);
		}
		
		$getall="select count(*) from hengshi.hengshi_topitem_jd_sku ";
		$all = Yii::$app->db->createCommand($getall)->queryAll();
		$getfinish="select count(*) from hengshi.hengshi_topitem_jd_sku where `check`=1";
		$finish = Yii::$app->db->createCommand($getfinish)->queryAll();
		$getnot="select count(*) from hengshi.hengshi_topitem_jd_sku where  `check`=0";
		$not = Yii::$app->db->createCommand($getnot)->queryAll();
		$getskip="select count(*) from hengshi.hengshi_topitem_jd_sku where `check`=2 or `check`=3";
		$skip = Yii::$app->db->createCommand($getskip)->queryAll();
		
		$data['jgjdsku']['allnum']=$all[0]['count(*)'];
		$data['jgjdsku']['finishnum']=$finish[0]['count(*)'];
		$data['jgjdsku']['notnum']=$not[0]['count(*)'];
		$data['jgjdsku']['skipnum']=$skip[0]['count(*)'];
		
		if($data['jgjdsku']['allnum']){
		$data['jgjdsku']['finishle']=round(150*$data['jgjdsku']['finishnum']/$data['jgjdsku']['allnum']);
		$data['jgjdsku']['notle']=round(150*$data['jgjdsku']['notnum']/$data['jgjdsku']['allnum']);
		$data['jgjdsku']['skiple']=round(150*$data['jgjdsku']['skipnum']/$data['jgjdsku']['allnum']);
		}
        return $this->render('index',['data'=>$data]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
			
        }
		//print_r($model);
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

	public function actionView(){
		
		//print_r($_GET);
		$filename=$_GET['id'];
		$fp= fopen("./excel_utf/$filename","r"); 
		while ($data = fgetcsv($fp,",")) { 
		 $firstdata[] = $data;
		 }
		 
		//print_r($firstdata);
		$head=[];
		for($i=0;$i<count($firstdata);$i++){
			if($i==0){
				$head=$firstdata[$i];
			}else{
				for($j=0;$j<count($firstdata[$i]);$j++){
					$finaldata[$i-1][$head[$j]]=$firstdata[$i][$j];
				}
			}
			
			
		}
		//print_r($finaldata);
		
		//exit;
		return $this->render('show',['finaldata'=>$finaldata,'head'=>$firstdata[0]]);
		
		
	}
	
	public function actionDownload(){
		$filename=$_GET['id'];
		$res = \YII::$app->response;
		$res->sendFile("./excel/$filename");
		
	}
	
	
}
