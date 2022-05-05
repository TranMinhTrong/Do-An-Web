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
    .box-left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 10px;
    }
    .box-right{
        width: 43%;
        border: 1px solid #666;
        float: right;
        padding: 10px;
    }
    .payment{
        text-align:left;
        align-items: center; 
        float: right; 
        border: none;
        padding: 15px;
    }
    .submit_order{
        font-size: 25px;
        color: white;
        text-align: center;
        padding: 10px 40px;
        border: none;
        background: red;
        border-radius: 5%;
        margin-bottom: 10px;
        cursor: pointer;

    }
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="heading">
                    <h3>Thông tin thanh toán giỏ hàng</h3>
                </div>
            <div class="clear"></div>
            <div class="box-left">
            <div class="cartpage">
			    	<!-- <h2>Giỏ hàng của bạn</h2> -->
					<?php 
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php 
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<!-- <th width="10%">Hình Ảnh</th> -->
								<th width="15%">Gia</th>
								<th width="15%">Số lượng</th>
								<th width="30%">Tổng giá</th>
								<!-- <th width="10%">Xóa</th> -->
							</tr>
							<?php
								$get_product_cart =$cart->get_product_cart();
								if($get_product_cart){
									$subtotal=0;
									$qty=0;
									$vat=5;
                                    $i=0;
									while($result=$get_product_cart->fetch_assoc()){
                                        $i++;

							?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName']?></td>
								<!-- <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=" " /></td> -->
								<td><?php echo $result['price']." "."VND"?></td>
								<td>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
									
								</td>
								<td><?php 
										$total = $result['price']* $result['quantity'];
										echo $total?>
									</td>
								<!-- <td><a  onclick="return confirm('Bạn có muôn xóa sản phẩm này không???')" href="?cartid=<?php echo $result['cartid']?>">Xóa</a></td> -->
							</tr>
							<?php
								$subtotal+=$total;
								$qty=$qty+$result['quantity'];
								}	
							}
							?>
							
						</table>
						<?php
							$check_cart=$cart->check_cart();
							if($check_cart){
								
						?>
						<table class="payment" width="40%">
							<tr>
								<th>Tổng tiền : </th>
								<td>
									<?php 										
										echo $subtotal." "."VND";
										Session::set("sum",$subtotal);
										Session::set("qty",$qty);
									?>
								</td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td><?php echo $vat." "."%"?></td>
							</tr>
							<tr>
								<th>Tổng tiền cần thanh toán :</th>
								<td>
									<?php $vat_t = $subtotal*$vat/100;
										  $gtotal=$subtotal+$vat_t ;
										  echo $gtotal." "."VND";
									?>
								</td>
							</tr>
					   </table>
					   <?php
					   }else{
						   echo "Giỏi hàng của bạn trống - <span> Shopping Now </span>";
					   }
					   ?>
					</div>
            </div>
            <div class="box-right">
                <div class="heading">
                        <h3>Thông tin giao hàng</h3>
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
     <center> <a class="submit_order" href="?orderid=order">Đặt Hàng</a></center><br>

</div>
</form>
<?php
	include 'inc/footer.php';
	
?>