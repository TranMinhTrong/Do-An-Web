<?php
      $filepath=realpath(dirname(__FILE__));
      include_once ($filepath.'/../lib/database.php');
      include_once ($filepath.'/../helper/format.php');
?>

<?php 
     class catagory
     {
         private $db;
         private $fm; 

         public function __construct()
         {
             $this -> db = new Database();
             $this -> fm = new Format();
         }


         public function insert_catagory($catName)
         {
             $catName = $this ->fm->validation($catName);           
             
             $catName = mysqli_real_escape_string($this->db->link, $catName);

             if(empty($catName)){
                 $aler="<span class='error'>Loại sản phẩm không được để trống</span>";
                 return $aler;
             }
             else {
                 $query = "INSERT INTO tbl_catagory(catName) VALUES('$catName')";
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
         public function show_catagory(){
             $query="SELECT * FROM tbl_catagory order by catid desc";
             $result = $this->db->select($query);
             return $result;
         }
         public function show_brand(){
            $query="SELECT * FROM tbl_brand order by brandid desc";
            $result = $this->db->select($query);
            return $result;
        }

         public function update_catagory($catName,$id){
            $catName = $this ->fm->validation($catName);                       
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)){
                $aler="<span class='error'>Loại sản phẩm không được để trống</span>";
                return $aler;
            }
            else {
                $query = "UPDATE tbl_catagory SET catName= '$catName' where catid ='$id'";
                $result = $this->db->update($query); 
                if($result){
                    $alert="<span class='success'>Cập nhật sản phẩm thành công</span>";
                    return $alert;
                }
                else
                {
                   $alert="<span class='error'>Cập nhật sản phẩm không thành công</span>";
                    return $alert;   
                }

               
            }

        }
        public function del_catagory($id){
            $query="DELETE FROM tbl_catagory where catid ='$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert="<span class='success'>Xoa thanh cong</span>";
                return $alert;
            }else{
                $alert="<span class='success'>Xoa khong thanh cong</span>";
                return $alert;
            }
        }

         public function getcatbyId($id){
            $query="SELECT * FROM tbl_catagory where catid ='$id' ";
            $result = $this->db->select($query);
            return $result;
         }
         public function show_catagory_fontend(){
            $query="SELECT * FROM tbl_catagory order by catid desc";
            $result = $this->db->select($query);
            return $result;
        }
    
        public function get_product_by_cat($id){
            $query="SELECT * FROM tbl_product WHERE catid='$id' order by catid desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }
        public function  get_name_by_cat($id){
            $query="SELECT pr.*, ca.catName, ca.catid FROM tbl_product as pr inner join tbl_catagory as ca
             WHERE pr.catid= ca.catid AND pr.catid='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }


         
     }
     
?>