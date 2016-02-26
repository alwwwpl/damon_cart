<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="./catalog/view/javascript/summernote/summernote.css"/>
<script type="text/javascript" src="./catalog/view/javascript/summernote/summernote.min.js"></script>
<script type="text/javascript" src="./catalog/view/javascript/jquery-upload/jquery.form.js"></script>
<style>
    .note-editor .btn {
        background: #FFF none repeat scroll 0px 0px !important;
        border: 1px solid #CCC !important;
        color: #000;
        font-size:8px !important;
        padding: 8px 10px !important;
    }
    .form-group .control-label {
        font-size: 15px; text-align: center; font-weight: 800;
    }

    .demo { width:620px;
        margin-top:10px;
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

    .demo .bar { background-color: #FD4F4E; display:block; width:0%; height:20px; border-radius: 3px; }
    .percent {
        position: absolute;
        height: 20px;
        display: inline-block;
        top: 3px;
        left: 2%;
        color: #fff
    }

    .demo .files { height:22px; line-height:22px; margin:10px 0}
    .demo .delimg { margin-left:20px; color:#FD4F4E; cursor:pointer}
</style>
<div class="container">
    <div class="row">
        <div class="bt-breadcrumb">
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>"> <?php echo $content_top; ?>
            <h2><?php echo $text_add; ?></h2>
            <div class="content_bg">
                <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $add_customised_name;?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name"  placeholder="PRODUCT NAME">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $add_customised_type;?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_type" id="product_type" placeholder="TYPE">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $add_customised_brand;?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_brand" id="product_brand" placeholder="BRAND">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $add_customised_number;?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number" placeholder="NUMBER">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="exampleInputFile" class="col-sm-2 control-label"><?php echo $add_customised_image;?></label>
                        <div class="col-sm-10 demo">
                            <!--<input type="file" id="exampleInputFile" name="image">
                            <p class="help-block"><?php echo $add_customised_up;?></p>-->

                            <input type="hidden" name="image" id="image">
                            <div class="btn">
                                <span>添加附件</span>
                                <input id="fileupload" type="file" name="mypic">
                            </div>
                            <div class="progress">
                                <span class="bar"></span><span class="percent">0%</span >
                            </div>
                            <div class="files"></div>
                            <div id="showimg"></div>

                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $add_customised_desc;?></label>
                        <div class="col-sm-10">
                            <div id="summernote"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-default submit" name="submit"><?php echo $add_customised_sumbit;?></button>
                        </div>
                    </div>
                </form>
            </div>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,                 // set editor height

            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor

            focus: true                 // set focus to editable area after initializing summernote
        });
    });

    $('.submit').on('click',function(){
        var product_name = $('#product_name').val();
        var product_type = $('#product_type').val();
        var product_brand = $('#product_brand').val()
        var number = $('#number').val();
        var image = $('#image').val();
        var desc = $('#summernote').code();
        if (product_name == ''){
            alert('请填写商品名称!');
        }
        else if (product_type == ''){
            alert('请填写商品类型!');
        }
        else if (product_brand == ''){
            alert('请填写商品品牌');
        }
        else if (number == ''){
            alert('请填写采购数量!')
        }
        else if (image == ''){
            alert('请上传商品图片!');
        }
        else if (desc == ''){
            alert('请填写商品描述!');
        }
        else{
            $.post("./index.php?route=account/customised/insert",{product_name:product_name,product_type:product_type,product_brand:product_brand,number:number,image:image,desc:desc},function(data){
                if(data.status == 'success'){
                    window.location.href = './index.php?route=account/customised';
                }else{
                    if(data.product_name)
                    {
                        alert(data.product_name);
                    }
                    else if(data.product_type)
                    {
                        alert(data.product_type);
                    }
                    else if(data.product_brand)
                    {
                        alert(data.product_brand);
                    }
                    else if(data.image)
                    {
                        alert(data.image);
                    }
                    else if(data.desc)
                    {
                        alert(data.desc);
                    }
                    else if(data.number)
                    {
                        alert(data.number);
                    }
                }
            },'json');
        }
    });

    $(function () {
        var bar = $('.bar');
        var percent = $('.percent');
        var showimg = $('#showimg');
        var progress = $(".progress");
        var files = $(".files");
        var btn = $(".btn span");
        var image = $("#image");
        $("#fileupload").wrap("<form id='myupload' action='./index.php?route=common/uploade' method='post' enctype='multipart/form-data'></form>");
        $("#fileupload").change(function(){
            $("#myupload").ajaxSubmit({
                dataType:  'json',
                beforeSend: function() {
                    showimg.empty();
                    progress.show();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    btn.html("上传中...");
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                success: function(data) {
                    files.html("<b>"+data.name+"("+data.size+"k)</b> <span class='delimg' rel='"+data.pic+"' onclick=\"delimg('"+data.pic+"')\">删除</span>");
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

    function delimg(pic)
    {
        var files = $(".files");
        var showimg = $('#showimg');
        var progress = $(".progress");
        var image = $(".image");
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
</script>
<?php echo $footer; ?>