$(document).ready(function() {
    $('#copy').click(function(e){
        e.preventDefault();
    })

    $('#copy').clipboard({
        path: '/swf/jquery.clipboard.swf',
    });
});