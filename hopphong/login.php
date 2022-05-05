
<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	  $login_check=Session::get('customer_login');
	  if($login_check==true){
		  header('Location:profile.php');
	  }
?>
<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

		$insertcustomer= $cus -> insert_customer($_POST);
	}
?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

	$logincustomer= $cus -> login_customer($_POST);
}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Danh nhap he thong</h3>
			<?php 
				if(isset($logincustomer)){
					echo $logincustomer;
				}
			?>
				<form action="" method="POST">
					<input  type="text" name="cusEmail" class="field" placeholder="Email...">
					<input  type="password" name="cusPassword" class="field" placeholder="Password...">
				 
                	 <p class="note">Quên mật khẩu Click? <a href="#">tại đây</a></p>
                    <div class="buttons">
						<div><input type="submit" name="login" value="Đăng nhập" class="grey"/></div>
					</div>
				</form>
        </div>
    	<div class="register_account">
    		<h3 class="">Đăng ký tài khoản</h3>
			<?php 
				if(isset($insertcustomer)){
					echo $insertcustomer;
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="cusName" placeholder="Enter name..." />
								</div>							
								<div>
								<input type="text" name="cusCity" placeholder="Enter city..."/>
								</div>
								
								<div>
									<input type="text" name="cusZipCode" placeholder="Enter zip-code..."/>
								</div>
								<div>
									<input type="text" name="cusEmail" placeholder="Enter email...">
								</div>
							</td>
		    				<td>
								<div>
									<input type="text" name="cusAddress" placeholder="Enter address...."/>
								</div>
								<div>
									<select id="country" name="cusCountry" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>         									
										<option value="BD">Bangladesh</option>

									</select>
								</div>		        
			
								<div>
									<input type="text" name="cusPhone" placeholder="Enter phone..."/>
								</div>
						
								<div>
									<input type="password" name="cusPassword" placeholder="Enter password"/>
								</div>
							</td>
		    			</tr> 
		    	</tbody>
			</table> 
		   		<div class="search">
				   <div class="input-submit"><input type="submit" name="submit" value="Đăng Ký" class="grey"/></div>
				</div>
		    	<!-- <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p> -->
		    	<div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>


 <?php
	include 'inc/footer.php';
	
?>