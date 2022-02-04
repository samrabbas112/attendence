<?php
?>
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
<div class="container">
    <table  id="mytable" class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Boss</th>
            <th>Designation</th>
            <th>Attendence Time_in</th>
            <th>Attendence Time_out</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="table_body">

        </tbody>
    </table>
</div>

</body>
<script>
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo 'http://localhost/Attendence_System';?>/attendencee/view_employee/",
            type:"POST",
            success:function(result){
                $("#table_body").html(result);
            }
        });
    });
</script>
<script>
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
</html>


