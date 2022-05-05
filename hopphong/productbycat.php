<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
		echo "<script>window.location = '404.php'</script>";
	 }
	 else {
		 $id = $_GET['catid'];
	 }
	 
	//  if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// 	 $catName= $_POST['catName'];
 
	// 	 $updateCat= $cat -> update_catagory($catName,$id);
	//  }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php
			  $name_cat=$cat->get_name_by_cat($id);
			  if($name_cat){
				  while($resul_name=$name_cat->fetch_assoc()){

			  ?>
    		<div class="heading">

    		<h3>Catagory:<?php echo $resul_name['catName'] ?> </h3>
			
    		</div>
    		<div class="clear"></div>
			<?php
						
					}
				}
				?>
    	</div>
	      <div class="section group">
			  <?php
			  $productbycat=$cat->get_product_by_cat($id);
			  if($productbycat){
				  while($resul_product_cat=$productbycat->fetch_assoc()){

			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="daitel-3.php"><img src="admin/uploads/<?php echo $resul_product_cat['image'] ?>" alt="" width="200px" height="200px"/></a>
					 <h2><?php echo $resul_product_cat['productName'] ?> </h2>
					 <p><?php echo $fm->textShorten($resul_product_cat['product_desc'], 100) ?></p>
					 <p><span class="price"><?php echo $resul_product_cat['price'].' '.'VND' ?></span></p>
				     <div class="button"><span><a href="daitel.php?proid=<?php echo $resul_product_cat['productid'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
						
					}
				} 
				else
				{
					echo 'SẢN PHẨM NÀY ĐÃ HẾT HÀNG';
				}
				?>
			
			</div>

	
	
    </div>
 </div>
 <?php
	include 'inc/footer.php';
	
?>