$.total = {
    pending: false,
    //ajax请求
    ajax: function(params,fn) {
        var _this = this;
        $.ajax($.extend(params,{
            dataType: 'json',
            type: 'post',
            timeout: 5*1000,
            beforeSend: function() {
                if ($.total.pending) {
                    return false;
                } else {
                    $.total.pending = true;
                }
            },
            success: function(data) {

                fn.call(this, data);
                $.total.pending = false;
            },
            error: function(request, status) {
                //_this.msg('系统错误',2);
            }
        }));
    },
    //手机号码
    isMobile: function(mobile) {
        return /^1[3|4|5|7|8]\d{9}$/.test(mobile);
    },
    //固定电话
    isPhone: function(phone){
        return /^(\d{3}-\d{8})|(\d{4}-\d{7})|\d{7,8}$/.test(phone);
    },
    //固定电话新
    isPhoneNew: function(phone) {
        return /^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/.test(phone);
    },
    //邮箱
    isEmail: function(email) {
        return /^[0-9a-z][_.0-9a-z-]{0,31}@([0-9a-z][0-9a-z-]{0,30}[0-9a-z]\.){1,4}[a-z]{2,4}$/.test(email);
    },
    //字符数，中文算2个
    length: function(str) {
        return str.replace(/[^\x00-\xff]/gi, '--').length;
    },
    //添加cookie
    setCookie: function(objName, objValue, objMinutes) {
        var str = objName + '=' + escape(objValue);
        var date = new Date();
        var ms = objMinutes * 60 * 1000;
        date.setTime(date.getTime() + ms);
        str += '; path=/; expires=' + date.toGMTString();
        document.cookie = str;
    },
    //读取cookie
    getCookie: function(objName) {
        var arrStr = document.cookie.split('; ');
        for (var i = 0; i < arrStr.length; i++) {
            var temp = arrStr[i].split('=');
            if (temp[0] == objName) return unescape(temp[1]);
        }
    },
    //删除cookie
    delCookie: function(objName) {
        this.setCookie(objName, 1, -1);
    },

    //show loading
    showMask: function() {
        $("#st_loading").show();
        $("#st_data_empty").hide();
    },

    //hide loading
    hideMask: function() {
        $("#st_loading").hide();
    },

    //js url
    createUrl: function(url) {
        return CONFIG.home_url + url + CONFIG.url_ext;
    },

    //alert
    stAlert: function(msg) {
        alert(msg)
    },

    /*对话框
     * @param msg  内容
     * @param fn 确认回调
     * @options   参数配置
     */
    alert: function(msg, fn, icon) {
        var icon = arguments[2] ? arguments[2] : -1;
        layer.alert(msg, {icon:icon,title:'信息提示'}, fn);
    },
    /*
     * tip提示
     * @param msg  内容
     * @param icon 图标-1警告,1正确，2错误
     * @param fn 消失后回调
     */
    msg: function(msg, icon, fn) {
        icon = arguments[1] ? arguments[1] : 1;
        layer.msg(msg,{icon:icon}, fn);
    },

    /*confirm确认框
    * @param msg  内容
    * @param yes 确认回调
    * @param no  取消回调
    * @options   参数配置
    */
     confirm:function(msg, yes, no ,options) {
        var options = arguments[3] ? arguments[3] : {title:'确认提示',shade: false};
        layer.confirm(msg, options, yes, no);
     },

    /**
     * 弹层
     * @options   参数配置
     */
     pop:function(options){
        layer.open(options);
     },

    //常规有效字符串(大小写字母、数字、下划线)
    strValid: function(str,minSize,maxSize) {
        if(/^[0-9a-zA-Z_]*$/.test(str)) {
            if(str.length > maxSize || str.length < minSize) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    },

    /**
     * 浮点数载取
     */
    formatFloat: function(src, pos) {
        return Math.round(src * Math.pow(10, pos)) / Math.pow(10, pos);
    },

    /**
     * 限制只能输入正整数
     */
    fillNumOnly: function (obj) {
        if(!/^[1-9][0-9]*$/.test(obj.value)) {
            obj.value = 1;
        }
    }

}

