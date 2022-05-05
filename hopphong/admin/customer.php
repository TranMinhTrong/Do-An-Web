<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php' ;?>
<?php  
	$filepath=realpath(dirname(__FILE__));
      include_once ($filepath.'/../classes/customer.php');
	  include_once ($filepath.'/../helper/format.php');
?>
<?php

    if(!isset($_GET['cusid']) || $_GET['cusid']==NULL){
       echo "<script>window.location = 'inbox.php'</script>";
    }
    else {
        $id = $_GET['cusid'];
    }
    
	$cs = new customer();

?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục sản phẩm</h2>

               <div class="block copyblock"> 
              
                <?php
                    $get_customer=$cs->show_customer($id);
                    //Neu thanh cong
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                     
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusName']?>" name="cusName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusPhone']?>" name="cusPhone" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusEmail']?>" name="cusEmail" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusCity']?>" name="cusCity" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusCountry']?>" name="cusCountry" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Dia Chi</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['cusAdress']?>" name="cusAdress" class="medium" />
                            </td>
                        </tr>
                        
						<!-- <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Cập nhật" />
                            </td>
                        </tr> -->
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>