<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'; ?>
<?php

    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location = 'brandlist.php'</script>";
    }
    else {
        $id = $_GET['brandid'];
    }
    
	$brand = new brand();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$brandName= $_POST['brandName'];

		$updateBrandName= $brand -> update_brand($brandName,$id);
	}
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục sản phẩm</h2>

               <div class="block copyblock"> 
               <?php
                if(isset($updateBrandName)){
                    echo $updateBrandName;
                }
                ?>
                <?php
                    $get_brand_name=$brand->getBrandbyId($id);
                    //Neu thanh cong
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                     
                    
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']?>" name="brandName" placeholder="Cập nhật thương hiệu sản phẩm..." class="medium" />
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