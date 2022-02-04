<?php
class accountmodal extends database{
    public function checkmail($email){
        if($this->query("SELECT email FROM employee WHERE email=?",[$email])){
            if($this->rowCount() > 0 ){
                return false;
            } else {
                return true;
            }
        }
    }
    public function createAccount($email,$password){
          echo $password;
        if($this->query("SELECT * FROM employee WHERE email = ? ", [$email])){

            if($this->rowCount() > 0 ){

                $row = $this->fetch();
                print_r($row);
                $dbPassword = $row->password;
                $empid = $row->emp_id;
//                if(password_verify($password, $dbPassword)){

                    return ['status' => 'ok', 'data' => $empid];

//                } else {
//
//                    return ['status' => 'passwordNotMacthed'];
//                }

            } else {
                return ['status' => 'emailNotFound'];
            }
        }

    }
}
