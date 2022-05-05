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
	// // if(!isset($_GET['proid']) || $_GET['proid']==NULL){
    // //     echo "<script>window.location = '404.php'</script>";
    // //  }
    // //  else {
    // //      $id = $_GET['proid'];
    // //  }
    //  $id= Session::get('customer_id');
	//  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
       
	// 	$updateCustomer= $cus -> update_customer($_POST,$id);
	// } 
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>Thông tin khách hàng</h3>
                </div>
                <div class="clear"></div>
            </div>
			
            <table class="tblone">
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
                            <td><?php echo $result['cusName'] ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $result['cusCity'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['cusPhone'] ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?php echo $result['cusCountry'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['cusEmail'] ?></td>
                        </tr>
            
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                        </tr>

                    </thead>
                <?php
                      
                    }
                }
                ?>
            </table>
 		</div>
 	</div>
 </div>
<?php
	include 'inc/footer.php';
	
?>