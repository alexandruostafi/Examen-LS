<?php
session_start();

if ( isset( $_SESSION['username'] ) ) {

} else {
    header('Location: login.php');
}
?>

<html>
   
   <head>
      <title>Home</title>    
   </head>
   
<body>
      
      <h2>Home page</h2>
	  <p>Correct username and password.</p>
	  <p>Bine ai venit, <?php echo $_SESSION['username']; ?> <br></p>
	  <p>Click here to <a href = "logout.php" tite = "Logout">logout</a>.</p>
	  <table border="1">

   <tr>
      <th>ID</th>
	  <th>Nume</th>
      <th>Latitude</th>
      <th>Longitude</th>
   </tr>

<?php
$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
mysqli_select_db($conn, "pai");

$sql_read = "SELECT * FROM locatii";

$result = mysqli_query($conn, $sql_read);
if(! $result )
{
  die('Could not read data: ' . mysqli_error());
}

while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
        echo "<td>" .$row['ID']. "</td>";
		echo "<td>" .$row['Nume']. "</td>";
		echo "<td>" .$row['Latitudine']. "</td>";
		echo "<td>" .$row['Longitudine']. "</td>";
	echo "</tr>";
    } 
?>
</table>
<button onclick="window.location.href='map.php';" type="button">MAP</button>
<?php 
if ($_SESSION['type'] == "administrator"){
	echo "<form  method = \"post\">";
			echo "<label> Nume </label><br>";
			echo "<input type = \"text\" name = \"Nume\"> <br>";
			echo "<label> Latitudine </label><br>";
			echo "<input type = \"text\" name = \"Latitudine\" required> <br>";
			echo "<label> Longitudine </label><br>";
			echo "<input type = \"text\" name = \"Longitudine\" required> <br>";
			echo "<label> Culoare </label><br>";
			echo "<input type = \"text\" name = \"Culoare\" required> <br>";
			echo "<input type = \"submit\" name = \"Submit\">";
    echo "</form>";
	if (isset($_POST["Submit"]))
	{
	$sql_insert="INSERT INTO locatii (Nume, Latitudine, Longitudine, Culoare) VALUES ('".$_POST['Nume']."' ,".$_POST['Latitudine']. "," .$_POST['Longitudine']." ,'" .$_POST['Culoare']."' )";
	$retval = mysqli_query($conn, $sql_insert);
	if(! $retval )
	{
		echo "<p>Could not insert data</p>\n";
	}
	else{
		header("Refresh:0");
	}
}
}
else
{

}
?>
</body>
