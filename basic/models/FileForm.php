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
            'name' => 'Ʒ��',
			'alias_bid' => 'alias_bid',
			'avg_price' => 'ƽ���۸�',
			'p_num' => 'Ƭ��',
			
        ];
    }
	
	
	public function tamplate()
	{
		
	}
	
	
}


