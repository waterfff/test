<?php
namespace app\models;

use Yii;
use yii\base\Model;

class WscheckForm extends Model
{
	public $name;
	public $alias_bid;
	public $avg_price;
	public $p_num;
	public $classification;
	public $serface_material;
	public $is_import;
	public $fragrance;
	public $insert_way;
	public $size;
	public $series;
	public $tb_item_id;
	public $image;
	


    public function rules()
    {
        return [
			  ['name','required'],
			  ['is_mix','required'],
			  ['avg_price','required'],
			  ['tb_item_id','required'], 
        ];
    }
	
	 public function attributeLabels()
    {
        return [
            'name' => '品名',
			'is_mix' => '是否为混合装',
			'avg_price' => '平均价格',
			'tb_item_id' => '商品ID',
			
        ];
    }
	
	
}


