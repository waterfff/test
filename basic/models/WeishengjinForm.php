<?php
namespace app\models;

use Yii;
use yii\base\Model;

class WeishengjinForm extends Model
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
	public $platform;
	


    public function rules()
    {
        return [
              [['image'], 'file'],
			  ['name','required'],
			  ['alias_bid','integer'],
			  ['avg_price','required'],
			  ['p_num','integer'],
			  ['serface_material','required'],
			  ['classification','required'],
			  ['is_import','required'],
			  ['fragrance','required'],
			  ['size','required'],
			  ['series','required'],
			  ['tb_item_id','required'],
			  ['platform','required'],
			  ['insert_way','required'],
        ];
    }
	
	 public function attributeLabels()
    {
        return [
            'name' => '品名',
			'alias_bid' => 'alias_bid',
			'avg_price' => '平均价格',
			'p_num' => '片数',
			'serface_material' => '表面材质',
			'classification' => '分类',
			'is_import' => '是否进口',
			'fragrance' => '有无香味',
			'insert_way' => '置入方式',
			'size' => '尺码',
			'series' => '系列',
			'tb_item_id' => 'tb_item_id',
			'image' => '图片',
			'platform'=>'平台',
        ];
    }
	
	
}


