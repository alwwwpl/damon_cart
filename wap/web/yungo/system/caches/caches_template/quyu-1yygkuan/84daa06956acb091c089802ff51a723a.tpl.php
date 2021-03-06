<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <title>邀请管理 - <?php echo $webname; ?>触屏版</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
	<link rel="stylesheet" href="<?php echo G_TEMPLATES_CSS; ?>/mobile/top.css">
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css?v=130715" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/member.css?v=130726" rel="stylesheet" type="text/css" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/invite.css?v=130726" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.js"></script>
    <script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="h5-1yyg-v11">
    
<!-- 栏目页面顶部 -->


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
<div class="n-h-tit"><h1 class="header-logo">邀请管理</h1></div>
</div>
</header>

    <section class="clearfix g-member">
        <div class="clearfix m-round m-name">
            <div class="fl f-Himg">
                <a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $member['uid']; ?>" class="z-Himg">
                    <img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($member['uid'],'img'); ?>" border=0/></a>
                <span class="z-class-icon01 gray02"><s></s><?php echo $member['yungoudj']; ?></span>
            </div>
            <div class="m-name-info"><p class="u-name">
                <b class="z-name gray01"><?php echo get_user_name($member['uid']); ?></b><em>(<?php echo $member['mobile']; ?>)</em></p>
                <ul class="clearfix u-mbr-info"><li>可用云积分 <span class="orange"><?php echo $member['score']; ?></span></li>
                    <li>经验值 <span class="orange"><?php echo $member['jingyan']; ?></span></li>
                    <li>余额 <span class="orange">￥<?php echo $member['money']; ?></span>
                        <a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="fr z-Recharge-btn">去充值</a></li>
                </ul>
            </div>
        </div>
        <div class="R-content">
            <div class="member-t"><h2>邀请好友</h2></div>

            <div id="divInvited" class="success-invitation gray02"  >
                <p>复制链接邀请好友拿四重大礼！</p>
                <span><input id="txtInfo"  style="width:80%;height:20px; " disabled="disabled" value="1元就能买IPhone 4S哦，快去看看吧！ <?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>" onpaste="return false" type="text"><span id="d_clip_container"></span>

				 <div class="bdsharebuttonbox"><a title="分享到QQ空间" href="http://v.t.qq.com/share/share.php?url=<?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>&title=1元就能买IPhone 4S哦，快去看看吧！ <?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>" class="bds_qzone">QQ空间</a><a title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>&title=1元就能买IPhone 4S哦，快去看看吧！ <?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>"  class="bds_tsina">新浪微博</a><a title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>&title=1元就能买IPhone 4S哦，快去看看吧！ <?php echo WEB_PATH; ?>/register/<?php echo $uid; ?>" class="bds_tqq">腾讯微博</a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

            </div>


            <div id="divInviteInfo" class="get-tips gray01" style="">成功邀请 <span class="orange"><?php echo $involvedtotal; ?></span> 位会员注册，已有 <span class="orange"><?php echo $involvednum; ?></span> 位会员参与闪购</div>
            <div id="divList" class="list-tab SuccessCon"><ul class="listTitle"><li class="w200">用户名</li><li class="w200">时间</li><li class="w200">邀请编号</li><li class="w200">消费状态</li></ul>
                <?php if($involvedtotal!=0): ?>
                <?php $ln=1; if(is_array($invifriends)) foreach($invifriends AS $key => $val): ?>
                <ul><li class="w200">  <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($val['uid']); ?>" target="_blank" class="blue"><?php echo $val['sqlname']; ?></a></li>
                    <li class="w200"><?php echo date('Y.m.d H:i:s',$val['time']); ?></li>
                    <li class="w200"><?php echo idjia($val['uid']); ?></li>
                    <li class="w200"><?php echo $records[$val['uid']]; ?></li>
                </ul>
                <?php  endforeach; $ln++; unset($ln); ?>
                <?php  else: ?>
                <div class="tips-con"><i></i>您还未有邀请谁哦</div>
            </div>
            <?php endif; ?>
        </div>
        <div id="divPageNav" class="page_nav"></div>
</div>
    </section>
    
<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_TEMPLATES_STYLE; ?>";Path.Webpath = "<?php echo WEB_PATH; ?>";
  
var Base={head:document.getElementsByTagName("head")[0]||document.documentElement,Myload:function(B,A){this.done=false;B.onload=B.onreadystatechange=function(){if(!this.done&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){this.done=true;A();B.onload=B.onreadystatechange=null;if(this.head&&B.parentNode){this.head.removeChild(B)}}}},getScript:function(A,C){var B=function(){};if(C!=undefined){B=C}var D=document.createElement("script");D.setAttribute("language","javascript");D.setAttribute("type","text/javascript");D.setAttribute("src",A);this.head.appendChild(D);this.Myload(D,B)},getStyle:function(A,B){var B=function(){};if(callBack!=undefined){B=callBack}var C=document.createElement("link");C.setAttribute("type","text/css");C.setAttribute("rel","stylesheet");C.setAttribute("href",A);this.head.appendChild(C);this.Myload(C,B)}}
function GetVerNum(){var D=new Date();return D.getFullYear().toString().substring(2,4)+'.'+(D.getMonth()+1)+'.'+D.getDate()+'.'+D.getHours()+'.'+(D.getMinutes()<10?'0':D.getMinutes().toString().substring(0,1))}
Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js');
</script>
<script>
    var clip = null;
    function copy(id){ return document.getElementById(id); }
    function initx(){
        clip = new ZeroClipboard.Client();
        clip.setHandCursor(true);
        ZeroClipboard.setMoviePath("<?php echo G_TEMPLATES_STYLE; ?>/js/ZeroClipboard.swf");
        clip.addEventListener('mouseOver',function (client){
            clip.setText(copy('txtInfo').value );
        });
        clip.addEventListener('complete',function(client,text){
            alert("邀请复制成功");
        });
        clip.glue('d_clip_button','d_clip_container');
    }
    $(function(){
        initx();
    })

</script>
</div>
</body>
</html>
