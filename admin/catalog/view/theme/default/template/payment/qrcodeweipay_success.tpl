<?php echo $header; ?>
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
            <div align="center" id="qrcode">
                <p ><?php echo $qrcode_title ?></p>
            </div>
            <?php echo $text_message; ?>
            <div class="buttons">
                <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
            </div>
            <script src="catalog/view/javascript/qrcode.js"></script>
            <script>
                var url = "<?php echo $code_url;?>";
                //����1��ʾͼ���С��ȡֵ��Χ1-10������2��ʾ������ȡֵ��Χ'L','M','Q','H'
                var qr = qrcode(10, 'M');
                qr.addData(url);
                qr.make();
                var dom=document.createElement('DIV');
                dom.innerHTML = qr.createImgTag();
                var element=document.getElementById("qrcode");
                element.appendChild(dom);
            </script>
            <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>