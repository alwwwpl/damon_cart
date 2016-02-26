<?php echo $header; ?>
<style>
    .table thead tr {
        background-color: #F9F9F9;
        color: #555;
        height: 30px;
    }

    .table thead tr th, .table tr td {
        line-height: 30px !important;
    }
    .btn-edit {
        width: 30px;
        height: 30px;
        margin: 5px 10px;
        color: #FD4F4E;
    }
    .btn-del {
        width: 30px;
        height: 30px;
        margin: 5px 10px;
        color: #FD4F4E;
    }
    .distribute_price input {
        width: 100px;
    }
</style>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <div class="row"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <h1><?php echo $heading_title; ?></h1>
            <p><?php echo $text_description; ?></p>
            <p><?php echo $text_share_url; ?></p>
            <p><a id="share_url" href="<?php echo $share_url; ?>"><?php echo $share_url; ?></a></p>
            <p>
                <div class="bdsharebuttonbox">
                    <a href="#" class="bds_more" data-cmd="more"></a>
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                </div>
                <script>
                    window._bd_share_config ={"common":{"bdSnsKey":{},"bdUrl":"<?php echo str_replace('&amp;', '&', $share_url); ?>","bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};
                    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                </script>
            </p>
            <p><span id="qrcode"></span></p>
            <br><br>
            <form action="<?php echo $update_store_action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <h2>店铺信息设置</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>店铺LOGO</th>
                        <th>店名名称</th>
                        <th>修改LOGO</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <?php if($store_logo){ ?>
                            <img src="<?php echo $store_logo ?>" style="border-radius: 3px" height="80" alt="">
                            <?php } ?>
                        </td>
                        <td>
                            <input type="text" name="store_name" placeholder="<?php echo $entry_store_name; ?>" id="input-price" value="<?php echo $store_name ?>" />
                        </td>
                        <td>
                            <input type="file" name="store_logo" id="input-price" value="<?php echo $store_logo ?>"/>
                        </td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="<?php echo $button_submit; ?>"/>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </form>
            <br><br>

            <h2>分销产品列表</h2>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>分销价格</th>
                    <th style="text-align: center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($product_distributes) && !empty($product_distributes))
                {
                    foreach($product_distributes as $product_distribute){
                ?>
                <tr>
                    <td>
                        <a href="<?php echo $product_distribute['link'] ?>" target="_blank"><?php echo $product_distribute['name'] ?></a>
                    </td>
                    <td><?php echo $product_distribute['price'] ?></td>
                    <td class="distribute_price" data-price="<?php echo $product_distribute['distribute_price'] ?>"><?php echo $product_distribute['distribute_price'] ?></td>
                    <td style="text-align: center;">
                        <!-- <a href="<?php //echo $product_distribute['update']; ?>" class="btn"><?php echo $button_edit; ?></a> -->
                        <a href="javascript:void(0);" class="btn-edit" data-class="btn-edit" data-id="<?php echo $product_distribute['product_distribute_id'];?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a href="<?php echo $product_distribute['delete']; ?>" class="btn-del" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </td>
                </tr>
                <?php
                    }
                }
                else
                {
                    echo '<tr><td colspan="4">未找到分销的商品！</td></tr>';
                }
                ?>
                </tbody>
            </table>

            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<script type="text/javascript" src="catalog/view/javascript/jquery/qrcode/jquery.qrcode.min.js"></script>
<script type="text/javascript">
    $('input[name=\'product\']').autocomplete({
        'source': function (request, response) {
            $.ajax({
                url: 'index.php?route=account/product_distribute/autocomplete&filter_name=' + encodeURIComponent(request),
                dataType: 'json',
                success: function (json) {
                    response($.map(json, function (item) {
                        return {
                            label: item['name'],
                            value: item['id'],
                            price: item['price']
                        }
                    }));
                }
            });
        },
        'select': function (item) {
            $('input[name=\'product\']').val(item['label']);
            $('input[name=\'product_id\']').val(item['value']);
            $('#old_price').show();
            $('#old_price>span').text(item['price']);
        }
    });

    $('#qrcode').qrcode({
        size: 200,
        text: $('#share_url').attr('href')
    });


    $('.btn-edit').on('click',function(){
        var dataclass = $(this).attr('data-class');
        var product_distribute_id = $(this).attr('data-id');
        if (dataclass == 'btn-edit'){
            var price = $(this).parent().parent().find('.distribute_price').attr('data-price');
            $(this).parent().parent().find('.distribute_price').html('<input type="number" name="distribute_price" class="dis_price" value="'+price+'">');

            $(this).attr('data-class','btn-ok');
            $(this).html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');

        }
        else if (dataclass == 'btn-ok'){
            var dis_price = $(this).parent().parent().find('.dis_price').val();
            var dis_slfe = $(this);

            $.post('index.php?route=account/product_distribute/edit',{price:dis_price,product_id:product_distribute_id},function(data){
                if (data == 'success'){
                    dis_slfe.parent().parent().find('.distribute_price').html(dis_price);

                    dis_slfe.attr('data-class','btn-edit');
                    dis_slfe.html('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>');
                }else{
                    alert(data);
                }
            });
            $(this).parent().parent().find('.distribute_price').html(dis_price);

            $(this).attr('data-class','btn-edit');
            $(this).html('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>');


        }
    });



</script>
<?php echo $footer; ?>