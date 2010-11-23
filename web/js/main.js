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
    
    $('a.delete').click(function(e){
        //console.log('há');
        url = $(this).attr('href');
        $('body').append('<div id="dialogMsg">Tem certeza que deseja excluir o registro?</div>');        
        $('div#dialogMsg').dialog({
            dialogClass: 'alert',
            title: 'Atenção!',
            buttons: {
                Sim: function(){
                    window.location.href = url;
                },
                Cancelar: function(){
                    $(this).remove()
                }
            }
        });
        
        return e.preventDefault();
    })
});
