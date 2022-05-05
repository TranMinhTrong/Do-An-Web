<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<div class="main">

    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bậc</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			  	$getproduct=$product->getproduct_feathered();
				  if($getproduct){
					  while($result=$getproduct->fetch_assoc()){
				
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="daitel.php?proid=<?php echo $result['productid']?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt=" " /></a>
					 <h2><?php echo $result['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],30) ?></p>
					 <p><span class="price"><?php echo $result['price']." "."VND" ?></span></p>
				     <div class="button"><span><a href="daitel.php?proid=<?php echo $result['productid']?>" class="details">Xem chi tiet</a></span></div>
				</div>
				<?php
				  }
				}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới </h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  	$getproduct=$product->getproduct_new();
				  if($getproduct){
					  while($result_new=$getproduct->fetch_assoc()){
					
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="daitel.php?proid=<?php echo $result_new['productid']?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt=" " height="200px" /></a>
					 <h2><?php echo $result_new['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'],50) ?></p>
					 <p><span class="price"><?php echo $result_new['price']." "."VND" ?></span></p>
				     <div class="button"><span><a href="daitel.php?proid=<?php echo $result_new['productid']?>" class="details">Xem chi tiet</a></span></div>
				</div>
				<?php
				  }
				}
				?>
			</div>
    </div>
 </div>


 <?php
	include 'inc/footer.php';
	
?>