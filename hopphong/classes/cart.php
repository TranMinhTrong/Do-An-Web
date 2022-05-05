<?php
      $filepath=realpath(dirname(__FILE__));
      include_once ($filepath.'/../lib/database.php');
      include_once ($filepath.'/../helper/format.php');
?>

<?php 
     class cart
     {
         private $db;
         private $fm; 

         public function __construct()
         {
             $this -> db = new Database();
             $this -> fm = new Format();
         }
         public function add_to_Cart($quantity,$id){
            $quantity = $this ->fm->validation($quantity); 
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);

            $sId= session_id();

            $query="SELECT * FROM tbl_product WHERE productid='$id'";
            $result=$this->db->select($query)->fetch_assoc();
            $image=$result["image"];
            $price=$result["price"];
            $productName=$result["productName"];

            // $check_cart= "SELECT * FROM tbl_cart WHERE productid='$id' and sessionid='$sId'";
            // if(isset($check_cart)){
            //     $mgs="<span class='error'>Sản phẩm đã có trong giỏ hàng của bạn</span>";
            //     return $mgs;
            // } 
            // else
            // {
                $query_insert = "INSERT INTO tbl_cart(productid,quantity,sessionid, price,image,productName) 
                VALUES('$id','$quantity','$sId','$price','$image','$productName')";

                $insert_cart = $this->db->insert($query_insert);
                
                if($insert_cart){
                   header('Location:cart.php');
                }
                else
                {
                    header('Location:404.php');  
                }
                // $mgs="<span class='success' style='color: green; font-size: 18px;'>Sản phẩm đã được thêm vào giỏ hàng</span>";
                // return $mgs;
            // }


         }
         public function get_product_cart(){
            $sId= session_id();
            $query="SELECT * FROM tbl_cart where sessionid= '$sId'";
            $result = $this->db->select($query);
            return $result;
         }

         public function update_soluong_Cart($quantity,$cartid){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);

            $query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartid='$cartid'";
            $result= $this->db->update($query);
            if($result){
                $msg="<span class='success' style='color: green; font-size: 18px;'>Cập nhật số lượng thành công</span>";
                return $msg;
            }else{
                $msg="<span class='error'>Cập nhật số lượng không thành công</span>";
                return $msg;
            }
         }
         //Xoa gio hang

         public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query="DELETE FROM tbl_cart where cartid ='$cartid' ";
            $result = $this->db->delete($query);
            if($result){
                header('Location :cart.php');

            }else{
                $msg="<span class='error'>Xoa san pham khong thanh cong</span>";
                return $msg;
            }
         }
         //Kiem tra su ton tai cua gio hang
         public function check_cart(){
            $sId= session_id();
            $query="SELECT * FROM tbl_cart where sessionid='$sId'";
            $result = $this->db->select($query);
            return $result;
         }

         public function check_order($customer_id){
            $sId= session_id();
            $query="SELECT * FROM tbl_order where cusid='$customer_id'";
            $result = $this->db->select($query);
            return $result;
         }
         public function del_all_cart(){
            $sId= session_id();
            $query="DELETE FROM tbl_cart where sessionid='$sId'";
            $result = $this->db->select($query);
            return $result;
         }

         public function insertOrder($customer_id){
             $sId=session_id();
             $query="SELECT * FROM tbl_cart WHERE sessionid='$sId'";
             $get_product=$this->db->select($query);
             if($get_product){
                 while($result = $get_product->fetch_assoc()){
                     $productId=$result['productid'];
                     $productName=$result['productName'];
                     $quantity=$result['quantity'];
                     $price=$result['price'] * $quantity;
                     $image=$result['image'];
                     $customer_id=$customer_id;
                     $query_order = "INSERT INTO tbl_order(productid,productName,cusid, quantity,price,image) 
                     VALUES('$productId','$productName','$customer_id','$quantity','$price','$image')";

                    $insert_order = $this->db->insert($query_order);
                 }
             }


         }
         public function getAmountPrice($customer_id){
       
             $query="SELECT price FROM tbl_order WHERE cusid='$customer_id'";
             $get_price=$this->db->select($query);
             return $get_price;

         }
         public function get_cart_ordered($customer_id){
            $query="SELECT * FROM tbl_order WHERE cusid='$customer_id'";
            $get_cart_ordered=$this->db->select($query);
            return $get_cart_ordered;
         }
         public function get_inbox_cart(){
            $query="SELECT * FROM tbl_order  ORDER BY date_order";
            $get_inbox_cart=$this->db->select($query);
            return $get_inbox_cart;
         }

         public function shifted($id, $time, $price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            // $query = "UPDATE tbl_order SET status=1 WHERE cartid='$cartid'";
            // $result= $this->db->update($query);
            // if($result){
            //     $msg="<span class='success' style='color: green; font-size: 18px;'>Cập nhật số lượng thành công</span>";
            //     return $msg;
            // }else{
            //     $msg="<span class='error'>Cập nhật số lượng không thành công</span>";
            //     return $msg;
            // }
         }
        
         
     }
     
?>