<?php

/* @var $this yii\web\View */

$this->title = 'Weishengjin';
$products=$data['products'];
$numofproduct=$data['numofproduct'];
$mix=$data['mix'];
$miximg=$data['miximg'];
$platform=$data['platform'];
if($platform=='ali'){
	$flag='';
}else{
	$flag='jd';
}
//print_r($mix);exit;



?>



<form action='/index.php?r=weishengjin/add<?php echo $flag?>' method='post' > 
			
			<input type="hidden" name="mix_id"  value="<?php echo $mix['tb_item_id']?>">
			<input type="hidden" name="if_out_alias"  value="<?php echo $numofproduct?>">
			<input type="hidden" name="user_id"  value="<?php echo $id_user?>">
			<input type="hidden" name="mix_alias_bid"  value="<?php echo $mix['alias_bid']?>">
		

 <div class="body-content">
<?php for($j=0;$j<$numofproduct;$j+=3){?>
        <div class="row">
		<?php
			if($j<3){$r=0;}else{$r+=3;}
			if($numofproduct-3<$r){$top=$numofproduct;}else{$top=$r+3;}
			for($e=$r;$e<$top;$e++){?>
		<?php 
				$r_str=$products[$e]['name'].','.$products[$e]['alias_bid'].','.$products[$e]['classification'].','.$products[$e]['avg_price'].','.$products[$e]['p_num'].','.$products[$e]['serface_material'].','.$products[$e]['is_import'].','.$products[$e]['fragrance'].','.$products[$e]['insert_way'].','.$products[$e]['size'].','.$products[$e]['series'].','.$products[$e]['tb_item_id'];
		?>
            <div class="col-lg-4">
				<input type="hidden" name="r_str<?php echo $products[$e]['id']?>"  value="<?php echo $r_str?>">
			             
				
                <p><img src="<?php echo '/image/image/'.$products[$e]['tb_item_id'].'.jpg'?>" width="330" height="220"></p>
				
				<h5><a href="https://item.taobao.com/item.htm?id=<?php echo $products[$e]['tb_item_id']?>" target="_blank" ><?php echo $products[$e]['name']?></a><?php echo '----avg_price:'.$products[$e]['avg_price']?></h5>
				
			    <p align="left" >数量:&emsp;<input width="250px" type="text" name="<?php echo 'num'.$products[$e]['id']?>" >&emsp;&emsp;&emsp;&emsp;<input  type="submit"  name="addlike<?php echo  $products[$e]['id']?>" value="添加"></p>
            </div>
		<?php }?>	
		
           
        </div>
<?php }?>

</div>

	<br><input type="submit" name="explode" value="提交"><input type="submit"  name="new" value="新建"><br>
	</form>

	

<head>
<style type="text/css">
#msg_win{
    position:absolute;
    right:0px;
    overflow:hidden;
    z-index:99;
    border:1px solid #3C3C3C;
    background:#FFFFFF;
    width:450px;
    font-size:12px;
    margin:0px;
    display:block;
    top:370px;
    visibility:visible;
    opacity:1;
    }
#msg_win .icos{
    position:absolute;
    top:2px;
    left:2px;
    z-index:9;
    }
.icos a{
    float:right;
    color:#FFFFFF;
    margin:1px;
    text-align:center;
    font-weight:bold;
    width:14px;
    height:22px;
    line-height:22px;
    padding:1px;
    text-decoration:none;
    font-family:webdings;
    }
.icos a:hover{
    color:#FFCC00;
    }
#msg_title{
    background:#3C3C3C;
    border-bottom:1px solid #710B97;
    border-top:0px solid #FFF;
    border-left:0px solid #FFF;
    color:#3C3C3C;
    height:25px;
    line-height:25px;
    text-indent:5px;
    font-weight:bold;
    }
#msg_content{
    margin:5px;
    margin-right:0;
    width:450px;
    height:370px;
    overflow:hidden;
    }
</style>
</head>
<body>
<div style="height:2000px;"></div>
<div id="msg_win" >
  <div class="icos">
    <a id="msg_min" title="最小化" href="javascript:void 0">_</a><a id="msg_close" title="关闭" href="javascript:void 0">×</a>
  </div>
  <div id="msg_title">混合装显示：</div>
	<div id="msg_content">
		<br><tr><td>
		<?php if($flag==''){ ?>
		<a href="https://item.taobao.com/item.htm?id=<?php echo $mix['tb_item_id']?>" target="_blank" ><?php echo $mix['name'].'----avg_price:'.$mix['avg_price']?></a>
		<?php }else{ ?>
		<a href="https://item.jd.com/<?php echo $mix['tb_item_id']?>.html" target="_blank" ><?php echo $mix['name']?></a>
		<?php } ?>
		</td></tr><br>
		<br><img src="<?php echo $miximg?>" width="420" height="350"><br>
	</div>
</div>
<script>
/*
      function add(asd){
	   alert(asd);
       location.href="wsjcloud.php?id=2";
	  }
	  
*/	  
</script>


<script language="javascript">
var Message={
    set: function() {//最小化与恢复状态切换
        var set=this.minbtn.status == 1?[0,1,'block',this.char[0],'最小化']:[1,0,'none',this.char[1],'恢复'];
        this.minbtn.status=set[0];
        this.win.style.borderBottomWidth=set[1];
        this.content.style.display =set[2];
        this.minbtn.innerHTML =set[3];
        this.minbtn.title = set[4];
        this.win.style.top = this.getY().top;
    },
    close: function() {//关闭
        this.win.style.display = 'none';
        window.onscroll = null;
    },
    setOpacity: function(x) {//设置透明度
        var v = x >= 100 ? '': 'Alpha(opacity=' + x + ')';
        this.win.style.visibility = x<=0?'hidden':'visible';//IE有绝对或相对定位内容不随父透明度变化的bug
        this.win.style.filter = v;
        this.win.style.opacity = x / 100;
    },
    show: function() {//渐显
        clearInterval(this.timer2);
        var me = this,fx = this.fx(0, 100, 0.1),t = 0;
        this.timer2 = setInterval(function() {
            t = fx();
            me.setOpacity(t[0]);
            if (t[1] == 0) {
                clearInterval(me.timer2) 
            }
        },6);//10 to 6
    },
    fx: function(a, b, c) {//缓冲计算
            var cMath = Math[(a - b) > 0 ? "floor": "ceil"],c = c || 0.1;
            return function() {
                return [a += cMath((b - a) * c), a - b]
            }
    },
    getY: function() {//计算移动坐标
        var d = document,b = document.body, e = document.documentElement;
        var s = Math.max(b.scrollTop, e.scrollTop);
        var h = /BackCompat/i.test(document.compatMode)?b.clientHeight:e.clientHeight;
        var h2 = this.win.offsetHeight;
        return {foot: s + h + h2 + 2+'px',top: s + h - h2 - 2+'px'}
    },
    moveTo: function(y) {//移动动画
        clearInterval(this.timer);
        var me = this,a = parseInt(this.win.style.top)||0;
        var fx = this.fx(a, parseInt(y));
        var t = 0 ;
        this.timer = setInterval(function() {
            t = fx();
            me.win.style.top = t[0]+'px';
            if (t[1] == 0) {
                clearInterval(me.timer);
                me.bind();
            }
        },6);//10 to 6
    },
    bind:function (){//绑定窗口滚动条与大小变化事件
        var me=this,st,rt;
        window.onscroll = function() {
            clearTimeout(st);
            clearTimeout(me.timer2);
            me.setOpacity(0);
            st = setTimeout(function() {
                me.win.style.top = me.getY().top;
                me.show();
            },100);//600 mod 100
        };
        window.onresize = function (){
            clearTimeout(rt);
            rt = setTimeout(function() {me.win.style.top = me.getY().top},100);
        }
    },
    init: function() {//创建HTML
        function $(id) {return document.getElementById(id)};
        this.win=$('msg_win');
        var set={minbtn: 'msg_min',closebtn: 'msg_close',title: 'msg_title',content: 'msg_content'};
        for (var Id in set) {this[Id] = $(set[Id])};
        var me = this;
        this.minbtn.onclick = function() {me.set();this.blur()};
        this.closebtn.onclick = function() {me.close()};
        this.char=navigator.userAgent.toLowerCase().indexOf('firefox')+1?['_','::','×']:['0','2','r'];//FF不支持webdings字体
        this.minbtn.innerHTML=this.char[0];
        this.closebtn.innerHTML=this.char[2];
        setTimeout(function() {//初始化最先位置
            me.win.style.display = 'block';
            me.win.style.top = me.getY().foot;
            me.moveTo(me.getY().top);
        },0);
        return this;
    }
};
Message.init();
</SCRIPT>
	

