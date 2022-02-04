<?php
class employee_attendence extends framework{
    public function __construct(){
        $this->attendence_modal=$this->model('attendence_modal');
    }
    public function index(){
        $this->view('employee_attendence');
    }
    public function add_attendence(){
            $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
            $time=$dateTime->format("H:i A");
             $date=$dateTime->format("Y/m/d");
            $emp_id=$this->getSession('empid');
        if(!$this->attendence_modal->check($emp_id,$date)){
         echo  '<script> 
                 $("#checkin").hide();
                          $("#checkout").hide();
                 </script>';

        }else{
            $result=$this->attendence_modal->add_attendence($date,$time,$emp_id);
            if($result){
                echo '<script>
                     $("#checkin").hide();
                          $("#checkout").show();
//                           $("#checkout").attr("disabled",true);
         
                    
                  </script>';
            }
        }


    }
    public function add_leave_attendence(){
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $date=$dateTime->format("Y/m/d");
        $result=$this->attendence_modal->add_leave_attendence($date);
        if($result){
            echo 'done ho gaya';
        }else{
            echo 'done no gaya';
        }

    }
    public function email(){
        $subject='Leave Employees';
        $body='This is the email for leave employees';
        $from='Ceo@gmail.com';
        $result=$this->attendence_modal->email();
        foreach ($result as $res){
          echo $res->email;
            $result2=$this->attendence_modal->add_email($res->email,$subject,$body,$from);
            echo $result2;
            if($result2){
            }else{
            }
        }
    }
    public function email_late(){
        $subject='Late Employees';
        $body='This is the email for late employees';
        $from='Ceo@gmail.com';
        $result=$this->attendence_modal->email_late();
        foreach ($result as $res){

            $result2=$this->attendence_modal->add_email($res->email,$subject,$body,$from);
            if($result2){
            }else{
            }
        }
    }
    public function leave_employee(){
        $result=$this->attendence_modal->leave_employee();
        print_r($result);
        return $result;
//        if($result){
//            echo '<script>alert("your attendence is marked as leave")</script>';
//
//        }
    }
    public function add_attendence_checkout(){
        $dateTimee = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $time=$dateTimee->format("h:i A");
        $date=$dateTimee->format("Y/m/d");
        $emp_id=$this->getSession('empid');
        $result=$this->attendence_modal->add_attendence_checkout($time,$emp_id,$date);
        if($result){

//            $this->setFlash('empid','Your Closure Attendence HAS BEEN TAKEN');
            echo '<script> 
                  $("#checkin").hide();
                 $("#checkout").hide();
                 </script>';

        }

    }
    public function check_employee(){
        $emp_id=$this->getSession('empid');
        $result=$this->attendence_modal->check_employee($emp_id);
            if($result){

        }else{

            }
    }
    public function reports_month(){
              $ss=$_POST['val_month'];
              $result=$this->attendence_modal->reports_month($ss);
                $str='';
                foreach ($result as $res){
                    $str.="<tr><td>".$res->emp_name."</td><td>".$res->boss."</td><td>".$res->designation_name."</td><td>".$res->attendence_time."</td><td>".$res->attendence_timeout."</td><td>".$res->attendence_date."</td><td>".$res->status."</td></tr>";
                }
                 echo $str;




    }
    public function check_employee_out(){
        $emp_id=$this->getSession('empid');
        $result=$this->attendence_modal->check_employee_out($emp_id);
        if($result){
            echo '<script>
                    $("#checkout").hide();
                    $("#checkin").show();
                  </script>';
        }else{
            echo '<script>
                    $("#checkin").hide();
                    $("#checkout").show();
                  </script>';
        }
    }
}
?>
