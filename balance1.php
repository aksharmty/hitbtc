<?php
//delete row
include "connect.php"; 
$sqldel = "DELETE FROM trade WHERE quantity1  <= 0";

if ($connection->query($sqldel) === TRUE) {
    echo "Record deleted successfully";
 } else {
   echo "Error deleting record: " . $connection->error;
 }
?>
<?php
   $ch = curl_init('https://api.hitbtc.com/api/2/trading/balance'); 
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

		$fp = fopen('balance.json', 'w');
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
          $sql123 = "TRUNCATE TABLE balance  ";

if ($connection->query($sql123) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $connection->error;
} 
         $query = '';
          $table_data = '';
          $filename = "balance.json";
          $data = file_get_contents($filename); //Read the JSON file in PHP
          $array = json_decode($data, true); //Convert JSON String into PHP Array
          foreach($array as $row) //Extract the Array Values by using Foreach Loop
          {
          $query .= "INSERT INTO balance(currency, available,reserved) VALUES ('".$row["currency"]."', '".$row["available"]."','".$row["reserved"]."'); ";  // Make Multiple Insert Query 
           $table_data .= '
            <tr>
       <td>'.$row["currency"].'</td>
       <td>'.$row["available"].'</td>
       <td>'.$row["reserved"].'</td>
      </tr>
           '; //Data for display on Web page
          }
          if(mysqli_multi_query($connection, $query)) //Run Mutliple Insert Query
    {
     echo '<h3>Imported JSON Data</h3><br />';
     echo '
      <table class="table table-bordered">
        <tr>
         <th width="45%">currency</th>
         <th width="10%">available</th>
         <th width="45%">reserved</th>
        </tr>
     ';
     echo $table_data;  
     echo '</table>';
          }

$sql = "SELECT * FROM balance";
$result1 = $connection->query($sql);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Currency: " . $row["currency"]. " " . $row["available"]. " " . $row["reserved"]. "<br>";
    }
} else {
    echo "0 results";
}

?>


          ?>
     
 
