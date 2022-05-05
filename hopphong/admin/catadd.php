<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php' ?>
<?php
	$cat = new catagory();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$catName= $_POST['catName'];

		$insertcat= $cat -> insert_catagory($catName);
	}
?>
<?php ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>thêm danh mục</h2>

               <div class="block copyblock"> 
               <?php
                if(isset($insertcat)){
                    echo $insertcat;
                }
                ?>
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập tên loại sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>