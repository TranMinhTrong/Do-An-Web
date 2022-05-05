<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php'?>
<?php
	$cat = new catagory();
	if(isset($_GET['delid'])){
		 $id = $_GET['delid'];
		 $delCat= $cat ->del_catagory($id);
	 }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách sản phẩm</h2>
                <div class="block">  
				<?php
                if(isset($delCat)){
                    echo $delCat;
                }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Loại sản phẩm</th>
							<th>Chức năng</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show_cat= $cat->show_catagory();
							if($show_cat){
								$i = 0;
								while($result = $show_cat->fetch_assoc()){
									$i++;
						
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catid']?>">Chỉnh sửa</a> ||
							 <a onclick="return confirm('Bạn có muôn xóa loại sản phẩm này không???')" href="?delid=<?php echo $result['catid']?>">Xóa</a></td>
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

