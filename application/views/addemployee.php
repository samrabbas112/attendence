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
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
<nav id="nav">

</nav>
<div class="container-md" style="margin:0 20% 0 20%;">
    <form method="post" action="<?php echo 'http://localhost/Attendence_System'; ?>/attendencee/add_employee" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
            <div class="error">
                <?php if(!empty($data['name_error'])): echo $data['name_error']; endif;?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <div class="error">
                <?php if(!empty($data['email_error'])): echo $data['email_error']; endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Enter Password">
            <div class="error">
                <?php if(!empty($data['password_error'])): echo $data['password_error']; endif;?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Profile Pic</label>
            <input type="file" class="form-control" name="file" id="file" aria-describedby="emailHelp">
            <div class="error">
                <?php if(!empty($data['file_error'])): echo $data['file_error']; endif;?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Department</label>
            <input type="text" class="form-control" name="dept"  id="dept" placeholder="Department">
            <div class="error">
                <?php if(!empty($data['dept_error'])): echo $data['dept_error']; endif;?>
            </div>
        </div>

        <div>
            <label for="exampleInputPassword1">Salary</label>
            <input type="text" class="form-control" name="salary"  id="salary" placeholder="Enter Salary">
            <div class="error">
                <?php if(!empty($data['salary_error'])): echo $data['salary_error']; endif;?>
            </div>
        </div>
        <br>
        <div>
            <label for="boss">Boss</label>
            <select name="boss" id="boss" class="form-control">
                <option value="">SELECT</option>
            </select>
        </div>
        <br>
        <div>
            <label for="exampleInputPassword1">Designation</label>
            <select name="designation" id="designation" class="form-control">
                <option value="">SELECT</option>
            </select>

        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
    </form>
</div>

</body>
<script>
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/add_employee_select",
            type:"POST",
            success:function(result){
                $("#boss").html(result);
            }
        });
    });
</script>
<script>
    $(document).ready(function (){
        $.ajax({
            url:"<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/add_designation_select",
            type:"POST",
            success:function(result){
                $("#designation").html(result);
            }
        });
    })
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

