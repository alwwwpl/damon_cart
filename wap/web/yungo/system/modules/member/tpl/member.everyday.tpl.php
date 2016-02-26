<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
</head>
<body>
<div class="header lr10">
    <?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
    <form name="myform" action="#" method="post">
        <table width="100%" cellspacing="0">
            <tr>
                <td width="100" align="left">添加福利</td>
                <td>操作员：<input type="text" name="operation" class="input-text" value="admin" id="welfare_operation"></td>
                <td>金额：<input type="text" name="money" class="input-text" value="1" id="welfare_money"></td>
                <td>福分：<input type="text" name="fufeng" class="input-text" value="0" id="welfare_fufeng"></td>
                <td>经验：<input type="text" name="jingyan" class="input-text" value="0" id="welfare_jingyan"></td>
                <td>会员：
                    <select name="groupid" id="welfare_groupid">
                        <option value="1">欢乐小将</option>
                        <option value="2">欢乐少将</option>
                        <option value="3">欢乐中将</option>
                        <option value="4">欢乐上将</option>
                        <option value="5">欢乐大将</option>
                        <option value="6">欢乐将军</option>
                    </select>
                </td>
                <td>
                    <input type="submit" class="button" name="submit" value="确认添加" >
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="lr10" style="line-height:30px;color:#f60">
    <b>福利列表： 共找到 <?php echo $total; ?> 个记录。
</div>
<div class="table-list lr10">
    <!--start-->
    <table width="100%" cellspacing="0">
        <thead>
        <tr>
            <th align="center">ID</th>
            <th align="center">操作员</th>
            <th align="center">金额</th>
            <th align="center">福分</th>
            <th align="center">经验值</th>
            <th align="center">会员权限组</th>
            <th align="center">操作时间</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($welfares as $v){ ?>
            <tr>
                <td align="center"><?php echo $v['welfare_id']; ?></td>
                <td align="center"><?php echo $v['operation']; ?></td>
                <td align="center"><?php echo $v['money']; ?></td>
                <td align="center"><?php echo $v['fufeng']; ?></td>
                <td align="center"><?php echo $v['jingyan']; ?></td>
                <td align="center"><?php echo $v['name']; ?></td>
                <td align="center"><?php echo _put_time(strtotime($v['create_time'])); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div><!--table-list end-->

<div id="pages" style="margin:10px 10px">
    <ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul>
</div>
<script>
</script>
</body>
</html>