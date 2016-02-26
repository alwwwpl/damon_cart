<?php
$this->title = "管理首页";
?>

<div class="container-fluid">
    <div id="main-stats">
        <div class="row-fluid stats-row">
            <div class="span4 stat">
                <div class="data">
                    帐户总额：<span class="number">￥<?php echo $total;?></span>
                </div>
                <span class="date"></span>
            </div>
            <div class="span4 stat">
                <div class="data">
                    帐户余额：<span class="number">￥<?php echo $amount ? $amount : 0.00;?></span>
                </div>
                <span class="date"></span>
            </div>
            <div class="span4 stat">
                <div class="data">
                    可用余额：<span class="number">￥<?php echo $cash ? $cash : 0.00;?></span>
                </div>
                <span class="date"></span>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="row" style="margin-left:0px;">
        <div class="col-md-12">
            <div class="header">
                <h3>资金记录</h3>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="col-md-1">
                        ID
                    </th>
                    <th class="col-md-2">
                        <span class="line"></span>订单ID
                    </th>
                    <th class="col-md-3">
                        <span class="line"></span>描述
                    </th>
                    <th class="col-md-2">
                        <span class="line"></span>帐户余额
                    </th>
                    <th class="col-md-2">
                        <span class="line"></span>可用余额
                    </th>
                    <th class="col-md-2">
                        <span class="line"></span>时间
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($record))
                {
                    $i = 0;
                    foreach($record as $val)
                    {
                        $first = '';
                        if ($i == 0){$first = 'class="first"';}else{$first = '';}
                        ?>
                        <tr <?php echo $first;?> >
                            <td><?php echo $val->extensioner_transaction_id;?></td>
                            <td><?php echo $val->order_id;?></td>
                            <td><?php echo $val->description;?></td>
                            <td><?php echo $val->amount;?></td>
                            <td><?php echo $val->cash;?></td>
                            <td class="align-right"><?php echo $val->date_added;?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
