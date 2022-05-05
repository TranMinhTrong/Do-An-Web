<?php
    $filepath=realpath(dirname(__FILE__));
     include $filepath.'/../lib/session.php';

     Session::checkLogin();

     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helper/format.php');
?>

<?php 
     class adminlogin
     {
         private $db;
         private $fm; 

         public function __construct()
         {
             $this -> db = new Database();
             $this -> fm = new Format();
         }


         public function login_admin($adminUser, $adminPass)
         {
             $adminUser = $this ->fm->validation($adminUser);
             $adminPass = $this ->fm->validation($adminPass);
             

             $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
             $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

             if(empty($adminUser) || empty($adminUser)){
                 $aler="Không để trống UserName hoặc Mật khẩu";
                 return $aler;
             }
             else {
                 $query = "Select * from tbl_admin where adminUser ='$adminUser' and adminPass = '$adminPass' Limit 1";
                 $result = $this->db->select($query);

                 if($result != FALSE){
                     $value= $result ->fetch_assoc();
                     Session::set('adminlogin',true);
                     Session::set('adminid',$value['adminid']);
                     Session::set('adminUser',$value['adminUser']);
                     Session::set('adminName',$value['adminName']);
                     # dung den trang index
                     header('Location:index.php');
                 }
                 else{
                     $aler="Tài khoản hoặc mật khẩu không đúng";
                     return $aler;
                 }
             }
         }

         
         
     }
     
?>