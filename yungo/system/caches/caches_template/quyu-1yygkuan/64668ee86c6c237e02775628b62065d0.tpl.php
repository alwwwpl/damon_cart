<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>收货地址 - <?php echo $webname; ?>触屏版</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=20150129" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/login.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/area.js"></script>
</head>
<body>
<!-- 内页顶部 -->
<header class="header">
<div class="n-header-wrap">
<div class="backbtn">
<a href="javascript:;" onclick="history.go(-1)" class="h-count white">
</a>
</div>
<div class="h-top-right ">
<a href="<?php echo WEB_PATH; ?>/mobile/home" class="h-search white"></a>
</div>
<div class="n-h-tit"><h1 class="header-logo">收货地址</h1></div>
</div>
</header>


<table style="width: 100%">
	<tr><ul>
		<td>收货人</td>
		<td>电话</td>
		<td>地址</td>
		<td>操作</td>
		<td>设置</td></ul>
	</tr><?php $ln=1;if(is_array($member_dizhi)) foreach($member_dizhi AS $v): ?>
		<tr><ul>
		<td><?php echo $v['shouhuoren']; ?></td>
		<td><?php echo $v['mobile']; ?></td>
		<td><?php echo $v['sheng']; ?>,<?php echo $v['shi']; ?>,<?php echo $v['xian']; ?>,<?php echo $v['jiedao']; ?></td>
		<td><a class="blue" href="<?php echo WEB_PATH; ?>/member/home/morenaddress/<?php echo $v['id']; ?>">设为默认</a></td>
		<td><a onclick="dell(<?php echo $v['id']; ?>)"  href="javascript:;" >删除</a>
</td><?php if($v['default']=='Y'): ?><?php  else: ?>
		
			<?php endif; ?>			
		</ul>
		<?php  endforeach; $ln++; unset($ln); ?>

	</tr>

</table>

<style>
.registerCon select{
background: #FFF none repeat scroll 0% 0%;
border: 5px solid #DDD;
color: #CCC;
border-radius: 5px;
padding: 0px 5px;
display: inline-block;
position: relative;
font-size: 16px;
height: 50px;
width: 101%;
}
.registerCon .loading{
	padding-top: 20px;
	color: #999;
}
.registerCon .form{
	display:none;
}
</style>
<script type="text/javascript">
$(function(){		
	var demo=$(".registerform").Validform({
		tiptype:2,
		datatype:{
			"tel":/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/,
		},
	});	
	demo.tipmsg.w["tel"]="请正确输入电话号码(区号、号码必填，用“-”隔开)";
	demo.addRule([
	{
		ele:"#txt_ship_tel",
		datatype:"tel",
	}]);
});
$(function(){
	$("#btnAddnewAddr").click(function(){
		$("#div_consignee").show();
		$("#btnAddnewAddr").hide();
	});
	$("#btn_consignee_cancle").click(function(){
		$("#div_consignee").hide();
		$("#btnAddnewAddr").show();
	});
});
$(function(){
	$(".xiugai").click(function(){
		$("#btnAddnewAddr").hide();
		$("#div_consignee").hide();
	});
	$("#btn_consignee_cancle2").click(function(){
		$("#div_consignee2").hide();
		$("#btnAddnewAddr").show();
	});
});
function update(id){	
	$("#div_consignee2").show;
	setup3();
	$("#registerform3").attr("action","<?php echo WEB_PATH; ?>/mobile/home/updateddress/"+id);
	var str=$("#dizh_"+id).html();
	var spl=str.split(",");
	$("#province3").append('<option selected value="'+spl[0]+'">'+spl[0]+'</option>');
	$("#city3").append('<option selected value="'+spl[1]+'">'+spl[1]+'</option>');
	$("#county3").append('<option selected value="'+spl[1]+'">'+spl[1]+'</option>');
	$("#dizh2").val(spl[3]);
	$("#mob2").val($("#mob_"+id).html());
	$("#yb2").val($("#yb_"+id).html());
	$("#shr2").val($("#shr_"+id).html());
	$("#div_consignee2").show();	
};
function dell(id){
	if (confirm("您确认要删除该条信息吗？")){
		window.location.href="<?php echo WEB_PATH; ?>/member/home/deladdress/"+id;
	}
}
</script>

 <section>
		<form class="registerform" method="post" action="<?php echo WEB_PATH; ?>/mobile/home/useraddress">
	        <div class="registerCon">
    	        <ul style="display: block;" class="form">
        	        <li>
						<tr>
			<script>var s=["province","city","county"];</script>
			<td><label>所在地区：</label></td></br>
			<td>
				<select datatype="" nullmsg="请选择有效的省市区" class="select" id="province" runat="server" name="sheng"></select>
				<select datatype="" nullmsg="请选择有效的省市区" id="city" runat="server" name="shi"></select>
				<select datatype="" nullmsg="请选择有效的省市区" id="county" runat="server" name="xian"></select>
				<em id="ship_address_valid_msg" class="red"></em> 	
				<script type="text/javascript">setup()</script>
			</td>
			<td><div class="Validform_checktip"></div></td>
		</tr>
                    </li>
        	        <li>
						<select style="display: none;" name="shi"></select>
                    </li>
        	        <li>
						<select style="display: none;" name="qu"></select>
                    </li>
        	        <li>
						<select style="display: none;" name="jie"></select>
                    </li>
        	        <li>
						<input name="jiedao" placeholder="请输入详细地址" value="" type="text">
                    </li>
        	        <li>
						<input name="shouhuoren" placeholder="请输入收货人姓名" value="" type="text">
                    </li>
        	        <li>
						<input name="mobile" placeholder="请输入收货人手机号" value="" type="text">
                    </li>
                    <li>
						<input style="margin-right:20px;" name="submit" class="orangebut" id="btn_consignee_save" value="保存" title="保存提交" type="submit"> 
						
					</li>
                </ul>
	 	</form>
        </section>
        





        
        
        
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";
  Path.Webpath = "<?php echo WEB_PATH; ?>";

var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v='+GetVerNum());
</script>

    </div>
    
    
    
    
</body>
</html>
