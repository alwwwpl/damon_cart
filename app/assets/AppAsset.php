<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap/bootstrap.css',
        'css/bootstrap/bootstrap-responsive.css',
        'css/bootstrap/bootstrap-overrides.css',
        'css/lib/jquery-ui-1.10.2.custom.css',
        'css/lib/font-awesome.css',
        'css/lib/bootstrap-wysihtml5.css',
        'css/lib/uniform.default.css',
        'css/lib/select2.css',
        'css/lib/bootstrap.datepicker.css',
        'css/lib/font-awesome.css',
        'css/compiled/user-list.css',
        'css/compiled/tables.css',
        'css/compiled/gallery.css',
        'css/compiled/personal-info.css',
        'css/compiled/user-profile.css',
        'css/compiled/form-wizard.css',
        'css/compiled/form-showcase.css',
        'css/compiled/index.css',
        'css/compiled/signin.css',
        'css/layout.css',
        'css/elements.css',
        'css/icons.css',

    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery-ui-1.10.2.custom.min.js',
        'js/jquery.knob.js',
        'js/jquery.flot.js',
        'js/jquery.flot.stack.js',
        'js/jquery.flot.resize.js',
        'js/wysihtml5-0.3.0.js',
        'js/bootstrap-wysihtml5-0.0.2.js',
        'js/jquery.uniform.min.js',
        'js/bootstrap.datepicker.js',
        'js/select2.min.js',
        'js/theme.js',
        'js/js.KinerCode.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
