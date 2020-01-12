Order List<br>
<?php
//delete row
include "connect.php"; 
   $ch = curl_init('https://api.hitbtc.com/api/2/order?symbol=DOGEUSD'); 
 curl_setopt($ch, CURLOPT_USERPWD, 'api_key : secret_key'); // API AND KEY
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
 $return = curl_exec($ch); 
  curl_close($ch); 
 //print_r($return);
// $data = json_decode(file_get_contents($ch), true);
if (time()-filemtime($url) > 10) { // file older than 20 minutes

		$json = file_get_contents($return, true); //getting the file content
		$decode = json_decode($return, true); //getting the file content as array

		$fp = fopen('order.json', 'w');
		fwrite($fp, json_encode($decode));
		fclose($fp);

	echo $json;

	} else {
	  // file younger than 20 minutes
		$json = file_get_contents($url);
		// echo the JSON
		echo $json;
	}
	?>
	
        <div class="container box">
          <h3 align="center">Import JSON File Data into Mysql Database in PHP</h3><br />
          <?php
          $sql123 = "TRUNCATE TABLE orderslist  ";

if ($connection->query($sql123) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $connection->error;
} 
         $query = '';
          $table_data = '';
          $filename = "order.json";
          $data = file_get_contents($filename); //Read the JSON file in PHP
          $array = json_decode($data, true); //Convert JSON String into PHP Array
          foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {
          //$query .= "UPDATE balance SET currency = ('".$row["currency"]."'),  available = ('".$row["available"]."'),,reserved = ('".$row["reserved"]."'); ";
          $query .= "INSERT INTO orderslist(clientOrderId,symbol,side,status,price,type,quantity,createdAt,updatedAt) VALUES ('".$row["clientOrderId"]."',
          '".$row["symbol"]."','".$row["side"]."','".$row["status"]."','".$row["price"]."','".$row["type"]."','".$row["quantity"]."','".$row["createdAt"]."','".$row["updatedAt"]."'); ";  // Make Multiple Insert Query 
          
          }
          if(mysqli_multi_query($connection, $query)) //Run Mutliple Insert Query
    

?>
