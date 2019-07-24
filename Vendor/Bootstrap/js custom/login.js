	$(document).ready(function(){
        $('.box').delay(500).show('fast');
        $('.box').ready(function(){
            $('.input-group-text').eq(0).click(function(){
                $('#email').focus();
            });

            var showPass=0;
            $('.input-group-text').eq(1).click(function(){
                $('#password').focus();
                $(this).find('i').toggleClass("fa-eye-slash fa-eye");
                if(showPass == 1) {
                    $('#password').attr('type','password');
                    showPass = 0;
                }
                else {
                    $('#password').attr('type','text');
                    showPass = 1;
                }
            });
            
            $('#email').focus(function(){
                $('.input-group-text').eq(0).css({
                    'color':'rgb(9, 44, 126)',
                    'border-bottom':'2px solid rgb(9, 44, 126)',
                    'transition':'all 0.5s ease-in-out'
                });
                $(this).css({
                    'color':'rgb(9, 44, 126)',
                    'border-bottom':'2px solid rgb(9, 44, 126)',
                    'transition':'all 0.5s ease-in-out'
                });
            });
            $('#password').focus(function(){
                $('.input-group-text').eq(1).css({
                    'color':'rgb(9, 44, 126)',
                    'border-bottom':'2px solid rgb(9, 44, 126)',
                    'transition':'all 0.5s ease-in-out'
                });
                $(this).css({
                    'color':'rgb(9, 44, 126)',
                    'border-bottom':'2px solid rgb(9, 44, 126)',
                    'transition':'all 0.5s ease-in-out'
                });
            });
            $('#email').blur(function(){
                $('.input-group-text').eq(0).css({
                    'color':'rgb(159, 159, 159)',
                    'border-bottom':'1px solid rgb(159, 159, 159)',
                    'transition':'all 0.5s ease-in-out'
                });
                $(this).css({
                    'color':'rgb(159, 159, 159)',
                    'border-bottom':'1px solid rgb(159, 159, 159)',
                    'transition':'all 0.5s ease-in-out'
                });
            });
            $('#password').blur(function(){
                $('.input-group-text').eq(1).css({
                    'color':'rgb(159, 159, 159)',
                    'border-bottom':'1px solid rgb(159, 159, 159)',
                    'transition':'all 0.5s ease-in-out'
                });
                $(this).css({
                    'color':'rgb(159, 159, 159)',
                    'border-bottom':'1px solid rgb(159, 159, 159)',
                    'transition':'all 0.5s ease-in-out'
                });
            });
        });
    });