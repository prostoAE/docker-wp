(function($){
    $(document).ready(function(){
        //console.log('lets make Done');

        $('.lts-checkbox').on('change', function(){
            let inp = $(this).find('input');

            if(inp.length){
                if(inp.prop('checked')){
                    inp.val('on');
                console.log(inp.val());
            }else{
                inp.prop('checked', false);
                inp.val('');
            }
        }
       
        });


    });
})(jQuery);