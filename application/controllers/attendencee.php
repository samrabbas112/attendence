<?php
class attendencee extends framework{
    public function __construct()
    {
        if(!$this->getSession('empid')){

//            $this->redirect('accountController/index');
        }
        $this->attendencemodal=$this->model("attendencemodal");
    }    public function index(){
       $this->view("attendence");
    }
    public function reports_attendence(){
        $this->view("reports_attendence");
    }
    public function view_attendence(){
        $this->view("view_attendence");
    }
    public function logout()
    {
       $this->destroy();
       $this->redirect("accountController");
    }
    public function addemployee(){
        $this->view("addemployee");
    }
    public function add_employee_select(){
        $str='';
       $result_select=$this->attendencemodal->add_employee_select();

           foreach ($result_select as $res){
               $str.='<option value="'.$res->emp_name.'">'.$res->emp_name.'</option>';
           }
          echo $str;
    }
    public function add_designation_select(){
        $str='';
        $result=$this->attendencemodal->add_designation_select();

        foreach ($result as $res){
            $str.='<option value="'.$res->designation_id.'">'.$res->designation_name.'</option>';
        }
        echo $str;
    }
    public function add_employee()
    {
        if(isset($_POST['submit'])){
            $employee_data = [
                'name' => $this->input('name'),
                'email' => $this->input('email'),
                'password' => $this->input('password'),
                'dept' => $this->input('dept'),
                'salary' => $this->input('salary'),
                'designation' => $this->input('designation'),
                'boss' => $this->input('boss'),
                'file' => $_FILES['file']['name'],
                'tmpfile'=>$_FILES['file']['tmp_name'],
                'email_error' => '',
                'password_error' => '',
                'dept_error' => '',
                'salary_error' => '',
                'name_error' => '',
                'file_error' => ''
            ];
//        echo $employee_data['file'];
//        $filetype=array('jpg','jpeg');
//        $folder='../../public/assets/img';
//        $filename =  $_FILES['file']['name'];
            $filename = preg_replace("/\s+/", "_", $employee_data['file']);
            $allowed_extension = array("jpeg", "png", "jpg");
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $filename = $filename . "_" . date("mjYHis") . "." . $file_ext;

            $path = '../../public/assets/img/' . $filename;
            $filetype = $_FILES['file']['type'];
            if (empty($employee_data['name'])) {
                $employee_data['name_error'] = 'Name is Required';
            }
            if (empty($employee_data['email'])) {
                $employee_data['email_error'] = 'Email is Required';
            }
            if (empty($employee_data['dept'])) {
                $employee_data['dept_error'] = 'Department is Required';
            }
            if (empty($employee_data['salary'])) {
                $employee_data['salary_error'] = 'Salary is Required';
            }
            if (empty($employee_data['password'])) {
                $employee_data['password_error'] = 'Password is REquired';
            } elseif (strlen($employee_data['password'] >= 5)) {
                $employee_data['password_error'] = 'Password Length should be greater than 5';
            }
            if (empty($filename)) {
                $employee_data['file_error'] = 'Enter file';
            }
//       if(in_array($file_ext,$allowed_extension)){
//           $employee_data['file_error']='File type is not correct';
//       }
            if (empty($employee_data['name_error']) && empty($employee_data['email_error']) && empty($employee_data['dept_error']) && empty($employee_data['salary_error']) && empty($employee_data['password_error']) && empty($employee_data['file_error'])) {
//         if(in_array($file_ext,$allowed_extension)){
                    move_uploaded_file($employee_data['tmpfile'], $path);
                    $data = [$employee_data['name'], $employee_data['dept'], $filename, $employee_data['designation'], $employee_data['salary'], $employee_data['email'], $employee_data['password'], $employee_data['boss']];
                    $result = $this->attendencemodal->add_employee($data);
                    echo $result;
                    if ($result) {
                        echo '<script>alert("done")</script>';
                        header('location:addemployee');
                    }
            } else {
                $this->view('addemployee', $employee_data);
            }
        }


    }
    public function view_employee(){
        $result=$this->attendencemodal->view_employee();
        $str='';
        foreach ($result as $res){
            $str.="<tr><td>".$res->emp_name."</td><td>".$res->boss."</td><td>".$res->designation_name."</td><td>".$res->attendence_time."</td><td>".$res->attendence_timeout."</td><td>".$res->attendence_date."</td><td>".$res->status."</td><td><a href='http://localhost/Attendence_System/attendencee/edit_employee?id=".$res->emp_id."'>Edit</a>|<a href='http://localhost/Attendence_System/attendencee/delete_employee?id=".$res->emp_id."'>Delete</a></td></tr>";
        }
        echo $str;
    }
    public function delete_employee(){
        $id=$this->input('id');
        $result=$this->attendencemodal->delete_employee($id);
        if($result){
            echo '<script>alert("Record is deleted")</script>';
//            $this->redirect("attendencee");
        }

    }
    public function edit_employee(){
        $id=$this->input('id');
        $result=$this->attendencemodal->edit_data($id);
          $res=[
            'name'=>$result->emp_name
          ];

        $data=[
            'data'=>$result
        ];
        print_r($data['data']);
//        var_dump($dataa['data']);
        $this->view('edit_employee',$data['data']);
    }
    public function nav(){
        $emp_id=$this->getSession('empid');
        $result=$this->attendencemodal->nav($emp_id);
        if($result){
            $this->view('navadmin');
        }
        else{
            $this->view('nav');
        }
    }
}
?>
