<?php
$main=mysqli_connect("localhost","root","","mola") or die("Can not Connect to server");

if (isset($_GET['page'])) {
	fetchpost();
}



function fetchpost(){

	global $main;

$record_per_page = 10;
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
	$select="SELECT * FROM `posts` order by id DESC LIMIT $start_from, $record_per_page";
	$que=mysqli_query($main,$select);
	while ($row=mysqli_fetch_array($que)) {
		$id=$row['id'];
		$category=$row['category'];
		$img=$row['img'];

		

$div="<div class='single_post product' id='$id'>
		<div class='product_img'>
			<img src='img/$img'>
			<span id='category'>$category</span>
		</div>  
		
		<div class='product_button'><button class='order_single'>Order<i class='fa fa-shopping-cart'></i></button></div>
	</div>";
echo $div;
	}
}






function order_post(){
	global $main;
	require_once 'compress.php';
if (isset($_POST['Upload_order'])) {
	$name=$_POST['name'];
$phone=$_POST['phone'];
$type_order=$_POST['type_order'];
$small=$_POST['small'];
$medium=$_POST['medium'];
$larg=$_POST['larg'];
$deliveryDate=$_POST['deliveryDate'];

$target ="img/gallery/".basename($_FILES['image']['name']);
$image=$_FILES['image']['name'];

$ins="INSERT INTO `order_post`(`name`, `phone`, `type`, `small`, `medium`, `larg`, `img`, `deliveryDate`) VALUES ('$name','$phone','$type_order','$small','$medium','$larg','$image', '$deliveryDate')";

$qu=mysqli_query($main,$ins);
if ($qu  && compress($_FILES['image']['tmp_name'], $target,75) ) {
	echo("<script>alert('Order uploaded')</script>");
}else{
	echo("<script>alert('Order not uploaded')</script>");
}

}

}



function order_selected(){
	global $main;
if (isset($_POST['Upload_order_selected'])) {
	$name=$_POST['name'];
$phone=$_POST['phone'];
$small=$_POST['small'];
$medium=$_POST['medium'];
$larg=$_POST['larg'];
$pic_id=$_POST['picid'];
$deliveryDate=$_POST['deliveryDate'];

$ins="INSERT INTO `order_selected`(`name`, `phone`, `small`, `medium`, `larg`, `picture_id`, `deliveryDate`) VALUES ('$name','$phone','$small','$medium','$larg','$pic_id', '$deliveryDate')";

$qu=mysqli_query($main,$ins);
if ($qu) {
	echo("<script>alert('Order uploaded')</script>");
}else{
	echo("<script>alert('Order not uploaded')</script>");
}

}
}


function phone(){
	global $main;

	$sel="SELECT `phone` FROM `info`";
	$que=mysqli_query($main,$sel);
	$row=mysqli_fetch_array($que);

	$phone=$row['phone'];
	echo $phone;
}


function message(){
	global $main;
	if (isset($_POST['messagesub'])) {
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$message=$_POST['message'];
$ins="INSERT INTO `message`(`name`, `phone`, `massege`) VALUES('$name','$phone','$message')";
$que=mysqli_query($main,$ins);

if ($que) {
	echo "<script> alert('message sent!!') </script>";
}else{
	echo "<script> alert('message not sent!!') </script>";
	}
}
}
?>