<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/Home.css"/>
<style type="text/css">
<!--
.demo{ width:740px; height:333px; position:relative; overflow:hidden; padding:0px;}
.num{ position:absolute;right:20px; top:300px; z-index:10;}
.num a{background:#fff; color:#f60; border:1px solid #ccc; width:25px; height:25px; display:inline-block; text-align:center; line-height:25px; margin:0 3px; cursor:pointer;font-weight: bold;}
.num a.cur{border:1px solid #f60; background:#f60;color:#fff;}
.demo ul{ position:relative; z-index:0;}
.demo ul li{ position:absolute; display:none;}
#indexheadpopup{width:815px;height:455px;position:fixed;z-index:9999;left:50%;margin-left:-400px;top:50%;margin-top:-200px;display:none;}
#indexheadpopup a{display:block;position:absolute;text-decoration:none;right:415px;top:415px;font: 12px/1.5 arial;background:#B50000;padding:2px 5px;color:#fff;}
#indexheadpopup a:hover{background:red;}
-->
</style>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/homead.js"></script>
<div id="indexheadpopup">
<a href="javascript:;" onclick="indexheadpopup.style.display='none'">关闭</a>
<img src="/statics/uploads/banner/index.png"></div>

<div class="bk10"></div>
<!--banner and Recommend 开始-->
<div class="banner_recommend">
	<div class="banner-box">
		<div id="posterTopNav" class="yg-flow"><a href="<?php echo WEB_PATH; ?>/single/newbie" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/banner/20130524181745143.gif" alt="新手指南" width="742" height="50"></a></div>
		<?php $slides=$this->DB()->GetList("select * from `@#_slide` where 1",array("type"=>1,"key"=>'',"cache"=>0)); ?>
		<div class="demo">					
			<ul>		
            	<?php $ln=1;if(is_array($slides)) foreach($slides AS $slide): ?>
                <?php if($ln == 1): ?>
            	<li style="display:list-item;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
             	<?php  else: ?>
            <li style="display:none;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
                <?php endif; ?>
                <?php  endforeach; $ln++; unset($ln); ?>
            </ul>
			 <div class="num">
			<?php 					
				for($i=1;$i<=count($slides);$i++){
				echo '<a class="">'.$i.'</a>' ;
				}
			 ?>
			</div>
			<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		</div>
</div>
	<script type="text/javascript">
$(function(){
	var sw = 0;
	$(".demo .num a").mouseover(function(){
		sw = $(".num a").index(this);
		myShow(sw);
	});
	function myShow(i){
		$(".demo .num a").eq(i).addClass("cur").siblings("a").removeClass("cur");
		$(".demo ul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}
	//滑入停止动画，滑出开始动画
	$(".demo").hover(function(){
		if(myTime){
		   clearInterval(myTime);
		}
	},function(){
		myTime = setInterval(function(){
		  myShow(sw)
		  sw++;
		  if(sw==<?php echo count($slides); ?>){sw=0;}
		} , 3000);
	});
	//自动开始
	var myTime = setInterval(function(){
	   myShow(sw)
	   sw++;
	   if(sw==<?php echo count($slides); ?>){sw=0;}
	} , 3000);
})
</script>
    <!-- 首页右边推荐商品 start-->
    <?php if($new_shop): ?>
	<div class="recommend">
    
		<ul class="Pro">			
			<li>
				<div class="pic">
				<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>" target="_blank" title="<?php echo $new_shop['title']; ?>">
				<i class="goods_tj"></i>
				<img alt="<?php echo $new_shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $new_shop['thumb']; ?>">
				</a>
				<p name="buyCount" style="display:none;"></p>
				</div>
				<p class="name">
					<strong><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>" target="_blank" title="<?php echo $new_shop['title']; ?> ">
                    <?php echo $new_shop['title']; ?></strong></a>
				</p>
				<p class="money">价值：<span class="rmb"><?php echo $new_shop['money']; ?></span></p>
				<div class="Progress-bar" style="">
					<p title="已完成<?php echo percent($new_shop['canyurenshu'],$new_shop['zongrenshu']); ?>"><span style="width:<?php echo width($new_shop['canyurenshu'],$new_shop['zongrenshu'],205); ?>px;"></span></p>
					<ul class="Pro-bar-li">
						<li class="P-bar01"><em><?php echo $new_shop['canyurenshu']; ?></em>已参与人次</li>
						<li class="P-bar02"><em><?php echo $new_shop['zongrenshu']; ?></em>总需人次</li>
						<li class="P-bar03"><em><?php echo $new_shop['zongrenshu']-$new_shop['canyurenshu']; ?></em>剩余人次</li>
					</ul>
				</div>
				<p>
					<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>" target="_blank" class="go_buy"></a>
				</p>
			</li>				
		</ul>
	</div>
   <?php endif; ?>
    <!-- 首页右边推荐商品 end-->
</div>
<!--banner and Recommend 结束-->
<!--product 开始-->
<div class="goods_hot">
	<div class="goods_left">
    
		<div class="new_lottery">        	
			<h4><span>最新揭晓</span><a rel="nofollow" href="<?php echo WEB_PATH; ?>/goods_lottery">更多&gt;&gt;</a></h4>
			<ul id="ulNewAwary" style="padding-bottom:5px;">
            <style>
				.new_li .pic img{ margin-left:15px;}		
			</style>
			<?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
            <?php 
            	$qishu['q_user'] = unserialize($qishu['q_user']);
             ?>
			<li class="new_li">
			<a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="pic"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>" /></a>
			<a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="name"><?php echo $qishu['title']; ?></a> 
		  	<span class="winner">获得者：<a rel="nofollow" class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>" target="_blank"><?php echo get_user_name($qishu['q_user']); ?></a></span>
			</li>
			<?php  endforeach; $ln++; unset($ln); ?>
			</ul>
            <!------>
            	<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/GLotteryFun.js"></script>
                <script type="text/javascript">
					$(document).ready(function(){gg_show_time_init("ulNewAwary",'<?php echo WEB_PATH; ?>',0);});					
			    </script>  
            <!------>
		</div>                
		<div class="hot">
			<h3><span>人气商品</span><a rel="nofollow" href="<?php echo WEB_PATH; ?>/goods_list">更多&gt;&gt;</a></h3>
			<ul id="hostGoodsItems" class="hot-list">											
				<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
				<li class="list-block">
					<div class="pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>">					
					<?php if(isset($renqi['t_max_qishu'])): ?>							
							<i class="goods_rq"></i>							
					<?php endif; ?>					
					<?php if(isset($renqi['t_new_goods'])): ?>						
							<i class="goods_xp"></i>					
					<?php endif; ?>
					<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" alt="<?php echo $renqi['title']; ?>"></a></div>
					<p class="name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>"><?php echo $renqi['title']; ?></a></p>
					<p class="money">市场价：<span class="rmb"><?php echo $renqi['money']; ?></span> 元</p>
					<div class="Progress-bar" style="">
						<p title="已完成<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>"><span style="width:<?php echo width($renqi['canyurenshu'],$renqi['zongrenshu'],221); ?>px;"></span></p>
						<ul class="Pro-bar-li">
							<li class="P-bar01"><em><?php echo $renqi['canyurenshu']; ?></em>已参与人次</li>
							<li class="P-bar02"><em><?php echo $renqi['zongrenshu']; ?></em>总需人次</li>
							<li class="P-bar03"><em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>剩余人次</li>
						</ul>
					</div>
					<div class="shop_buttom"><span class="lf"><?php echo _cfg("web_name_two"); ?>价<em><?php echo $renqi['yunjiage']; ?></em> </span><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" class="shop_but rt" title="立即<?php echo _cfg("web_name_two"); ?>">立即<?php echo _cfg("web_name_two"); ?></a></div>
				</li>
				<?php  endforeach; $ln++; unset($ln); ?>
			</ul>
		</div>
	</div>
	<div class="goods_right">
		<div class="news">
			<h3><?php echo _cfg("web_name_two"); ?>动态</h3>
			<div class="box">
			<ul>
				<?php $ln=1;if(is_array($tiezi)) foreach($tiezi AS $tz): ?>				
				<li><a href="<?php echo WEB_PATH; ?>/group/nei/<?php echo $tz['id']; ?>" target="_blank"><?php echo $tz['title']; ?></a></li>								
				<?php  endforeach; $ln++; unset($ln); ?>
			</ul>
		</div></div>
		
		<div class="wait_lottery" id="divLottery">
		<a href="<?php echo G_WEB_PATH; ?>/?/group" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/banner/bbs.jpg" width="230" height="200"></a>
		</div>
	
		<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
		<div class="share">
			<h3>TA们正在<?php echo _cfg("web_name_two"); ?></h3>
			<div class="box">
			<div class="buyList">		
                <ul id="buyList" style="margin-top: 0px;">
					<?php $ln=1;if(is_array($go_record)) foreach($go_record AS $gorecord): ?>
					<li>
						<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>" class="pic" target="_blank">
                        <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo shopimg($gorecord['shopid']); ?>"></a>
						<span class="who"><p style="display: inline;"><a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>"><?php echo get_user_name($gorecord); ?></a></p>刚刚<?php echo _cfg("web_name_two"); ?>了</span>
						<span><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>" class="name" target="_blank"><?php echo $gorecord['shopname']; ?></a></span>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
		</div>
		</div>
	</div>
</div>
<!--product 结束-->
<div class="clear"></div>
<!--商品 开始-->
<div class="get_ready">
	<h3><span>即将揭晓</span><a rel="nofollow" href="<?php echo WEB_PATH; ?>/goods_list">更多&gt;&gt;</a></h3>
	<ul id="readyLotteryItems" class="hot-list">
		<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
		<li class="list-block">
			<div class="pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>" alt="<?php echo $shop['title']; ?>"></a></div>
			<p class="name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></p>
			<p class="money">价值：<span class="rmb"><?php echo $shop['money']; ?></span></p>
			<div class="Progress-bar" style="">
				<p title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>"><span style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],221); ?>px;"></span></p>
				<ul class="Pro-bar-li">
					<li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
					<li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
					<li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
				</ul>
			</div>
			<div class="shop_buttom">
			<span class="lf"><?php echo _cfg("web_name_two"); ?>价<em><?php echo $shop['yunjiage']; ?></em> </span><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="shop_but rt" title="立即<?php echo _cfg("web_name_two"); ?>">立即<?php echo _cfg("web_name_two"); ?></a>
			</div>
		</li>
		<?php  endforeach; $ln++; unset($ln); ?>			
	</ul>
</div>

<!--商品 结束-->
<!--晒单分享-->
<div class="lottery_show">
    <div class="share_show">
        <h3><span>晒单分享</span><a href="#" target="_blank">更多&gt;&gt;</a></h3>
        <div class="show">
			<?php $ln=1;if(is_array($shaidan)) foreach($shaidan AS $sd): ?>
			<dl>
				<dt><a rel="nofollow" href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><img alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
				<dd class="bg">
					<ul>
						<li class="name"><span><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></span> 获得者：<a rel="nofollow" class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank"><?php echo get_user_name($sd['sd_userid']); ?></a></li>
						<li class="content"><?php echo _strcut($sd['sd_content'],100); ?></li>
					</ul>
				</dd>
			</dl>
			<?php  endforeach; $ln++; unset($ln); ?>	
			<div class="show_list">	
				<?php $ln=1;if(is_array($shaidan_two)) foreach($shaidan_two AS $sd): ?>
				<ul>
					<li class="pic"><a rel="nofollow" href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>"><img alt="" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></li>
					<li class="show_tit"><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo $sd['sd_title']; ?></a></li>
					<li>获得者：<a rel="nofollow" class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank"><?php echo get_user_name($sd['sd_userid']); ?></a></li>
					<li>揭晓时间：<?php echo date("Y-m-d",$sd['sd_time']); ?></li>
				</ul>	
				<?php  endforeach; $ln++; unset($ln); ?>			
				<div class="arrow_left"></div>
				<div class="arrow_right"></div>
			</div>               
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
	    var _BuyList=$("#buyList");
        var Trundle = function () {
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-85px');
            _BuyList.animate({ 'marginTop': '0px' }, 800);
        }
        var setTrundle = setInterval(Trundle, 3000);
        _BuyList.hover(function () {
            clearInterval(setTrundle);
            setTrundle = null;
        },function () {
            setTrundle = setInterval(Trundle, 3000);
        });
    });
    </script>
<!--晒单分享end-->
<?php include templates("index","footer");?>