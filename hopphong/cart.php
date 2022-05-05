<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['cartid'])){
		$cartid = $_GET['cartid'];
		$delcart= $cart ->del_product_cart($cartid);
	}
	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		 $cartid=$_POST['cartid'];
		 $quantity=$_POST['quantity'];
		 $update_quantity_cart= $cart -> update_soluong_Cart($quantity,$cartid);

		if($quantity<=0){
			$delcart= $cart ->del_product_cart($cartid);
		}
	}
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ hàng của bạn</h2>
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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình Ảnh</th>
								<th width="15%">Gia</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Xóa</th>
							</tr>
							<?php
								$get_product_cart =$cart->get_product_cart();
								if($get_product_cart){
									$subtotal=0;
									$qty=0;
									$vat=5;
									while($result=$get_product_cart->fetch_assoc()){

							?>
							<tr>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=" " /></td>
								<td><?php echo $result['price']." "."VND"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartid" value="<?php echo $result['cartid'] ?>" />
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php 
										$total = $result['price']* $result['quantity'];
										echo $total?>
									</td>
								<td><a  onclick="return confirm('Bạn có muôn xóa sản phẩm này không???')" href="?cartid=<?php echo $result['cartid']?>">Xóa</a></td>
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
						<table style="float:right;text-align:left;" width="40%">
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
								<td><?php echo $vat." "."%" ?></td>
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
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
	
?>