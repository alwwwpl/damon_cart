<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '编辑收货人';
echo $this->render('@app/views/layouts/_account_header');
?>
<style>
    select {
        height: 80px;
        border: 0px !important;
        margin-left: 3%;
        float: left;
        width: 150px;
        font-size: 26px;
        overflow: hidden;
        border-radius: 8px;
        background: #FFF;
    }
    select option {
        border: 0px;
        width: 150px;
        height: 40px;
        line-height: 40px;
    }
    .layui-layer-msg .layui-layer-content {
        font-size: 20px;
        line-height: 42px;
    }
</style>
    <div class="w-main">
        <div class="eidt-receiving">
            <?php
            $form = ActiveForm::begin([
                'method'=>'post',
                'id' => 'address-edit',
                'fieldConfig' => [
                    'template' => "{input}",
                ],
            ]);
            ?>
                <?= $form->field($model, 'province')->hiddenInput(['value' => $model->province]) ?>
                <?= $form->field($model, 'city')->hiddenInput(['value' => $model->city]) ?>
                <?= $form->field($model, 'customer_id')->hiddenInput(['value' => $model->customer_id]) ?>
                <?= $form->field($model, 'firstname')->hiddenInput(['value' => $model->firstname]) ?>
                <?= $form->field($model, 'company')->hiddenInput(['value' => $model->company ? $model->company : 0]) ?>
                <?= $form->field($model, 'address_2')->hiddenInput(['value' => $model->address_2 ? $model->address_2 : 0]) ?>
                <?= $form->field($model, 'postcode')->hiddenInput(['value' => $model->postcode ? $model->postcode : 0]) ?>
                <?= $form->field($model, 'custom_field')->hiddenInput(['value' => 'a:0:{}']) ?>
                <div class="item item-recename clearfix">
                    <span>收货人：</span><input type="text" value="<?= $model->lastname;?>" id="address-lastname" name="Address[lastname]" class="txt-input txt-phone"  maxlength="11" >
                </div>
                <div class="item item-phone clearfix">
                    <span>手机号：</span><input type="tel" id="address-phone" name="Address[phone]" value="<?= $model->phone;?>" class="txt-input txt-phone" placeholder="收货人手机号" maxlength="11" >
                </div>
                <div class="item area clearfix">
                    <span>所在区域:</span>
                    <div class="select">
                        <select name="Address[province_id]" id="address-province_id">
                            <?php
                            if (!empty($provinces))
                            {
                                foreach ($provinces as $province)
                                {
                                    $selected = '';
                                    if ($model->province_id == $province['area_id'])
                                    {
                                        $selected = ' selected="selected"';
                                    }
                                    echo "<option value='".$province['area_id']."' data-province='".$province['area_name']."' ".$selected.">".$province['area_name']."</option>";
                                }
                            }
                            else
                            {
                                echo "<option value='0' data-province='0'>省份</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="select">
                        <select name="Address[city_id]" id="address-city_id">

                            <?php
                            if (!empty($citys))
                            {
                                foreach ($citys as $city)
                                {
                                    $selected = '';
                                    if ($model->city_id == $city['area_id'])
                                    {
                                        $selected = ' selected="selected"';
                                    }
                                    echo "<option value='".$city['area_id']."' data-city='".$city['area_name']."' ".$selected.">".$city['area_name']."</option>";
                                }
                            }
                            else
                            {
                                echo "<option value='0' data-city='0'>城市</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="item item-address clearfix">
                    <span>详细地址：</span><input type="text" id="address-address_1" value="<?= $model->address_1;?>" name="Address[address_1]" class="txt-input txt-address"  maxlength="11" >
                </div>
                <div class="receiving-submit-all">
                    <button type="submit" class="btn btn-receiving">保存</button>
                </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
<script>

    $('#address-city_id').on('change',function(){
        var city = $(this).find('option:selected').attr('data-city');
        $('#address-city').val(city);
    });


    $('#address-province_id').on('change',function(){
        var province = $(this).find('option:selected').attr('data-province');
        $('#address-province').val(province);

        var province_id = $(this).val();

        var html = '<option value="0" data-city="0" selected="selected">城市</option>';
        $.post('/login/getcity',{province_id:province_id},function(data){
            if (data.status == 'success'){
                $.each(data.citys,function(index,item){
                    html += "<option value='"+item.area_id+"' data-city='"+item.area_name+"'>"+item.area_name+"</option>";
                });
            }
            $('#address-city_id').html(html);
        },'json');
    });
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>