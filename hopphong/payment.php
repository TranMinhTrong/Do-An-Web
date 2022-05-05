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
<style>

         h3.payment{
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            text-decoration: underline;
            margin-bottom: 7px;
        }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Thanh Toan Gio Hang</h3>
                </div>
               
                
                <div class="clear"></div>
                <div class="shopping">
                    <h3 class="payment">Chọn phương thức thanh toán</h3>
						<div class="shopleft">
							<a  href="offlinepayment.php"> <img src="images/offline.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="onlinepayment.php"> <img src="images/online.png" alt="" /></a>
						</div>
                        <div style="text-align: center;">
                            <a href="cart.php" style="background: gray; font-size: 20px;"><< Quay lại</a>
                        </div>
				</div>
               
            </div>
			
 		</div>
 	</div>
 </div>
<?php
	include 'inc/footer.php';
	
?>