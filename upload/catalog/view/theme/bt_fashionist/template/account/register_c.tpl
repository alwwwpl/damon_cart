<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>达蒙珠宝-会员注册</title>
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <link href="catalog/view/javascript/bossthemes/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
    <script src="catalog/view/javascript/bossthemes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./catalog/view/javascript/jquery-upload/jquery.form.js"></script>
    <script type="text/javascript" src="./catalog/view/javascript/js.KinerCode.js"></script>
    <style>
        .header {
            padding-bottom: 20px;
        }
        .footer {
            padding-top: 19px;
            color: #777;
            border-top: 1px solid #E5E5E5;
        }
        .col-sm-6 span {
            color: #767676;
            font-size: 12px;
        }
        .demo .btn {
            position: relative;
            overflow: hidden;
            margin-right: 4px;
            display: inline-block;
            *display: inline;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 100;
            line-height: 18px;
            *line-height: 20px;
            color: #555;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-color: #EFEFEF;
        }

        .demo .btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;} .progress {
            position: relative;
            margin-left: 100px;
            margin-top: -24px;
            width: 200px;
            padding: 1px;
            border-radius: 3px;
            display: none
        }

        .demo .bar { background-color: #FD4F4E; displays:none; width:0%; height:20px; border-radius: 3px; }
        .percent {
            position: absolute;
            height: 20px;
            display: inline-block;
            top: 3px;
            left: 2%;
            color: #fff
        }
        .demo .showimg { width: 80px; height: 80px; float: left;}
        .demo .showimg img { width: 80px; height: 80px;}
        .demo .files { height:22px; line-height:22px; margin:10px 0}
        .demo .delimg { margin-left:20px; color:#FD4F4E; cursor:pointer}
    </style>
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted"><a href="./"><img src="http://iddmall.com/image/catalog/logo2.png" title="达蒙狗商城" alt="达蒙狗商城"></a></h3>
    </div>

    <div class="jumbotron" style="background: #FCFCFC; border: 1px solid #F0F0F0;">
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post" id="register_form">
            <input type="hidden" name="agents_id" value="<?php echo $agent_id;?>">
            <input type="hidden" name="extensioner_id" value="<?php echo $extensioner_id;?>">
            <input type="hidden" name="customer_group_id" value="1" />
            <input type="hidden" name="address_1" value="0" id="address_1">
            <input type="hidden" name="zone_id" value="684">
            <input type="hidden" name="country_id" value="44">
            <input type="hidden" name="firstname" value="0">
            <input type="hidden" name="fax" value="0">
            <input type="hidden" name="postcode" value="0">
            <input type="hidden" name="address_2" value="0">
            <input type="hidden" name="company" value="0">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">电子邮箱：</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email;?>">
                    <?php if ($error_email) { ?>
                    <div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <span>请正确填写电子邮箱，将用于登陆、找回密码、验证等（不可更改）。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">会员密码：</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <?php if ($error_password) { ?>
                    <div class="text-danger"><?php echo $error_password; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <span>密码由6-16个字符组成，请使用英文字母加数字或符号的组合密码。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">确认密码：</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" name="confirm" id="passwordconfirm" placeholder="Password Confirm">
                    <?php if ($error_confirm) { ?>
                    <div class="text-danger"><?php echo $error_confirm; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <span>请再输入一遍您上面填写的密码。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">联系人：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="UserName" value="<?php echo $lastname;?>">
                    <?php if ($error_firstname) { ?>
                    <div class="text-danger"><?php echo $error_firstname; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <span>请填写您本人的真实姓名，以确保货品收发安全和账号真实性。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">联系电话：</label>
                <div class="col-sm-4">
                    <div class="col-xs-12 col-sm-12" style="padding-left: 0px;">
                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="11位手机号码" data-code="" value="<?php echo $telephone;?>" style="width: 55%; float: left;" data-code="">
                    </div>
                    <div class="col-xs-12 col-sm-12" style="margin-top:10px; padding-left: 0px;">
                        <!--<input type="text" class="form-control" placeholder="验证码" id="inputCode" style="width:70px; float: left;">-->
                        <!--<div class="mycode" id="code" style="width:70px; height:34px; overflow: hidden; float:left; margin: 0px 5px;"></div>-->

                        <input class="form-control" id="phone-code" placeholder="4位验证码" style="width:70px; float: left;" type="text">
                        <input class="btn btn-default" id="getcode" style="margin-left:5px; padding:8px 0px; width: 70px; font-size: 11px;" value="获取验证码">
                    </div>
                    <?php if ($error_telephone) { ?>
                    <div class="text-danger"><?php echo $error_telephone; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6" style="position: static;">
                    <span>请填写您的联系电话，多个号码请用空格分开。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">所在地区：</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                        if (!empty($agent_provice)){ ?>

                        <select class="form-control" name="province" id="province" style="width: 100px; float: left; margin-left:15px;">
                            <option value="<?php echo $agent_provice;?>" selected="selected"><?php echo $agent_provice;?></option>
                        </select>

                        <select class="form-control" name="city" id="city" style="width: 100px; float: left; margin-left:15px;">
                            <option value="<?php echo $agent_city;?>" selected="selected"><?php echo $agent_city;?></option>
                        </select>

                        <?php }else{ ?>

                            <select class="form-control" name="province" id="province" style="width: 100px; float: left; margin-left:15px;">
                                <?php foreach ($provinces as $province){ ?>
                                <option value="<?php echo $province['area_name'];?>" data-area-id="<?php echo $province['area_id'];?>"><?php echo $province['area_name'];?></option>
                                <?php } ?>
                            </select>

                            <select class="form-control" name="city" id="city" style="width: 100px; float: left; margin-left:15px;">
                                <option value="0" data-id="">请选择城市</option>
                            </select>

                        <?php } ?>
                        <?php if ($error_city) { ?>
                        <div class="text-danger"><?php echo $error_city; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <span>所属城市。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">详细地址：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="address_1" id="address_1" placeholder="Address" value="<?php echo $address_1;?>">
                    <?php if ($error_address_1) { ?>
                    <div class="text-danger"><?php echo $error_address_1; ?></div>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <span>请填写您的常用联系地址。</span>
                </div>
            </div>
            <!--<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">身份证号：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="id_number" id="idnumber" placeholder="ID number" value="<?php echo $id_number;?>">
                </div>
                <div class="col-sm-6">
                    <span>请如实填写身份证号码，如验证失败刚无法通过申请。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">身份证照：</label>
                <div class="col-sm-4 demo" id="demo1">
                    <input type="hidden" name="id_files" class="idfile" value="<?php echo $id_files;?>">
                    <div class="showimg"><img src="<?php echo $id_files;?>"></div>
                    <div class="btn">
                        <span>添加附件</span>
                        <input class="fileupload" type="file" name="mypic" data-id="demo1">
                    </div>
                    <div class="progress">
                        <span class="bar"></span><span class="percent">0%</span >
                    </div>
                    <div class="files"></div>
                </div>
                <div class="col-sm-6">
                    <span>请上传彩色身份证照图片（格式为JPG、小于800KB）。</span>
                </div>
            </div>
            <div style="width: 100%; background: #C4E3F3; color: #31708F; height: 30px; line-height: 30px; text-align: center; margin: 0px 0px 15px 0px; ">自营店铺选填</div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">公司简称：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="company_short" id="company_short" placeholder="Corporation" value="<?php echo $company_short;?>">
                </div>
                <div class="col-sm-6">
                    <span>少于等于八个汉字，点击查看<a href="#">公司简称全名规范</a></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">公司全称：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company" value="<?php echo $company_name;?>">
                </div>
                <div class="col-sm-6">
                    <span>请填写您公司全称,与营业执照一至。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">注册号：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="company_number" id="company_number" placeholder="Business license" value="<?php echo $company_number;?>">
                </div>
                <div class="col-sm-6">
                    <span>请填写您公司营业执照号码，若与营业执照不一至刚不能通过审核。</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">营业执照：</label>
                <div class="col-sm-4 demo" id="demo2">
                    <input type="hidden" name="company_files" class="idfile" value="<?php echo $company_files;?>">
                    <div class="showimg"><img src="<?php echo $company_files;?>"></div>
                    <div class="btn">
                        <span>添加附件</span>
                        <input class="fileupload" type="file" name="mypic" data-id="demo2">
                    </div>
                    <div class="progress">
                        <span class="bar"></span><span class="percent">0%</span >
                    </div>
                    <div class="files"></div>
                </div>
                <div class="col-sm-6">
                    <span>请上传彩色营业执照图片（格式为JPG、小于800KB）。</span>
                </div>
            </div>
            -->
            <div class="form-group">
                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="text-align: center;">
                    <div class="checkbox">
                        <label style="color: #767676 !important;">
                            <input type="checkbox" name="agree" id="confirm"> 我已阅读<a href="http://iddmall.com/index.php?route=account/register/protocol" target="_blank">《达蒙珠宝平台会员注册协议》</a>
                        </label>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <button type="submit" id="submit" class="btn btn-default">同意服务条款 提交注册信息</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
    </div>
    <footer class="footer">
        <p>&copy; 安徽达蒙狗科技有限公司 2015</p>
    </footer>

</div>
<script type="text/javascript">

    $('#address').on('change',function(){
        var address_1 = $(this).val();
        $('#address_1').val(address_1);
    });

    $('#province').on('change',function(){
        var province_id = $(this).find('option:selected').attr('data-area-id');
        var html = '<option value="0">请选择所在城市</option>';
        $.post('index.php?route=account/account/citys',{province_id:province_id},function(data){
            if (data.status == 'success'){
                $.each(data.citys,function(index,item){
                    html += "<option value='"+item.area_name+"'>"+item.area_name+"</option>";
                });
            }
            $('#city').html(html);
        },'json');
    });


    $('#getcode').on('click',function(){
        var phone = $('#telephone').val();
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
            $.post('./index.php?route=account/account/sendmessage',{phone:phone},function(data){
                if (data.status == 'success') {
                    $('#inputCode').css('display','none');
                    $('#code').css('display','none');
                    $('#phone-code').css('display','block');

                    $('#telephone').attr('data-code',data.code);
                    settime();
                }
                else {
//                            alert(data.status);
                    alert('短信发送失败,请检验手机号码是否正确！');
                }
            },'json');
        }
    });


    $(function () {
        $(".fileupload").wrap("<form class='myupload' action='./index.php?route=common/uploade' method='post' enctype='multipart/form-data'></form>");
        $(".fileupload").change(function(){
            var id = $(this).attr('data-id');
            var bar = $("#"+id+" .bar");
            var percent = $("#"+id+" .percent");
            var showimg = $("#"+id+" .showimg");
            var progress = $("#"+id+" .progress");
            var files = $("#"+id+" .files");
            var btn = $("#"+id+" .btn span");
            var image = $("#"+id+" .idfile");
            $(".myupload").ajaxSubmit({
                dataType:  'json',
                beforeSend: function() {
                    showimg.empty();
//                    progress.show();
//                    var percentVal = '0%';
//                    bar.width(percentVal);
//                    percent.html(percentVal);
                    btn.html("上传中...");
                },
                uploadProgress: function(event, position, total, percentComplete) {
//                    var percentVal = percentComplete + '%';
//                    bar.width(percentVal);
//                    percent.html(percentVal);
                },
                success: function(data) {
//                    files.html("<span class='delimg' rel='"+data.pic+"' onclick=\"delimg('"+data.pic+"')\">删除</span>");
                    files.html("<b style='display: none;'>"+data.name+"("+data.size+"k)</b> <span class='delimg' rel='"+data.pic+"' onclick=\"delimg('"+data.pic+"','"+id+"')\">删除</span>");
                    var img = "image/catalog/upload/image/"+data.pic;
                    showimg.html("<img src='"+img+"'>");
                    image.val(img);
                    btn.html("添加附件");
                },
                error:function(xhr){
                    btn.html("上传失败");
                    bar.width('0')
                    files.html(xhr.responseText);
                }
            });
        });

    });

    function delimg(pic,id)
    {
        var files = $("#"+id+" .files");
        var showimg = $("#"+id+" .showimg");
        var progress = $("#"+id+" .progress");
        var image = $("#"+id+" .image");
        $.post("./index.php?route=common/uploade/delimg",{imagename:pic},function(msg){
            if(msg==1){
                files.html("删除成功.");
                showimg.empty();
                progress.hide();
            }else{
                alert(msg);
            }
        });
    }

    $('#register_form').submit(function(e){
        var code = $('#phone-code').val();
        var code_data = $('#telephone').attr('data-code');

        if (!$("#confirm").is(':checked'))
        {
            alert('请同意达蒙从业人员协议!');
            return false;
            e.preventDefault();
        }
        else if (code != code_data || code == '')
        {
            alert('短信验证码输入不正确！');
            e.preventDefault();
        }
        else{
            var password = $("#password").val();
            var passwordconfirm = $("#passwordconfirm").val();

            if (password != passwordconfirm)
            {
                alert('两次密码输入不一至!');
                return false;
            }
            else {
                $('#register_form').submit();
            }
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
        validateFn: function (result, code) { //验证回调函数
            var phone = $('#telephone').val();
            if (isNaN(phone) || phone == '')
            {
                alert('请输入正确的手机号码!');
            }
            else
            {
                if (result) {

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
                    $.post('./index.php?route=account/account/sendmessage',{phone:phone},function(data){
                        if (data.status == 'success') {
                            $('#inputCode').css('display','none');
                            $('#code').css('display','none');
                            $('#phone-code').css('display','block');

                            $('#telephone').attr('data-code',data.code);
                            settime();
                        }
                        else {
//                            alert(data.status);
                            alert('短信发送失败,请检验手机号码是否正确！');
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
</body>
</html>