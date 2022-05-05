<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location = '404.php'</script>";
     }
     else {
         $id = $_GET['proid'];
     }
	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		 $quantity=$_POST['quantity'];

		$addtoCart= $cart -> add_to_Cart($quantity,$id);
	} 
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
			$get_product_detals=$product->get_details($id);
			if($get_product_detals){
				while($result_details= $get_product_detals->fetch_assoc()){

			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt=" " />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result_details['productName'] ?> </h2>
						<p><?php echo $fm->textShorten($result_details['product_desc'], 100) ?></p>					
						<div class="price">
							<p>Price: <span><?php echo $result_details['price']." "."VND" ?></span></p>
							<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
							<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
								
							</form>	</br>
							<?php
									if(isset($addtoCart)){
										echo $addtoCart;
									}
								?>			
						</div>
					</div>
					<div class="product-desc">
						<h2> Mô tả <?php echo $result_details['productName'] ?></h2>
						<p><?php echo $result_details['product_desc'] ?></p>

					</div>
				
			</div>
			<?php
				 
				}
			}
			?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						 $getall_catagory=$cat->show_catagory_fontend();
						 if($getall_catagory){
							while($result_allcat= $getall_catagory->fetch_assoc()){

						
						?>
				     	 <li><a href="productbycat.php?catid=<?php echo $result_allcat['catid']?>"><?php echo $result_allcat['catName'] ?></a></li>
						<?php
							}
						}
						?>
    				</ul>
    	
 				</div>

 		</div>
 	</div>
<?php
	include 'inc/footer.php';
	
?>