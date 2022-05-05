<?php
      $filepath=realpath(dirname(__FILE__));
      include_once ($filepath.'/../lib/database.php');
      include_once ($filepath.'/../helper/format.php');
?>

<?php 
     class customer
     {
         private $db;
         private $fm;  

         public function __construct()
         {
             $this -> db = new Database();
             $this -> fm = new Format();
         }

         public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['cusName']);
            $city = mysqli_real_escape_string($this->db->link, $data['cusCity']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['cusZipCode']);
            $email = mysqli_real_escape_string($this->db->link, $data['cusEmail']);
            $address = mysqli_real_escape_string($this->db->link, $data['cusAddress']);
            $country = mysqli_real_escape_string($this->db->link, $data['cusCountry']);
            $phone = mysqli_real_escape_string($this->db->link, $data['cusPhone']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['cusPassword']));

            if($name =="" || $city=="" || $zipcode=="" || $email==""|| $address==""||$country=="" || $password==""){
                $aler="<span class='error'>Không để trống trường này</span>";
                return $aler;
            }
            else{
                $check_email="SELECT * FROM tbl_customer WHERE cusEmail='$email' Limit 1";
                $result_check=$this->db->select($check_email);
                if($result_check){
                    $alert="<span class='error'> Email da ton tai </span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_customer(cusName,cusCity,cusZipcode, cusEmail,cusAdress,cusCountry,cusPhone,cusPassword) 
                         VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
                 $result = $this->db->insert($query);
                 if($result){
                     $alert="<span class='success'>Đăng ký thành công</span>";
                     return $alert;
                 }
                 else
                 {
                    $alert="<span class='error'>Đăng ký thất bại</span>";
                     return $alert;   
                 }

                }
            }

         }
         public function login_customer($data){

            $email = mysqli_real_escape_string($this->db->link, $data['cusEmail']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['cusPassword']));
            
            if($email=='' || $password==''){
                $aler="<span class='error'>Password va Email khong duoc de trong</span>";
                return $aler;
            }
            else{
                $check_login="SELECT * FROM tbl_customer WHERE cusEmail='$email' AND cusPassword='$password'";
                $result_check=$this->db->select($check_login);
                if($result_check){
                    $value=$result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('cusid',$value['cusid']);
                    Session::set('customer_name',$value['cusName']);
                    header('Location:order.php');
                   
                }else{
                    $alert="<span class='error'> Email va password khong dung </span>";
                    return $alert;

                }
            }
         }

         public function show_customer($id){
             $query="SELECT * FROM tbl_customer WHERE cusid='$id' ";
             $result=$this->db->select($query);
             return $result;
         }

         public function update_customer($data,$id){
            $name = mysqli_real_escape_string($this->db->link, $data['cusName']);
            $city = mysqli_real_escape_string($this->db->link, $data['cusCity']);
            // $zipcode = mysqli_real_escape_string($this->db->link, $data['cusZipCode']);
            $email = mysqli_real_escape_string($this->db->link, $data['cusEmail']);
            $address = mysqli_real_escape_string($this->db->link, $data['cusAdress']);
            $country = mysqli_real_escape_string($this->db->link, $data['cusCountry']);
            $phone = mysqli_real_escape_string($this->db->link, $data['cusPhone']);

            if($name =="" || $city=="" || $email==""|| $address==""||$country=="" ){
                $aler="<span class='error'>Không để trống trường này</span>";
                return $aler;
            }
            else{
                    $query = "UPDATE tbl_customer SET cusName='$name',cusCity='$city', cusEmail='$email',
                    cusAdress='$address',cusCountry='$country',cusPhone='$phone' WHERE cusid='$id' ";
                    $result = $this->db->update($query);
                    if($result){
                        $alert="<span class='success'>Update thành công</span>";
                        return $alert;
                    }
                    else
                    {
                        $alert="<span class='error'>Update thất bại</span>";
                        return $alert;   
                    }

                }
            }
         }
     
?>