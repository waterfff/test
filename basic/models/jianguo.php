<?php
namespace app\models;

use Yii;
use yii\base\Model;

class WeishengjinForm extends Model
{	
	public $tb_item_id;
	public $name;
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
	
	
	


    public function rules()
    {
        return [
              [['image'], 'file'],
			  ['name','required'],
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
        ];
    }
	
	 public function attributeLabels()
    {
        return [
            'name' => 'name',
			'alias_bid' => 'alias_bid',
			'avg_price' => 'avg_price',
			'package' => 'package',
			'origin' => 'origin',
			'weight' => 'weight',
			'flavor' => 'flavor',
			'date' => 'date',
			'brand_name' => 'brand_name',
			'cname_new' => 'cname_new',
			'type1' => 'type1',
			'type2' => 'type2',
			'size' => 'size',
			'number1' => 'number1',
			'number2' => 'number2',
			'sku' => 'sku',
			'price' => 'price',
			'gift' => 'gift',
			'mix' => 'mix',
			'flag' => 'flag',
			'tb_item_id' => 'tb_item_id',
			'image' => '图片',
        ];
    }
	
	
}


