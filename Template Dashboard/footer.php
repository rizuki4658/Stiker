    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <script src="Dashboard/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="Vendor/Bootstrap/js/jquery.js"></script>
    <script src="Dashboard/assets/js/popper.min.js"></script>
    <script src="Dashboard/assets/js/plugins.js"></script>
    <script src="Dashboard/assets/js/main.js"></script>
    <script src="Dashboard/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="Dashboard/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="Dashboard/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="Dashboard/assets/js/lib/data-table/datatables-init.js"></script>
    <script src="Dashboard/assets/js/dashboard.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#bootstrap-data-table-export').DataTable();
        $("#welcome-dashboard").fadeIn(1500);
        $('#btn_logout').click(function(){
            $('#modallogout').fadeIn(500, function(){
                $('.logout-body').css({
                    'width':'50%',
                    'height':'40%',
                    'transition':'all 0.3s ease-in'
                });
                $('h5').delay(300).fadeIn(500);
                $('h1').delay(300).fadeIn(500);
                $('#yes_logout').delay(300).fadeIn(500);
                $('#no_logout').delay(300).fadeIn(500);
            });
        });
        $('#no_logout').click(function(){
            $('#reminder').css({'display':'none'});
            $('#question').css({'display':'none'});
            $('#yes_logout').css({'display':'none'});
            $('#no_logout').css({'display':'none'});
            
            $('.logout-body').css({
                'width':'0%',
                'height':'0%',
                'transition':'all 0.3s ease-out'
            });

            $('#modallogout').fadeOut(1000);
        });

        $('#setting-profil').click(function(){
            $('#setting_form').fadeIn(1000);
            $('#password_form').css({'display':'none', 'transition':'all 1s ease-out'});
            $('#picture_form').css({'display':'none', 'transition':'all 1s ease-out'});
        });
        $('#close_setting').click(function(){
            $('#setting_form').fadeOut(500);
        });


        $('#setting-password').click(function(){
            $('#setting_form').css({'display':'none', 'transition':'all 1s ease-out'});
            $('#password_form').fadeIn(1000);
            $('#picture_form').css({'display':'none', 'transition':'all 1s ease-out'});
        });
        $('#close_password').click(function(){
            $('#password_form').fadeOut(500);
        });


        $('#setting-picture').click(function(){
            $('#setting_form').css({'display':'none', 'transition':'all 1s ease-out'});
            $('#password_form').css({'display':'none', 'transition':'all 1s ease-out'});
            $('#picture_form').fadeIn(1000);
        });
        $('#close_picture').click(function(){
            $('#picture_form').fadeOut(500);
        });
    });
</script>