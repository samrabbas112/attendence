<?php

class accountController extends framework{
//    public function loginform(){
//        $this->view("attendence");
//    }
    public function __construct()
    {
//        if($this->getSession('empid')){
//            $this->redirect("attendencee");
//        }
//        $this->helper("link");
        $this->accountmodal=$this->model('accountmodal');

//
    }
    public function index(){
        $this->view("login");
    }

    public function createAccount(){
//        array of object
     $userData=[
         'email'=>$_POST['email'],
         'password'=>$_POST['password'],
         'emailerror' => '',
         'passworderror'=>'',
     ];
       $current_time=new DateTime('now', new DateTimeZone('Asia/Karachi'));
       $time=$current_time->format('h:i A');
       echo $time;
        if(empty($userData['email'])){
            $userData['emailError'] = "Email is required";
        }

        if(empty($userData['password'])){
            $userData['passwordError'] = "Password is required";
        }elseif (strlen($userData['password']>=5)){
            $userData['passwordError'] = "Password must be 5 character long";
        }

        if(empty($userData['emailError']) && empty($userData['passwordError'])){
            $result = $this->accountmodal->createAccount($userData['email'], $userData['password']);
                if ($result['status'] === 'emailNotFound') {
                    $userData['emailError'] = "Sorry invalid email";
                    $this->view("login", $userData);
//                } else if ($result['status'] === 'passwordNotMacthed') {
//                    $userData['passwordError'] = "Sorry invalid password";
//                    $this->view("login", $userData);
                } else if ($result['status'] === "ok") {
                    $this->setSession("empid", $result['data']);
                    $this->setSession('current_time',$time);
                    $this->redirect("attendencee");

                }

        } else {
            $this->view("login", $userData);
        }
    }
}
