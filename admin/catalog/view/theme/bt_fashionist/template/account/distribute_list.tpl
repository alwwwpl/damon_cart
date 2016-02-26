<?php echo $header; ?>
<style>
    .form-horizontal label{
        font-size: 14px !important;
        line-height: 30px;
        font-weight: 400;
        color: #000;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857;
        color: #555;
        background-color: #FFF;
        background-image: none;
        border: 1px solid #CCC;
        border-radius: 4px;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    }
    .form-group {
        margin-bottom: 5px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="bt-breadcrumb">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <h1 style="margin-top:0"><?php echo $heading_title; ?></h1>
            <div class="content_bg">
                <?php if ($orders) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="text-align: center;">
                        <thead>
                        <tr>
                            <td class="text-center"><?php echo $column_order_id; ?></td>
                            <td class="text-center"><?php echo $column_customer; ?></td>
                            <td class="text-center"><?php echo $column_product; ?></td>
                            <td class="text-center"><?php echo $column_status; ?></td>
                            <td class="text-center"><?php echo $column_total; ?></td>
                            <td class="text-center"><?php echo $column_date_added; ?></td>
                            <td class="text-center">物流信息</td>
                            <td>操作</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td class="text-center">#<?php echo $order['order_id']; ?></td>
                            <td class="text-center"><?php echo $order['name']; ?></td>
                            <td class="text-center"><?php echo $order['products']; ?></td>
                            <td class="text-center">
                                <?php
                                if($order['status_id'] == 2 && $order['distribute_status'] == '待付款'){
                                    echo '<button type="button" class="btn-primary distribute-go" data-toggle="modal" data-target="#myModal" data-id="'.$order['order_id'].'">未采购</button>';
                                } elseif($order['status'] == 1){
                                    echo '<a style="background:#EFEFEF; padding:5px 10px; border-radius:4px; color:#000;">待付款</a>';
                                }else {
                                    echo $order['status'];
                                } ?>
                            </td>
                            <td class="text-center"><?php echo $order['total']; ?></td>
                            <td class="text-center"><?php echo $order['date_added']; ?></td>
                            <td class="text-center"><?php echo $order['express'] ? $order['express'] : '-'; ?></td>
                            <td class="text-left">
                                <a href="<?php echo $order['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if ($order['status'] == '处理中'){
                                ?>
                                <a href="javascription:void(0);" title="发货" class="btn-info deliver" data-id="<?php echo $order['order_id'];?>" style="margin-left:10px;" data-toggle="modal" data-target="#myModal-express">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                </a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right"><?php echo $pagination; ?></div>
                <?php } else { ?>
                <p><?php echo $text_empty; ?></p>
                <?php } ?>
                <div class="buttons clearfix">
                    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
                </div>
            </div>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-id="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div style="font-size: 20px; padding: 10px; color: #000;">收货地址</div>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="radio_address">
                        <label for="exampleInputEmail1" style="margin-left:20px;"><strong>请选择收货地址：</strong></label>
                        <?php
                        foreach($addresses as $value){
                        ?>
                        <div class="radio" style="margin-left: 80px;">
                            <label>
                                <input type="radio" name="optionsRadios" id="add<?php echo $value['address_id'];?>" value="<?php echo $value['address_id'];?>">
                                <?php echo $value['lastname'].' '.$value['phone'].' '.$value['zone'].' '.$value['city'].' '.$value['address_1'].' '.$value['postcode'];?>
                            </label>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        添加新地址
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="well" style="background: #FCFCFC;">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">姓名:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="lastname" placeholder="UserName">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">联系电话:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">公司名称:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="company" placeholder="Company Name">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">所在省份:</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="zone_id" id="zone_id" data-name="">
                                            <option value="">选择省份</option>
                                        <?php foreach($zones as $val){
                                            echo '<option value="'.$val['zone_id'].'" data-name="'.$val['name'].'">'.$val['name'].'</option>';
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">所在城市:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="city" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">详细地址:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="address" placeholder="">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">邮编:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="postcode" placeholder="">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-default submit">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary confirm">确认采购</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal-express" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-id="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">物流信息</h2>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">物流公司：</label>
                            <div class="col-sm-6" style="padding: 0px;">
                                <select class="form-control" id="express_name">
                                    <option value="顺丰速运">顺丰速运</option>
                                    <option value="申通快递">申通快递</option>
                                    <option value="圆通快递">圆通快递</option>
                                    <option value="汇通快递">汇通快递</option>
                                    <option value="中通快递">中通快递</option>
                                    <option value="韵达快递">韵达快递</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">物流编号：</label>
                            <div class="col-sm-6" style="padding: 0px;">
                                <input type="text" class="form-control" id="express" placeholder="物流编号" name="express">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="deliver-submit">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.deliver').on('click',function(){
        var order_id = $(this).attr('data-id');
        $('#myModal-express').attr('data-id',order_id);
    });

    $('#deliver-submit').on('click',function(){
        var order_id = $('#myModal-express').attr('data-id');
        var express = $('#express_name').val()+' '+$('#express').val();
        if ($('#express').val())
        {
            $.post('./index.php?route=account/order/deliver',{order_id:order_id,express:express},function(data){
                if (data == 'success') {
                    alert('发货成功！');
                    $('#myModal-express').modal('toggle');
                    history.go(0)
                }
                else {
                    alert('操作失败!');
                }
            });
        }
        else {
            alert('请输入物流信息!');
        }

    });

    /*$('.distribute').on('click',function(){
        var order_id = $(this).attr('data-order');
        $.post('./index.php?route=account/order/purchase',{order_id:order_id},function(obj){
            if (obj == 'success')
            {
                alert('采购成功！');
                history.go(0);
            }else if (obj == 'balance')
            {
                alert('您的可用余额不足!');
            }
            else {
                alert(obj);
            }
        });
    });*/

    $('.distribute-go').on('click',function(){
        var distribute_id = $(this).attr('data-id');
        $('#myModal').attr('data-id',distribute_id);
    });

    $('.confirm').on('click',function(){
        var radio = $('.radio input[name="optionsRadios"]:checked ').val();
        var order_id = $('#myModal').attr('data-id');
        if (radio && order_id) {
            $.post('./index.php?route=account/order/purchase',{order_id:order_id,address_id:radio},function(obj){
                if (obj == 'success')
                {
                    alert('采购成功！');
                    history.go(0);
                }else if (obj == 'balance')
                {
                    alert('您的可用余额不足!');
                }
                else {
                    alert(obj);
                }
            });
        }
    });

    $('#zone_id').on('change',function(){
        var name = $(this).find('option:selected').attr('data-name');
        $(this).attr('data-name',name);
    });

    $('.submit').on('click',function(){
        var username = $('#lastname').val();
        var phone = $('#phone').val();
        var company = $('#company').val();
        var zone_id = $('#zone_id').val();
        var zone = $('#zone_id').attr('data-name');
        var city = $('#city').val();
        var address = $('#address').val();
        var postcode = $('#postcode').val();
        if (username == '' || phone == '' || company == '' || zone == '' || zone_id == '' || city == '' || address == ''){
            alert('请输入完整的收货信息！');
        }
        else{
            $.post('./index.php?route=account/order/addaddress',{lastname:username,phone:phone,address_1:address,company:company,zone_id:zone_id,country_id:44,city:city,postcode:postcode,address_2:0,firstname:0,default:0},function(data){
                if(data.status == 'success'){
                    $('#collapseExample').removeClass('in');
                    var html = '<div class="radio" style="margin-left: 80px;">'+
                               '<label>'+
                               '<input type="radio" name="optionsRadios" id="add'+data.address_id+'" value="'+data.address_id+'">'+
                               username+' '+phone+' '+zone+' '+city+' '+address+' '+postcode+
                               '</label>'+
                               '</div>';
                    $(html).appendTo('#radio_address');
                    $('.well input').val('');
                    $('.well select').val('');
                }
                else if(data.status == 'login')
                {
                    alert('请先登陆后再操作!');
                    window.location.href = './index.php?route=account/login';
                }
                else {
                    alert('操作失败！');
                }
            },'json');
        }
    });
</script>
<?php echo $footer; ?>