<?php
namespace app\models;

use Yii;
use yii\base\Model;

class JianguoForm extends Model
{	
	public $tb_item_id;
	public $name;
	public $cid;
	public $alias_bid;
	public $package;
	public $origin;
	public $weight;
	public $series;
	public $flavor;
	public $date;
	public $brand_name;
	public $cname_new;
	public $type1;
	public $type2;
	public $size;
	public $number1;
	public $number2;
	public $sku;
	public $price;
	public $avg_price;
	public $gift;
	public $mix;
	public $flag;
	public $image;
	public $is_shelled;
	
	
	


    public function rules()
    {
        return [
              [['image'], 'file'],
			  ['name','required'],
			  ['cid','required'],
			  ['alias_bid','integer'],
			  ['avg_price','required'],
			  ['package','required'],
			  ['origin','required'],
			  ['weight','required'],
			  ['date','required'],
			  ['flavor','required'],
			  ['size','required'],
			  ['series','required'],
			  ['brand_name','required'],
			  ['cname_new','required'],
			  ['type1','required'],
			  ['type2','required'],
			  ['number1','required'],
			  ['number2','required'],
			  ['sku','required'],
			  ['price','required'],
			  ['avg_price','required'],
			  ['gift','required'],
			  ['mix','required'],
			  ['flag','required'],
			  ['tb_item_id','required'],
			  ['is_shelled','required'],
			  
        ];
    }
	
	 public function attributeLabels()
    {
        return [
            'name' => '品名',
			'alias_bid' => 'alias_bid',
			'cid' => 'cid',
			'avg_price' => '均价',
			'package' => 'package',
			'origin' => 'origin',
			'weight' => '重量',
			'flavor' => '口味',
			'date' => 'date',
			'brand_name' => '品牌名',
			'cname_new' => 'cname_new',
			'type1' => 'type1',
			'type2' => 'type2',
			'size' => 'size',
			'number1' => 'number1',
			'number2' => 'number2',
			'sku' => 'sku',
			'price' => '价格',
			'gift' => 'gift',
			'mix' => 'mix',
			'flag' => 'flag',
			'tb_item_id' => 'tb_item_id',
			'image' => '图片',
			'is_shelled'=>'有壳无壳',
        ];
    }
	
	
}


