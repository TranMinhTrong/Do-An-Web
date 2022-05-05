<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'?>
<?php
	$brand = new brand();
	if(isset($_GET['delid'])){
		 $id = $_GET['delid'];
		 $delBrand= $brand ->del_brand($id);
	 }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thương hiệu</h2>
                <div class="block">  
				<?php
                if(isset($delBrand)){
                    echo $delBrand;
                }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên thương hiệu</th>
							<th>Chức năng</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_brand= $brand->show_brand();
							if($show_brand){
								$i = 0;
								while($result = $show_brand->fetch_assoc()){
									$i++;
						
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName'] ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandid']?>">Chỉnh sửa</a> ||
							 <a onclick="return confirm('Bạn có muôn xóa thương hiệu sản phẩm này không???')" href="?delid=<?php echo $result['brandid']?>">Xóa</a></td>
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

