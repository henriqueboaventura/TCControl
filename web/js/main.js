$(document).ready(function(){
    $('div#tool_box img').toggle(
        function(){
            $('div#tool_box ul').addClass('show');
        },
        function(){
            $('div#tool_box ul').removeClass('show');
        }
    );

    $(this).click(function(){
        if($('div#tool_box ul').hasClass('show')){
            $('div#tool_box img').click();
        }
    })
});
