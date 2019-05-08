<!--content area begins-->
		<div id="content" >
			<div>
				<img src="images/img.png" style="float:left; margin-left:-150px; width:80%; height:1000px;">
			</div>
			<div id="form2">
				<form action=" " method="post">
					<h2>Sign-up here</h2>
					<table>
						<tr>
							<td align="right">Name:</td>
							<td><input type="text" name="username" placeholder="username" required="required"></td>
						</tr>
						<tr>
							<td align="right">Password:</td>
							<td>
								<input type="password" name="password" placeholder="Password" required="required">
							</td>
						</tr>
						<tr>
							<td align="right">Email:</td>
							<td><input type="email" name="email" placeholder="abc@example.com" required="required">
							</td>
						</tr>
						<tr>
							<td align="right">County:</td>
							<td>
								<select name="county" required="required">
									<option selected="selected"> Choose County</option>
									<option>Nairobi</option>
									<option>Embu</option>
									<option>Mombasa</option>
									<option>Kisumu</option>
									<option>Nakuru</option>
									<option>Kisii</option>
									<option>Kakamega</option>
								</select>	
							</td>
						</tr>
						<tr>
							<td align="right">Gender:</td>
							<td>
								<select name="gender" required="required">
									<option selected="selected"> Choose Gender</option>
									<option>Male</option>
									<option>Female</option>
								</select>	
							</td>
						</tr>
						<tr>
							<td align="right">D.O.B:</td>
							<td>
								<input type="date" name="DOB">
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<button name="sign_up">Sign up</button>
							</td>
						</tr>
					</table>
				</form>
				<?php include("user_insert.php");?>
			</div>
		</div>
		<!--content area ends here-->