
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Attendence FORM</title>
    <!--    --><?php //CSSLINK("public/assets/css/bootstrap.min.css");?>
</head>
<body>
<nav id="nav">

</nav>
<div id="div"></div>
<div class="container">
    <button class="btn-block btn-primary" style="display: block; width: 54%; margin: auto; padding: 13px; margin-top: 5%;" id="checkindisabled" disabled>CHECK IN</button>
    <button class="btn-block btn-primary" style="display: block; width: 54%; margin: auto; padding: 13px; margin-top: 5%;" id="checkin">CHECK IN</button>
    <button class="btn-block btn-primary" style="display: block; width: 54%; margin: auto; padding: 13px; margin-top: 5%;" id="checkout">CHECK OUT</button>

</div>
<script>

    $(document).ready(function(){
        $('#checkindisabled').hide();
        $('#checkin').on("click",function(){
               $('#checkout').show();
               $('#checkin').hide();
            // let current_date_time=new Date();
            // console.log(current_date_time);
            //
            // var date = current_date_time.getFullYear()+'-'+(current_date_time.getMonth()+1)+'-'+current_date_time.getDate();
            // var time=current_date_time.getHours()+'-'+current_date_time.getMinutes()+'-'+current_date_time.getSeconds();
            // var Time=date('h:i A', strtotime(time));
            // console.log(Time);
            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/add_attendence/",
                type:"POST",
                success:function (data){
                   $('#div').html(data);
                }

            });
        });
        $('#checkout').on("click",function(){
            $('#checkin').show();
            $('#checkout').hide();
            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/add_attendence_checkout/",
                type:"POST",
                success:function (data){
                    $('#div').html(data);
                }

            });
        });

            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/check_employee/",
                type:"POST",
                success:function (data){
                    $("#div").html(data);
                }

            });

    });
    $(document).ready(function (){
        $.ajax({
            url:"<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/nav",
            type:"POST",
            success:function(result){
                $("#nav").html(result);
            }
        });
    })

</script>
<script>

    $(document).ready(function (){
        function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
            console.log(formatAMPM(new Date));
        if(formatAMPM(new Date)==='12:00 pm'){
            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/email",
                type:"POST",
                success:function (data){
                    $("#div").html(data);
                }
            })
            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/add_leave_attendence",
                type:"POST",
                success:function (data){
                    $("#div").html(data);
                }
            });

        }
        if(formatAMPM(new Date)==='11:00 am'){
            $.ajax({
                url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/email_late",
                type:"POST",
                success:function (data){
                    $("#div").html(data);
                }
            })
        }


    })
</script>
</html>

