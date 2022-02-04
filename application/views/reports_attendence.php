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
<div id="div"></div>
<br>
<h2 style="margin:auto;width: 30%; ">REPORTS OF THE MONTH</h2>
<br>
<div class="container">
    <?php
    function formMonth(){
        $month = strtotime(date('Y').'-'.date('m').'-'.date('j').' - 11 months');
        $end = strtotime(date('Y').'-'.date('m').'-'.date('j').' + 1 months');
        $val=1;
        echo "<select class='form-control' id='month'><option>SELECT ONE</option>";

        while($month < $end){

            $selected = (date('F', $month)==date('F'))? ' selected' :'';
            echo '<option'.$selected.' value='.$val.'>'.date('F', $month).'</option>'."\n";
            $month = strtotime("+1 month", $month);
            $val++;
        }
        echo "</select>";
    }

    formMonth();

    ?>
    <br>
<!--    <div>-->
<!--        <label for="present">Present Employees</label>-->
<!--        <input type="text" id="present" name="present" class="form-control">-->
<!--    </div>-->
<!--    <br>-->
<!--    <div>-->
<!--        <label for="late">Late Employees</label>-->
<!--        <input type="text" id="late" name="late" class="form-control">-->
<!--    </div>-->
<!--    <br>-->
<!--    <div>-->
<!--        <label for="leave">Leave Employees</label>-->
<!--        <input type="text" id="leave" name="leave" class="form-control">-->
<!--    </div>-->
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
        </tr>
        </thead>
        <tbody id="table_body">

        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
         $("#month").change(function(){
             var val_month=$("#month option:selected").val();
             console.log(val_month);
             $.ajax({
                 url:"<?php echo 'http://localhost/Attendence_System/';  ?>/employee_attendence/reports_month",
                 type:"post",
                 data:{val_month:val_month},
                 success:function (data){
                     // $("#present").val(data[6]);
                     // $("#late").val(data[5]);
                     // $("#leave").val(data[7]);
                     $("#table_body").html(data);

                 }
             });
         })

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
</body>
