<?php
     $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helper/format.php');
?>

<?php 
     class product
     {
         private $db;
         private $fm; 

         public function __construct()
         {
             $this -> db = new Database();
             $this -> fm = new Format();
         }


         public function insert_product($data,$files)
         {          
             $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
             $catagory = mysqli_real_escape_string($this->db->link, $data['catagory']);
             $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
             $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
             $price = mysqli_real_escape_string($this->db->link, $data['price']);
             $type = mysqli_real_escape_string($this->db->link, $data['type']);

             //kiem tra hinh anh va la hinh anh cho vao foder uploads
             $permited=array('jpg', 'jpeg', 'png', 'gif');
             $file_name=$_FILES['image']['name'];
             $file_size=$_FILES['image']['size'];
             $file_temp=$_FILES['image']['tmp_name'];

             $div=explode('.', $file_name);
             $file_ext=strtolower(end($div));
             $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
             $upload_image="uploads/".$unique_image;


             if($productName =="" || $product_desc=="" || $catagory=="" || $brand==""|| $price==""||$type=="" || $file_name==""){
                 $aler="<span class='error'>Không để trống trường này</span>";
                 return $aler;
             }
             else {
                 move_uploaded_file($file_temp,$upload_image);
                 $query = "INSERT INTO tbl_product(productName,catid,brandid, product_desc,type,price,image) 
                 VALUES('$productName','$catagory','$brand','$product_desc','$type','$price','$unique_image')";
                 $result = $this->db->insert($query);
                 if($result){
                     $alert="<span class='success'>Thêm sản phẩm thành công</span>";
                     return $alert;
                 }
                 else
                 {
                    $alert="<span class='error'>Thêm sản phẩm không thành công</span>";
                     return $alert;   
                 }

                
             }
         }
         public function show_product(){
             $query="SELECT pr.*, ca.catName, br.brandName FROM
             tbl_product as pr INNER JOIN tbl_catagory as ca on pr.catid=ca.catid
             INNER JOIN tbl_brand as br on pr.brandid=br.brandid 
              order by pr.productid desc";

             $result = $this->db->select($query);
             return $result;
         }

         public function update_product($data,$files,$id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
             $catagory = mysqli_real_escape_string($this->db->link, $data['catagory']);
             $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
             $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
             $price = mysqli_real_escape_string($this->db->link, $data['price']);
             $type = mysqli_real_escape_string($this->db->link, $data['type']);

              //kiem tra hinh anh va la hinh anh cho vao foder uploads
              $permited=array('jpg', 'jpeg', 'png', 'gif');
              $file_name=$_FILES['image']['name'];
              $file_size=$_FILES['image']['size'];
              $file_temp=$_FILES['image']['tmp_name'];
 
              $div=explode('.', $file_name);
              $file_ext=strtolower(end($div));//lay phan mo rong
              $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
              $upload_image="uploads/".$unique_image;
 

            if($productName =="" || $product_desc=="" || $catagory=="" || $brand==""|| $price==""||$type==""){
                $aler="<span class='error'>Không để trống trường này</span>";
                return $aler;
            }
            else{
                if(!empty($file_name)){
                    //Neu nguoi dung chon anh
                    if($file_size > 1048567){
                        $aler="<span class='success'>Ảnh đã vượt quá 1MB</span>";
                        return $aler;
                    }
                    elseif(in_array($file_ext, $permited)==false){

                        $aler="<span class='success'>Ban chi co the upload:-".implode(',',$permited)."</span>";
                        return $aler;
                    }
                    move_uploaded_file($file_temp,$upload_image);
                    $query = "UPDATE tbl_product SET productName='$productName', product_desc='$product_desc', brandid='$brand',
                     catid='$catagory', image='$unique_image', price='$price', type='$type' WHERE productid ='$id'";
                      $result = $this->db->update($query); 
                      if($result){
                          $aler="<span class='success'>Cập nhật sản phẩm thành công</span>";
                          return $aler;
                      }else{
                          $aler="<span class='error'>Cập nhật sản phẩm không thành công</span>";
                          return $aler;
                      }
                  
                }else{
                    //Neu nguoi dung khong chon anh
                   
                    $query = "UPDATE tbl_product SET
                     productName='$productName',
                     product_desc='$product_desc',
                     brandid='$brand',
                     catid='$catagory',
                     price='$price',
                     type='$type'
                     WHERE productid ='$id'";
                     $result = $this->db->update($query); 
                         if($result){
                             $aler="<span class='success'>Cập nhật sản phẩm thành công</span>";
                            return $aler;
                        }else{
                            $aler="<span class='error'>Cập nhật sản phẩm không thành công</span>";
                            return $aler;
                    }
                }
            }

        }
        public function del_product($id){
            $query="DELETE FROM tbl_product where productid ='$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert="<span class='success'>Xóa sản phẩm thành công</span>";
                return $alert;
            }else{
                $alert="<span class='success'>Xóa sản phẩm không thành công</span>";
                return $alert;
            }
        }

         public function getproductbyId($id){
            $query="SELECT * FROM tbl_product where productid ='$id' ";
            $result = $this->db->select($query);
            return $result;
         }  
         //ket thuc backend
         
         //start font end
         public function getproduct_feathered(){
            $query="SELECT * FROM tbl_product where type='1' ";
            $result = $this->db->select($query);
            return $result;
         }

         public function getproduct_new(){
            $query="SELECT * FROM tbl_product order by productid desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
         }
         public function get_details($id){
            $query="SELECT pr.*, ca.catName, br.brandName FROM
            tbl_product as pr INNER JOIN tbl_catagory as ca on pr.catid=ca.catid
            INNER JOIN tbl_brand as br on pr.brandid=br.brandid 
             WHERE pr.productid='$id'";

            $result = $this->db->select($query);
            return $result;

         }
         public function getLastDell(){
            $query="SELECT * FROM tbl_product WHERE brandid='6' order by productid desc limit 1";
            $result = $this->db->select($query);
            return $result;
         }
         public function getLastIPhone(){
            $query="SELECT * FROM tbl_product WHERE brandid='1' order by productid desc limit 1";
            $result = $this->db->select($query);
            return $result;
         }
         public function getLastSamSung(){
            $query="SELECT * FROM tbl_product WHERE brandid='4' order by productid desc limit 1";
            $result = $this->db->select($query);
            return $result;
         }
         public function getLastOppo(){
            $query="SELECT * FROM tbl_product WHERE brandid='6' order by productid desc limit 1";
            $result = $this->db->select($query);
            return $result;
         }
         
     }
     
?>