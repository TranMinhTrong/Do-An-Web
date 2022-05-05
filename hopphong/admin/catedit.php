<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php' ?>
<?php

    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location = 'catlist.php'</script>";
    }
    else {
        $id = $_GET['catid'];
    }
    
	$cat = new catagory();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$catName= $_POST['catName'];

		$updateCat= $cat -> update_catagory($catName,$id);
	}
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục sản phẩm</h2>

               <div class="block copyblock"> 
               <?php
                if(isset($updateCat)){
                    echo $updateCat;
                }
                ?>
                <?php
                    $get_cate_name=$cat->getcatbyId($id);
                    //Neu thanh cong
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){
                     
                    
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName']?>" name="catName" placeholder="sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Cập nhật" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>