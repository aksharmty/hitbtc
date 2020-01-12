<?php
include("connect.php");

	?>
	<table width="80%" border="2" style= "background-color: #030ffc; color: #ffffff; margin: 0 auto;" >

              <tr align="center" class="title" bgcolor="#ffffff">
			  <th height="21" colspan="16" align="center" bgcolor="#030ffc"><span class="style2"><font size="4">WAITING FOR FUND</font></span> </th>
              </tr>
              
              <tr align="center" class="title">
               <th width="5%" align="center" bgcolor="#030ffc"><span class="style3">S.No</span></th>
	   		  <th width="10%" align="center" bgcolor="#030ffc"><span class="style3">ORDER ID</span></th>
	   		  <th width="10%" align="center" bgcolor="#030ffc"><span class="style3">SYMBOL</span></th>
              <th width="20%" align="center" bgcolor="#030ffc"><span class="style3">PRICE </span></th>
             <th width="20%" align="center" bgcolor="#030ffc"><span class="style3">SELLPRICE</span></th>
              <th width="10%" align="center" bgcolor="#030ffc"><span class="style3">QUANTITY</span></th>
              <th width="10%" align="center" bgcolor="#030ffc"><span class="style3">QUANTITY1</span></th>
              <th width="5%" align="center" bgcolor="#030ffc"><span class="style3">QUANTITY2</span></th>
              <th width="10%" align="center" bgcolor="#030ffc"><span class="style3">DATE</span></th>
                </tr>
              <?php
			  $rowsPerPage = 20;
				$pageNum = 1;
				if(isset($_GET['page']))
				{
					$pageNum = $_GET['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;
				
				$counter=($pageNum -1)*$rowsPerPage + 1;
				
							$query1 = mysqli_query($connection,"SELECT * FROM trade order by id desc LIMIT $offset, $rowsPerPage") or die("Query Fail #1");
							$response1 = mysqli_num_rows($query1);
							if($response1>0)
							{
								for($count=1;$count<=$response1;$count++)
								{
									$data = mysqli_fetch_array($query1);
									?>
             
              <tr class="data">
			  	<td width="5%" align="center"><?php echo $counter;?></td>
                <td width="10%" align="justify"><?php echo $data['id']; ?></td>
                <td width="10%" align="justify"><?php echo $data['symbol']; ?></td>
                <td width="20%" align="justify"><?php echo $data['price']; ?></td>
                <td width="20%" align="center"><?php echo $data['sellprice']; ?></td>
                <td width="10%" align="center"><?php echo $data['quantity']; ?></td>
                <td width="10%" align="center"><?php echo $data['quantity1']; ?></td>
                <td width="5%" align="center"><?php echo $data['quantity2']; ?></td>
                <td width="10%" align="center"><?php echo $data['date']; ?></td>
              </tr>
              <tr align="center" class="title"></tr>
              <?php
			  		$counter++;
								}
							}	
						?>
            </table>
	<center>
  <?php
  $resultpaging  = mysqli_query($connection,"SELECT * FROM trade order by id desc") or die('Error, query failed');
						$rows = mysqli_num_rows($resultpaging);
						$maxPage = ceil($rows/$rowsPerPage);
						$self = $_SERVER['PHP_SELF'];
						$nav  = '';
						for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= " $page "; 
							}
							else
							{
								$nav .= " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">$page</a> ";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">[Prev]</a> ";
							$first = " <a href=\"$self?page=1\" class=\"new\" style=\"color:#000000\">[First Page]</a>" ;
						} 
						else
						{
						   $prev  = '&nbsp;'; 
						   $first = '&nbsp;';
						}
						if ($pageNum < $maxPage)
						{
						   $page = $pageNum + 1;
						   $next = " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">[Next]</a> ";
						
						   $last = " <a href=\"$self?page=$maxPage\" class=\"new\" style=\"color:#000000\">[Last Page]</a> ";
						} 
						else
						{
						   $next = '&nbsp;';
						   $last = '&nbsp;';
						}
						echo "<tr><td align=\"center\" width=\"100%\"  style=\"color:#000000\"><strong>Page No: ".$first . $prev . "$pageNum of $maxPage" . $next . $last."</strong></td></tr>";
					
					  ?>

</center>
	</body>
	</html>
