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

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Thong Tin Don hang Da dat</h2>
					
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình Ảnh</th>
								<th width="15%">Gia</th>
								<th width="10%">Số lượng</th>
                                <th width="15%">Ngay Dat</th>
                                <th width="20%">Status</th>
								<th width="15%">Xóa</th>
							</tr>
							<?php
                                $customer_id=Session::get('cusid');
								$get_cart_ordered =$cart->get_cart_ordered($customer_id);
								if($get_cart_ordered){
                                    $i=0;
									$qty=0;
									while($result=$get_cart_ordered->fetch_assoc()){
                                        $i++;

							?>
							<tr>
                                <td><?php echo $i ?> </td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=" " /></td>
								<td><?php echo $result['price']." "."VND"?></td>
								<td> <?php echo $result['quantity']?> </td>
                                <td> <?php echo $fm->formatDate($result['date_order'])?> </td>
                                <td>
                                    <?php
                                        if($result['status']=='0'){
                                            echo 'Dang xu ly';
                                        }else{
                                            echo "Da xu ly";
                                        }
                                    ?>
                                </td>
                                <?php
                                    if($result['status']=='0'){

                                ?>
                                    <td><?php echo 'N/A'; ?></td>
                                <?php

                                    }else{
                                   
                                ?>
								<td><a  onclick="return confirm('Bạn có muôn xóa sản phẩm này không???')" href="?cartid=<?php echo $result['cartid']?>">Xóa</a></td>
                                <?php
                                    }
                                ?>
							</tr>
							<?php
								
								}	
							}
							?>
							
						</table>
						
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