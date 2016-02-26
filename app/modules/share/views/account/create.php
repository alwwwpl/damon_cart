<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\file\FileInput;
use kartik\depdrop\DepDrop;

use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = '推广人注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css" media="screen">
    h2{
        border-bottom: 1px solid #000;
    }
    .navbar-inverse {
        display: none !important;
    }
    input { height: 35px !important; line-height: 35px !important;}
    #w1 { display: none;}
    .container { padding-top:10px !important;}

    .footer .pull-left { display: none;}
</style>
<div class="header clearfix">
    <h3 class="text-muted"><img src="http://iddmall.com/image/catalog/logo2.png" title="达蒙狗商城" alt="达蒙狗商城"></h3><br>
</div>
<div class="agent-create panel panel-default">
    <div class="panel-heading" style="text-align: center; font-size: 26px;"><?php echo Html::encode($this->title) ?></div>
    <div class="panel-body">
        <div class="agent-form">

            <?php $form = ActiveForm::begin([
                'id' => 'agent-form',
                'layout' => 'horizontal',
                'options'=>['enctype'=>'multipart/form-data'],
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label'   => 'col-sm-2',
                        'wrapper' => 'col-sm-4'
                    ]
                ]
            ]); ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true])->hint('英文字母、数字、_的组合（此账号做为您登录账号是不可更改的）') ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->hint('密码由6-16个字符组成，请使用英文加字母或符号的组合密码') ?>


            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('请正确填写电子邮箱，将用于找回密码、验证等') ?>

            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->hint('请填写您的真实姓名') ?>

            <?php //echo $form->field($model, 'phone')->textInput(['maxlength' => true])->hint('请填写你的电话号码，多个电话需空格分开') ?>
            <div class="form-group field-agent-phone has-success">
                <label class="control-label col-sm-2" for="agent-phone">手机号码</label>
                <div class="col-sm-4">
                    <div class="col-xs-12 col-sm-12" style="padding-left: 0px;">
                        <input id="agent-phone" class="form-control" style="width: 50%; float: left;" name="Extensioner[phone]" type="text" placeholder="11位手机号码" data-code="">
                    </div>
                    <div class="col-xs-12 col-sm-12" style="margin-top:10px; padding-left: 0px;">
<!--                        <input type="text" class="form-control" placeholder="验证码" id="inputCode" style="width:70px; float: left; text-align: center;">-->
<!--                        <div class="mycode" id="code" style="width:70px; height:34px; overflow: hidden;float:left; margin-left:10px;"></div>-->

                        <input class="form-control" id="phone-code" placeholder="4位验证码" style="width:70px; float: left;" type="text">
                        <input class="btn btn-default" id="getcode" style="margin-left: 5px; padding:6px 0px; width: 80px;" value="获取验证码">
                    </div>

                    <div class="help-block help-block-error "></div>
                </div>
                <div class="help-block col-sm-3" style="position: static;">请填写你的11位手机号码</div>
            </div>

            <div class="form-group required <?= $model->hasErrors('province_id') || $model->hasErrors('city_id') || $model->hasErrors('area_id') ? 'has-error' : '' ?>">
                <label class="control-label col-sm-2">所在区域</label>
                <div class="col-sm-4">
                    <div class="row" style="margin-left:-15px;">
                        <div class="col-sm-4">
                            <?= Html::activeDropDownList($model, 'province_id',
                                ArrayHelper::map(Area::find()->where(['parent_id' => 1])->all(), 'area_id', 'area_name'),
                                [
                                    'class' => 'form-control',
                                    'prompt' => '请选择...',
                                ])
                            ?>
                        </div>

                        <div class="col-sm-4">
                            <?= DepDrop::widget(
                                [
                                    'model' => $model,
                                    'attribute' => 'city_id',
                                    'data' => ArrayHelper::map($model->city_id ? $model->city_id->children(1)->all() : [], 'area_id', 'area_name'),
                                    'pluginOptions' => [
                                        'depends' => ['extensioner-province_id'],
                                        'placeholder' => '请选择...',
                                        'url' => Url::to(['/area/options'])
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>

                    <?= Html::error($model, 'province_id', ['class' => 'help-block help-block-error']) ?>
                    <?= Html::error($model, 'city_id', ['class' => 'help-block help-block-error']) ?>
                </div>
            </div>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->hint('请填写你的详细联系地址') ?>

            <div class="form-group">
                <div class="col-lg-offset-4 col-lg-4">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>
            <br><br>

            <div class="jumbotron" style="display: none;">
                <p style="font-size: 14px;">
                    1. 用 户 名：用于代理商登陆代理管理后台；<br/>
                    2. 密    码：请牢记密码，不要忘记，有问题请联系达蒙商城客服。<br/>
                    3. 所在地区：请选择您的所在地区，以方便定位您行使代理行为的区域。<br/>
                    4. 联系电话：请正确填写您的常用手机号码，该联系电话将直接用于密码找回和验证资质。<br/>
                    5. 电子邮箱：请正确填写您的常用邮箱，该邮箱将用于激活账号和验证账号安全。<br/>
                    6. 联 系 人：请准确填写代理商的真实姓名，用于认证和联系。<br/>
                    7. 身份证号：请正确填写联系人的身份证号，用于认证资质。<br/>
                    8. 身份证照：请上传小于2M的联系人扫描件，用于资质认证。<br/>
                    9. 代理区域：请选择您要代理的区域，省级代理之需选择到省，市级需要选择到市。<br/>
                    10. 企业信息：如实填写，该项省级代理商必须填写，其他选填。<br/>
                </p>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<script>

    $('#agent-form').submit(function(e){
        var code = $('#phone-code').val();
        var code_data = $('#agent-phone').attr('data-code');
        if (code != code_data || code == '')
        {
            alert('验证码输入不正确！');
            e.preventDefault();
        }
    });


    $('#getcode').on('click',function(){

        var phone = $('#agent-phone').val();
        if (isNaN(phone) || phone == '' || phone.length != 11)
        {
            alert('请输入正确的手机号码!');
        }
        else
        {
            var countdown=60;
            function settime() {
                if (countdown == 0) {
                    $('#getcode').removeAttr("disabled");//去除input元素的disabled属性
                    $('#getcode').val('获取验证码');
                    countdown = 60;
                    return;
                } else {
                    $('#getcode').attr("disabled","disabled")//将input元素设置为disabled
                    $('#getcode').val('重新发送(' + countdown + ')');
                    countdown--;
                }
                setTimeout(function(){
                    settime();
                },1000);
            }


            var obj = $('#getcode');
            obj.blur();
            $.post('./sendmessage',{phone:phone},function(data){
                if (data.status == 'success') {
                    $('#phone-code').css('display','block');
                    $('#agent-phone').attr('data-code',data.code);
                    settime();
                }
                else {
                    alert('短信发送失败！');
                }
            },'json');
        }

    });





    /*
    var inp = document.getElementById('inputCode');
    var code = document.getElementById('code');
    var submit = document.getElementById('getcode');

    //======================插件引用主体
    var c = new KinerCode({
        len: 4,//需要产生的验证码长度
//        chars: ["1+2","3+15","6*8","8/4","22-15"],//问题模式:指定产生验证码的词典，若不给或数组长度为0则试用默认字典
        chars: [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ],//经典模式:指定产生验证码的词典，若不给或数组长度为0则试用默认字典
        question: false,//若给定词典为算数题，则此项必须选择true,程序将自动计算出结果进行校验【若选择此项，则可不配置len属性】,若选择经典模式，必须选择false
        copy: false,//是否允许复制产生的验证码
        bgColor: "",//背景颜色[与背景图任选其一设置]
        bgImg: "#",//若选择背景图片，则背景颜色失效
        randomBg: false,//若选true则采用随机背景颜色，此时设置的bgImg和bgColor将失效
        inputArea: inp,//输入验证码的input对象绑定【 HTMLInputElement 】
        codeArea: code,//验证码放置的区域【HTMLDivElement 】
        click2refresh: true,//是否点击验证码刷新验证码
        false2refresh: true,//在填错验证码后是否刷新验证码
        validateObj: submit,//触发验证的对象，若不指定则默认为已绑定的输入框inputArea
        validateEven: "click",//触发验证的方法名，如click，blur等
        validateFn: function (result, code) {//验证回调函数
            var phone = $('#agent-phone').val();
            if (isNaN(phone))
            {
                alert('请输入正确的手机号码!');
            }
            else
            {
                if (result) {
                    $('#inputCode').css('display','none');
                    $('#code').css('display','none');
                    $('#phone-code').css('display','block');

                    var countdown=60;
                    function settime() {
                        if (countdown == 0) {
                            $('#getcode').removeAttr("disabled");//去除input元素的disabled属性
                            $('#getcode').val('获取验证码');
                            countdown = 60;
                            return;
                        } else {
                            $('#getcode').attr("disabled","disabled")//将input元素设置为disabled
                            $('#getcode').val('重新发送(' + countdown + ')');
                            countdown--;
                        }
                        setTimeout(function(){
                            settime();
                        },1000);
                    }


                    var obj = $('#getcode');
                    obj.blur();
                    $.post('./sendmessage',{phone:phone},function(data){
                        if (data.status == 'success') {
                            $('#phone-code').css('display','block');
                            $('#agent-phone').attr('data-code',data.code);
                            settime();
                        }
                        else {
                            alert('短信发送失败！');
                        }
                    },'json');

                }
                else {
                    if (this.opt.question) {
                        alert('验证码输入错误!');
                    } else {
                        alert('验证码输入错误!');
                    }
                }
            }
        }
    });
    */


</script>
