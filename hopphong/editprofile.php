<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    $login_check=Session::get('customer_login');
    if($login_check==false){
        header('Location: login.php');
    }
   
?>
<?php
	// if(!isset($_GET['proid']) || $_GET['proid']==NULL){
    //     echo "<script>window.location = '404.php'</script>";
    //  }
    //  else {
    //      $id = $_GET['proid'];
    //  }
     $id= Session::get('cusid');
	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
       
		$updateCustomer= $cus -> update_customer($_POST,$id);
	} 
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profile Customer</h3>
                </div>
               
                <div class="clear"></div>
            </div>
			
            <form action="" method="post">
            <table class="tblone">
                <tr>
                    <td colspan="2">
                        <?php
                        if(isset($updateCustomer)){
                            echo '<td colspan="3">'.$updateCustomer.'</td>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                    $id= Session::get('cusid');
                    $get_customer = $cus->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){                   

                ?>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="cusName" value="<?php echo $result['cusName'] ?>"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" name="cusCity" value="<?php echo $result['cusCity'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="cusPhone" value="<?php echo $result['cusPhone'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><input type="text" name="cusCountry" value="<?php echo $result['cusCountry'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="cusAdress" value="<?php echo $result['cusAdress'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="cusEmail" value="<?php echo $result['cusEmail'] ?>"></td>
                        </tr>
            
                        <tr>
                            <td colspan="3"><input type="submit" name="save" value="save" ></td>
                        </tr>

                    </thead>
                <?php
                      
                    }
                }
                ?>
            </table>
            </form>
 		</div>
 	</div>
 </div>
<?php
	include 'inc/footer.php';
	
?>