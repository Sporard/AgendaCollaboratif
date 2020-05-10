<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title> Agenda Collabo </title>
        <link rel="stylesheet" type ="text/css" href="css/style.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script type="text/javascript">
            jQuery(function($){
                $('.month').hide();
                $('.month:first').show();
                $('.months a:first').addClass('active');
                var current = 1;
                $('.months a').click(function(){
                    var month = $(this).attr('id').replace('linkMonth','');
                    if(month != current){
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('.months a').removeClass('active');
                        $('.months a#linkMonth'+month).addClass('active');
                        current = month;
                    }
                    return false;
                });
            });
            </script>

    </head>
<body>


</html>



