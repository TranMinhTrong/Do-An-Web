<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customer_id=Session::get('cusid');
        $insertOrder= $cart->insertOrder($customer_id);
        $delCart=$cart->del_all_cart();
        header('Location:succusess.php');
     }

?>
<style>
   h2.success_order{
       text-align: center;
       color: green;
   }
   p.success_note{
       align-items: center;
       padding: 8px;
       font-size: 25px;
   }
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
            <h2 class="success_order">Đặt Hàng Thành Công</h2>  
            <?php 
                $customer_id=Session::get('cusid');
                $get_amount=$cart->getAmountPrice($customer_id);
                if($get_amount){
                    $amount = 0;
                    while($result = $get_amount->fetch_assoc()){
                        $price= $result['price'];
                        $amount += $price;
                    }
                }
            
            ?>
            <p class="success_note">Total price you have bought from My Website: 
                <?php 
                    $vat = $amount * 0.1; 
                    $total= $amount + $vat; 
                    echo $total.'VND' 
                ?>
             </p>
            <p class="success_note">We will contact as soon as possiable. Pleace see order details here
                 <a href="orderdetail.php">Click Here</a> </p>
 		</div>
 	</div>

</div>
</form>
<?php
	include 'inc/footer.php';
	
?>