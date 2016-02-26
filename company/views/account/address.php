<?php
$this->title = '地址管理';
echo $this->render('@app/views/layouts/_account_header');
?>

    <div class="w-main">
        <div class="u-addrbox">
            <?php
            if (!empty($addressData))
            {
                foreach ($addressData as $address)
                {
            ?>
            <div class="selected_addr clearfix">
                <a>
                    <div class="addr_box">
                        <p class="na-tel"><span class="addr_name"><?= $address['lastname'];?></span><span class="addr_tel"><?= $address['phone'];?></span></p>
                        <p class="addr_text"><?= $address['province']." ".$address['city']." ".$address['address_1'];?></p>
                    </div>
                </a>
                <div class="addr_list clearfix">
                    <div class="sele_addr">
                        <!--checked-->
                        <span class="sele_list <?= $address_id == $address['address_id'] ? 'checked' : '';?>" data-key="<?= $address['address_id'] ?>"><input type="hidden"></span>默认地址
                    </div>
                    <div class="addr_ope">
                        <a href="/account/address-del"><span class="delete"></span>删除</a>
                        <a href="/account/address-edit?id=<?= $address['address_id'] ?>"><span class="edi"></span>编辑</a>
                    </div>
                </div>

            </div>
            <?php
                }
            }
            ?>
            <div class="addrbox-button">
                <a href="/account/address-add">
                    <button type="button" class="btn btn-add">新增</button>
                </a>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('.sele_list').on('click',function(){
        var key = $(this).attr('data-key');

        if (key)
        {
            $.post('/account/ajax-setdefault-address',{key:key},function(data){
                if (data == 'success')
                {
                    history.go(0);
                }
                else
                {
                    layer.msg('设置失败！');
                }
            });
        }
    });
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>