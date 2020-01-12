<?php
include "connect.php";
//bid-ask price
$url = "https://api.hitbtc.com/api/2/public/ticker/DOGEUSD";
$dataDOGEUSD = json_decode(file_get_contents($url), true);
$symbol=$dataDOGEUSD['symbol'];
$bid=$dataDOGEUSD['bid'];
$ask=$dataDOGEUSD['ask'];

echo "bid : "; echo $bid; echo "<br>"; 
echo "ask :"; echo  $ask; echo "<br>";
//sellprice
$sellprice1=$bid*3/1000; $sellprice2=$bid+$sellprice1;
$sellprice=number_format($sellprice2,11); 

echo "buy :";  echo $bid; echo "<br>";
echo "sell price :"; echo $sellprice; echo "<br>";

//BALANCE
$sqlbal = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM balance where currency='USD' AND available >= 0.0219493"));
$id= $sqlbal['id'];
$currency=$sqlbal['currency'];
$available=$sqlbal['available'];
$reserved=$sqlbal['reserved'];
//
echo "S.no ". $id; echo "<br>"; echo "Symbol ". $currency; echo "<br>"; echo "available ". $available; echo "<br>"; echo "reserved ". $reserved; echo "<br>";
?>
<?php
$quantity0=$available/$bid; $quantity1=$quantity0/10;
$quantity3 =floor($quantity0 / 10) * 10;
$quantity2=number_format($quantity3,0);
        echo "my quantity : "; echo $quantity0; echo "<br>";
        echo "my quantity2 price : "; echo $quantity2; echo "<br>";
        echo "my quantity3 price : "; echo $quantity3; echo "<br>";
                ?>


<?php
$sqlbal1 = "SELECT * FROM balance where currency='USD' AND available >= 0.0219493";
$result123 = $connection->query($sqlbal1);
if ($result123->num_rows > 0) {
    // output data of each row
    while($row = $result123->fetch_assoc()) {
        
       echo "id: " . $row["id"]. " - Name: " . $row["currency"]. " -available " . $row["available"]." -reserved" .$row["reserved"]. "<br>";
       //echo "S.no ". $id; echo "<br>"; echo "Symbol ". $currency; echo "<br>"; echo "available ". $available; echo "<br>"; echo "reserved ". $reserved; echo "<br>";
 
//order on
$symbol = DOGEUSD;
$side = buy;
$type = limit;
$price=$bid;
$quantity=$quantity2;
$timeInForce= GTC; 
$date = Date("Y-m-d H:i:s");

$ch = curl_init();
//do a post
curl_setopt($ch,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch, CURLOPT_USERPWD, 'api_key : secret_key'); // API AND KEY 
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"symbol=$symbol&side=$side&price=$price&quantity=$quantity&type=$type&timeInForce=$timeInForce");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result);
echo"<pre>";
print_r($result);
//order end



    }
} else {
    echo "0 results123";
}
?>
//insert order details
<?php
$sqlupd = "SELECT * FROM balance where currency='USD' AND available >= 0.0219493 ";
$resultupd = $connection->query($sqlupd);
if ($resultupd->num_rows > 0) {
    // output data of each row
    while($rowupd = $resultupd->fetch_assoc()) {

$sql ="INSERT INTO trade (symbol,price,sellprice,side,type,quantity,quantity1,quantity2,date) VALUES('$symbol', '$price','$sellprice','$side','$type','$quantity','$quantity','0','$date')";
if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

    }
} else {
    echo "0 results balance low";
}
?>
////////////sell order code ////////////////

<?php
include "connect.php";
//delete row
//$sqldel = "DELETE FROM trade WHERE quantity1  <= 0";

//if ($connection->query($sqldel) === TRUE) {
 //   echo "Record deleted successfully";
 //} else {
  // echo "Error deleting record: " . $connection->error; 
 //}
//TRADE TABLE
//$sql = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM trade order by id asc limit 1"));
$sqlsell = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM trade where symbol='DOGEUSD' order by price desc limit 1"));
$idsell= $sqlsell['id'];
$symbolsell= $sqlsell['symbol'];
$pricesell= $sqlsell['price'];
$sidesell= $sqlsell['side'];
$typesell= $sqlsell['type'];
$quantitysell= $sqlsell['quantity'];
$quantity1sell= $sqlsell['quantity1'];
$quantity2sell= $sqlsell['quantity2'];
$sellpricesell= $sqlsell['sellprice'];
?>
<?php 
        echo "S.no : ".  $idsell; echo "<br>";
        echo "symbol : ".  $symbolsell; echo"<br>"; 
        echo "price : ". $pricesell; echo"<br>";
        echo "side : ".  $sidesell; echo"<br>";
        echo "type  : ".  $typesell; echo"<br>";
        echo "quantity : ".  $quantitysell; echo"<br>";
        echo "quantity1 : ".  $quantity1sell; echo"<br>";
        echo "quantity2 : ".  $quantity2sell; echo"<br>";
        echo "sellprice : ".  $sellpricesell; echo"<br>";
        
        ?>
       
<?php 
//$quantity1update=$quantity1-$available;
$quantity1update=$quantity1sell-$quantity1sell;
//$quantity2update=$quantity2+$available;
$quantity2update=$quantity2sell+$quantity1sell;?>
<?php echo $quantity1update; echo "<br> quantity2"; echo $quantity2update; echo "<br>"; ?>
<?php
$sqlbal1sell = "SELECT * FROM balance where currency='DOGE' AND available >= 10 ";
$result123sell = $connection->query($sqlbal1sell);
if ($result123sell->num_rows > 0) {
    // output data of each row
    while($rowsell = $result123sell->fetch_assoc()) {
        
       echo "id: " . $rowsell["id"]. " - Name: " . $rowsell["currency"]. " -available " . $rowsell["available"]." -reserved" .$rowsell["reserved"]. "<br>";
       //echo "S.no ". $id; echo "<br>"; echo "Symbol ". $currency; echo "<br>"; echo "available ". $available; echo "<br>"; echo "reserved ". $reserved; echo "<br>";
 
//order on
$symbolsell = DOGEUSD;
$sidesell = sell;
$typesell = limit;
$pricesell=$sellpricesell;
$quantitysell=$quantity1sell;
$timeInForcesell= GTC; 

$ch1 = curl_init();
//do a post
curl_setopt($ch1,CURLOPT_URL,"https://api.hitbtc.com/api/2/order");
curl_setopt($ch1, CURLOPT_USERPWD, 'api_key : secret_key'); // API AND KEY 
curl_setopt($ch1, CURLOPT_POST,1);
curl_setopt($ch1,CURLOPT_POSTFIELDS,"symbol=$symbolsell&side=$sidesell&price=$pricesell&quantity=$quantitysell&type=$typesell&timeInForce=$timeInForcesell");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$resultsell=curl_exec($ch1);
curl_close($ch1);
$resultsell=json_decode($resultsell);
echo"<pre>";
print_r($resultsell); 

//order end



    }
} else {
    echo "0 DOGEUSD sell order place doge balance low";
}
?>
//update trade table
<?php
$sqlupd = "SELECT * FROM balance where currency='DOGE' AND available >= 10 ";
$resultupd = $connection->query($sqlupd);
if ($resultupd->num_rows > 0) {
    // output data of each row
    while($rowupd = $resultupd->fetch_assoc()) {
       // $sql3 ="UPDATE trade SET quantity1='$quantity1update' , quantity2='$quantity2update' WHERE id='$id' ";
        $sql3 ="UPDATE trade SET quantity1='$quantity1update' , quantity2='$quantity2update' WHERE id='$idsell' ";
if ($connection->query($sql3) === TRUE) {
    echo "DOGEUSD record updated successfully";
} else {
    echo "Error: " . $sql3 . "<br>" . $connection->error;
}

    }
} else {
    echo "0 DOGEUSD balance low";
}
?>