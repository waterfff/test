<?php
namespace app\models;

use Yii;
use yii\base\Model;

class JianguoexForm extends Model
{	

	public $flavor;
	public $type1;
	public $type2;
	public $size;
	public $number2;

	
	
	


    public function rules()
    {
        return [

			  
        ];
    }
	
	 public function attributeLabels()
    {
        return [
           
			'flavor' => '口味',
			'type1' => 'type1',
			'type2' => 'type2',
			'size' => 'size',
			'number2' => 'number2',
			
        ];
    }
	
	
}


