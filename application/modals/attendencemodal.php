<?php
class attendencemodal extends database{
   public function add_employee_select(){
       if($this->query("SELECT emp_name FROM employee WHERE designation_id = ?", [1])){
           if($this->rowCount()>0){
               $row=$this->fetchall();

               return $row;
           }
       }

   }
   public function add_employee($data){
         if($this->query("INSERT INTO employee(emp_name,dept,profile_pic,designation_id,salary,email,password,boss) VALUES (?,?,?,?,?,?,?,?)",$data)){
           return true;
         }
   }
   public function add_designation_select(){
       if($this->query("SELECT * FROM designation")){
           if($this->rowCount()>0){
               $row=$this->fetchall();
               return $row;
           }
       }

   }
   public function view_employee(){
       if($this->query("SELECT * FROM employee e INNER jOIN attendence a ON e.emp_id=a.emp_id INNER JOIN designation d ON e.designation_id=d.designation_id")){
           if($this->rowCount()>0){
               echo 'yes';
               $row=$this->fetchall();
               print_r($row);
               return $row;
           }
       }
   }
   public function delete_employee($id){
       if($this->query("DELETE FROM employee WHERE emp_id=?",[$id])){
           return true;
       }
   }
   public function edit_Data($id){
       if($this->query("SELECT * FROM employee WHERE emp_id=$id")){
           if($this->rowCount()>0){
               $row=$this->fetchall();
               return $row;
           }
       }
   }
   public function nav($emp_id){
       if($this->query("SELECT * FROM employee WHERE emp_id=$emp_id AND  designation_id IN (1,4)")){
           if($this->rowCount()>0){
               return true;
           }
       }
   }
}
?>
