<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FileForm extends Model
{
	public $file 
	public $file_name;
	public $file_dir;
	public $file_size;
	
	


    public function rules()
    {
        return [
              [['file'], 'file'],
			  ['file_name','required'],
			  ['file_dir','required'],
			  ['file_size','required'],
			 
        ];
    }
	
	 public function attributeLabels()
    {
        return [
            'name' => '品名',
			'alias_bid' => 'alias_bid',
			'avg_price' => '平均价格',
			'p_num' => '片数',
			
        ];
    }
	
	
	public function tamplate()
	{
		
	}
	
	
}


