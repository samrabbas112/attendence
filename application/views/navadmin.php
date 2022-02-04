<?php
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Attendence System</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo 'http://localhost/Attendence_System';  ?>/attendencee">Home</a></li>
            <li><a href="<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/addemployee">Add Employee</a></li>
            <li><a href="<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/view_attendence">View Employee</a></li>
            <li><a href="<?php echo 'http://localhost/Attendence_System';  ?>/attendencee/reports_attendence">Reports</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <!--            <li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>-->
            <li><a href="<?php echo 'http://localhost/Attendence_System'; ?>/attendencee/logout"><span class="glyphicon glyphicon-log-in"></span>LOGOUT</a></li>
        </ul>
    </div>
</nav>
