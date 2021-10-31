<?php

$main=mysqli_connect("localhost","root","","mola") or die("Can not Connect to server");

if (isset($_GET['type'])) {

$type=$_GET['type'];
val();
}

if (isset($_POST['type'])) {
	pagehome();
$val=$_POST['type'];
}



function val(){
	global $main;
	$type=$_GET['type'];
$record_per_page = 1;
$page='';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;
$select="SELECT * FROM `posts` WHERE `category`='$type' order by id DESC LIMIT $start_from, $record_per_page";

$que=mysqli_query($main,$select);
while ($row=mysqli_fetch_array($que)) {
		$id=$row['id'];
		$category=$row['category'];
		$img=$row['img'];

$div="<div class='single_post'>
		<img src='img/$img'>
		
		<span id='category'>$category</span><br>
<button class='order_single'>Order</button>
	</div>";
echo $div;
}
}

function pagehome(){


 
global $page;
global $record_per_page;
global $main;
$val=$_POST["type"];
$page_query = "SELECT * FROM `posts` WHERE `category`='$val' ORDER BY id DESC";
    $page_result = mysqli_query($main, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/1);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 3)
    {
     $start_loop = $total_pages -1;
    }
    $end_loop = $total_pages;
    echo"<center>". "<div class='paginationdip'>"; 
    if($page > 1)
    {
    	
      
    }
    for($i=1; $i<=$end_loop; $i++)
    {     
    	
    echo "<button id='$i' class='$val'>".$i."</button>";
      
    }
    if($page <= $end_loop)
    {

      echo "</div>"."</center>";
    }
}










?>