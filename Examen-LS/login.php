<?php
   session_id("mainID");
   session_start();
?>

<html>
   
   <head>
      <title>Login</title>    
   </head>
	
   <body>
      
      <h2>Login form</h2> 
         
         <?php
			$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
			mysqli_select_db($conn, "users");
			$sql_read = "SELECT * FROM login";

			$result = mysqli_query($conn, $sql_read);
			if(! $result )
			{
				die('Could not read data: ' . mysqli_error());
			}
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				while($row = mysqli_fetch_array($result)) {
					$username = $row['usernames'];
					$password = $row['passwords'];
					if ($_POST['username'] == $username && $_POST['password'] == $password) {
						$_SESSION['valid'] = true;
						$_SESSION['timeout'] = time();
						$_SESSION['username'] = $row['usernames'];
						$_SESSION['type'] = $row['user_type'];
						header('Location: home.php');
					}  
					else {
						
				}
                }
				echo 'Wrong username or password';
               }
            
         ?>
      
      
      <div>
      
         <form  method = "post">
             <label> Username </label><br>
            <input type = "text" name = "username"><br>
			<label> Password </label><br>
            <input type = "password" name = "password" required> <br>
            <button type = "submit" name = "login">Login</button>
          </form>
       </div>
         
       
      
   </body>
</html>
