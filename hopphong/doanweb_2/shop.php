<?php $page = 'PRODUCTS'; ?>
<?php require_once 'template/public/inc/header.php' ?>
<section id="advertisement">
	<div class="container">
		<img src="images/shop/advertisement.jpg" alt="" />
	</div>
</section>

<section>
	<?php
	$sql = mysqli_query($conn, "SELECT * FROM `products`");
	$nume_row = mysqli_num_rows($sql);
	$nume_page = ceil($nume_row / 6);
	if (isset($_GET['page'])) {
		$current_page = $_GET['page'];
	} else {
		$current_page = 1;
	}
	$offset = ($current_page - 1) * 6;
	?>
	<div class="container">
		<div class="row">
			<?php require_once 'template/public/inc/left-sidebar.php' ?>
			<div class="col-sm-9 padding-right">
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">Sản Phẩm Hiện Có</h2>
					<?php
					 if(isset($_GET['key'])) {
						$key = $_GET['key'];		    
					 } else {
						 $key = '';
					 }	
					$qr = mysqli_query($conn, "SELECT * FROM products WHERE name_product LIKE '%$key%' ORDER BY id_sp DESC LIMIT $offset,6");
					while ($row_pro = mysqli_fetch_assoc($qr)) {
						$replaceName = utf8ToLatin($row_pro['name_product']);
						$url = $replaceName.'-'.$row_pro['id_items'].'-'.'sp'.'-'.$row_pro['id_sp'].'.html';
					?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="admin/upload/<?php echo $row_pro['image'] ?>" alt="" />
										<h2><?php echo number_format($row_pro['price']) . ' VND' ?></h2>
										<p><?php echo $row_pro['name_product'] ?></p>
										<a href="cartxuly.php?id=<?php echo $row_pro['id_sp'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="<?php echo $url?>"><i class="fa fa-plus-square"></i>Chi Tiết Sản Phẩm</a></li>
									</ul>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
				<!--features_items-->

			</div>
		</div>
		<br>
		<br>
		<div class="col-sm-6" style="text-align: right;">
			<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
				<nav aria-label="...">
					<ul class="pagination">
						<?php
						if ($current_page > 1) {
							$previous = $current_page - 1;

						?>
							<li class="page-item">
								<a class="page-link" href="shop.php">Trang Trước</a>
							</li>
						<?php } ?>
						<?php
						$part = 1;
						$begin = $current_page - $part;
						if ($begin < 1) {
							$begin = 1;
						}
						$end = $current_page + $part;
						if ($end > $nume_page) {
							$end = $nume_page;
						}
						for ($i = $begin; $i <= $end; $i++) {
							$active = '';
							if ($i == $current_page) {
								$active = 'active';
							}
						?>
							<li class="page-item <?php echo $active ?>">
								<a class="page-link" href="shop.php?page=<?php echo $i ?>"><?php echo $i ?></a>
							</li>
						<?php
						}
						?>
						<?php
						if ($current_page < $nume_page) {
							$next = $current_page + 1;

						?>
							<li class="page-item">
								<a class="page-link" href="shop.php?page=<?php echo $next ?>">Trang Tiếp</a>
							</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>

</section>

<?php require_once 'template/public/inc/footer.php' ?>