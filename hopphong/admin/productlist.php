<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php'; ?>
<?php include_once '../classes/catagory.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
	$pd=new product();
	$fm= new Format();
	if(isset($_GET['productid'])){
		$id = $_GET['productid'];
		$delproduct= $pd ->del_product($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh mục sản phẩm</h2>
        <div class="block">  
			<?php
			if(isset($delproduct)){
				echo $delproduct;
			}
			?>

            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Loại sản phẩm</th>
					<th>Thương hiệu</th>
					<th>Giá</th>
					<th>Hình ảnh</th>
					<th>Mô tả</th>
					<th>Type</th>
					<!-- <th>Chuc nang</th> -->
					<th>Chức năng</th>
				</tr>
			</thead>
			<tbody>
				<?php 

					$pdlist= $pd-> show_product();
					if($pdlist){
						$i=0;
						while($result=$pdlist->fetch_assoc()){
							$i++;

					
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="50px" height="50px"/></td>
					<td><?php echo $fm->textShorten($result['product_desc'], 10) ?></td>
					<td>
						<?php 
							if($result['type']==0){
								echo "Sản phẩm thuong";
							}
							else echo "Sản phẩm nổi bậc";
						 ?>
					</td>
					<!-- <td class="center"> 4</td> -->
					<td><a href="productedit.php?productid=<?php echo $result['productid'] ?>">Chỉnh sửa</a> || 
					<a onclick="return confirm('Bạn có muôn xóa loại sản phẩm này không???')" href="?productid=<?php echo $result['productid']?>">Xóa</a></td>
				</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
