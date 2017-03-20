<?php
include_once("init.php");

$file=$_POST['data'];
if($file=="viewsales")
{
	$tablename='stock_sales';
}

else if($file=="viewcustomers")
{
	$tablename='customer_details';
}
else if($file=="viewpurchase")
{
	$tablename='stock_entries';
}

else if($file=="viewsupplier")
{
	$tablename='supplier_details';
}
else if($file=="viewproduct")
{
	$tablename='stock_details';
}


	//$db->execute("INSERT INTO stock_sales(transactionid)VALUES('$tablename')");
	//$data=$_POST['data'];
	

	//$db->execute("INSERT INTO stock_sales(	transactionid)VALUES('$d')");
//$db->execute("DELETE FROM stock_sales WHERE id='$d'");
  
  $db->execute("TRUNCATE TABLE ".$tablename);
  
	
	
//$db->execute("DELETE FROM stock_details WHERE id='$id'");




?>
