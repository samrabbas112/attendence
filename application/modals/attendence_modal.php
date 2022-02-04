<?php
class attendence_modal extends database{
    public function email(){
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $time=$dateTime->format("h:i A");
        $date=$dateTime->format("Y/m/d");
        if($this->query("SELECT * FROM employee e WHERE NOT EXISTS(select * FROM attendence a where e.emp_id=a.emp_id AND a.attendence_date=?)",[$date])){
            if($this->rowCount()>0){
                $row=$this->fetchall();
                return $row;
            }
        }
    }
    public function email_late(){
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $time=$dateTime->format("h:i A");
        $date=$dateTime->format("Y/m/d");
        $dateTime2 = new DateTime('11:00', new DateTimeZone('Asia/Karachi'));
        $time2=$dateTime2->format("H:i ");
        if($this->query("SELECT * FROM employee e WHERE NOT EXISTS(select * FROM attendence a where e.emp_id=a.emp_id AND a.attendence_date=?)",[$date])){
            if($this->rowCount()>0){
                $row=$this->fetchall();
//                 print_r($row);
                return $row;
//                if($time>$time2){
//                    return true;
//                }
//                else{
//                    return false;
//                }
            }
        }
    }
    public function add_email($str,$subject,$body,$from){
        if($this->query("INSERT INTO email(emp_email,from_email,email_subject,email_body) VALUES(?,?,?,?)",[$str,$from,$subject,$body])){
           return true;
        }
    }
    public function check($emp_id,$date){

        if($this->Query("SELECT emp_id FROM attendence WHERE emp_id = ? AND attendence_date=?", [$emp_id,$date])){

            if($this->rowCount() > 0 ){
                return false;
            } else {
                return true;
            }

        }

    }

    public function add_attendence($date,$time,$emp_id)
    {
        echo $date;
        $dateTime2 = new DateTime('15:00', new DateTimeZone('Asia/Karachi'));
        $DateTime2=$dateTime2->format('H:i');
        if($time > $DateTime2){
            $status = 'Late';
        } else {
            $status='Present';
        }

        if($this->query("INSERT INTO attendence(emp_id,status,attendence_date,attendence_time,on_leave) VALUES (?,?,?,?,'false')",[$emp_id,$status,$date,$time])){
            return true;
        }
    }

    public function add_leave_attendence($date)
    {
        if($this->query("INSERT INTO attendence(emp_id) SELECT e.emp_id FROM employee e LEFT JOIN attendence a ON e.emp_id=a.emp_id WHERE a.emp_id IS NULL")){
          if($this->query("UPDATE attendence SET on_leave=?,attendence_date=?,status=? WHERE on_leave IS NULL",['1',$date,'leave']))
              return true;
        }
    }
    public function reports_month($ss){
        if($this->query("SELECT * FROM employee e INNER jOIN attendence a ON e.emp_id=a.emp_id INNER JOIN designation d ON e.designation_id=d.designation_id WHERE (SELECT MONTH(a.attendence_date))=?",[$ss])){
            if($this->rowCount()>0){
                $row=$this->fetchall();
                return $row;
            }
        }
//        $str=array();
//        if($this->query("SELECT * FROM employee e INNER JOIN attendence a ON e.emp_id=a.emp_id WHERE (SELECT Distinct(MONTH(a.attendence_date)))=? AND a.status='late'",[$ss])){
//           $late=$this->rowCount();
//           $str.=$late;
//
//        }
//        if($this->query("SELECT * FROM employee e INNER JOIN attendence a ON e.emp_id=a.emp_id WHERE (SELECT DISTINCT (MONTH(a.attendence_date)))=? AND a.status='Present'",[$ss])){
//            $present= $this->rowCount();
//            $str.=$present;
//        }
//        if($this->query("SELECT * FROM employee e LEFT JOIN attendence a ON e.emp_id=a.emp_id WHERE  (SELECT MONTH(a.attendence_date))=? AND a.emp_id IS NULL",[$ss])){
//            $leave=$this->rowCount();
//            $str.=$leave;
////
//        }
//
//
//        return $str;
    }
    public function add_attendence_checkout($time,$emp_id){
        if($this->query("UPDATE attendence SET attendence_timeout= ? WHERE emp_id=$emp_id",[$time])){
            return true;
        }
    }
    public function leave_employee(){
        if($this->query("SELECT * FROM employee e LEFT JOIN attendence a ON e.emp_id=a.emp_id WHERE a.emp_id IS NULL")){
            if($this->rowCount()>0){
                $row=$this->fetchall();
                print_r($row);
                return $row;


            }
        }
    }
    public function check_employee($emp_id){
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $date=$dateTime->format("Y/m/d");
        if($this->query("SELECT * FROM attendence WHERE attendence_date=?  AND on_leave='1' AND emp_id=?",[$date,$emp_id])){
            if($this->rowCount()>0){
                echo '<script>
                   $("#checkindisabled").show();
                   $("#checkin").hide();
                   $("#checkout").hide();
                 </script>';
            }
            else{
                if($this->query("SELECT * FROM attendence WHERE emp_id=? AND attendence_date=? AND attendence_time IS NOT NULL AND attendence_timeout !='00:00:00' AND on_leave='0'",[$emp_id,$date])) {

                    if ($this->rowCount() > 0) {
                        echo '<script>
                    $("#checkin").hide();
                    $("#checkout").hide();
                  </script>';
                    } else {
                        if($this->query("SELECT * FROM attendence WHERE emp_id=? AND attendence_date=? AND attendence_time IS NOT NULL AND attendence_timeout ='00:00:00' AND on_leave='0'",[$emp_id,$date])){
                            if($this->rowCount()>0){
                                echo '<script>
                                   $("#checkin").hide();
                                   $("#checkout").show();
                                  </script>';
                            }else{
                                echo '<script>
                   $("#checkin").show();
                   $("#checkout").hide();
//                  </script>';
                            }
                        }

                    }
                }
            }
        }
    }
    public function check_employee_out($emp_id){
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $date=$dateTime->format("Y/m/d");
        if($this->query("SELECT * FROM attendence WHERE emp_id=? AND attendence_timeout IS NOT NULL AND attendence_date=?",[$emp_id,$date])){
            if($this->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }
    }
}
