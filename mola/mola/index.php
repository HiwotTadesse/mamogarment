<?php
include 'php/php.php';

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
	
	<title></title>
</head>
<body>
<header>
<div class="logo"> <b>Mamo</b> </div>

        <div class="nav-bar" >
	<nav>
		<ul class="nav-menu">
		<li class="activeli"><a href="#home">Home</a></li>
		<li><a href="#footer">Contact Us</a></li>
		<li><a href="#New_Products">Products</a></li>
		<li><a href="#Collections">Collection</a></li>
		<li><span class="call"><i class= "fa fa-phone"></i><?php phone();?></span></li>

	</ul>
    </nav>
</div>
<div class="Order"><button>ORDER YOUR DESIGN</button></div>
</header>

<section class="cover_img">
	<div class="img_container"></div>
	<div class="top_text"> <center> <h1> MAMO GARMENT </h1> </center></div>
<div class="chategory">
<div><img src="img/1.jpg"></div>
<div><img src="img/2.jpg"></div>
<div><img src="img/2.jpg"></div>

</div>
</section>
<section class="some_products" id = "New_Products">
                <span class="header">Products On Sale</span>

<div class="post_container">
	<?php
fetchpost();
    ?>


</div>
 <?php

global $page;
global $record_per_page;

$page_query = "SELECT * FROM `posts` ORDER BY id DESC";
    $page_result = mysqli_query($main, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/10);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 3)
    {
     $start_loop = $total_pages -1;
    }
    $end_loop = $total_pages;
    echo"<center>". "<div class='pagination'>"; 
    if($page > 1)
    {
        
      
    }
    for($i=1; $i<=$end_loop; $i++)
    {     
       
    echo "<button id='$i' >".$i."</button>";
     
    }
    if($page <= $end_loop)
    {

      echo "</div>"."</center>";
    }
 ?>                       
</section>


        <section class="collection" id = "Collections">
                <span class="header">Collection</span>
                <div class ="box_container">
                        
                        <div class="cat_collection">
                            <div class="box_image choir" id="choir">
                                    <div class="bgd_img choir"></div>
                                
                            </div>
                            <div class="box_left">
                                <img src="img/2.jpg">
                                <span class="arrow"><i class="fa fa-chevron-right"></i></span>
                            </div>
                            <div class="box_right">
                                    <div class="box_title">choir Collection</div>
                            </div>
                    </div>
                    <div class="cat_collection">
                            <div class="box_image uniform" id="uniform">
                                        <div class="bgd_img uniform"></div>
                                    
                                </div>
                                <div class="box_left">
                                <img src="img/2.jpg">
                                <span class="arrow"><i class="fa fa-chevron-right"></i></span>
                            </div>
                            <div class="box_right">
                                        <div class="box_title"> uniform Collection</div>
                                </div>
                    </div>
                    <div class="cat_collection">
                        
                            <div class="box_image other" id="other">
                                        <div class="bgd_img other"></div>
                                </div>
                                <div class="box_left">
                                <img src="img/2.jpg">
                                <span class="arrow"><i class="fa fa-chevron-right"></i></span>
                            </div>
                            <div class="box_right">
                                        <div class="box_title"> Other Collection</div>
                                </div>
                            
                    </div>
                   
                </div>
        </section>
        <section class="footer" id="footer">
                <span class="header">Contact Information</span>
                <div class="fleft"><h1>Map</h1></div>
                <div class="fright">
                    <div class="info">
                        <center>Contact Information</center>
                    <div class="ficon"><span class="fa fa-phone"></span></div>	
                    <div class="infodetail"><?php phone();?><br>
                      
                        
            </div>
                    </div>
                    <div class="placeinfo">
                        <center>Location</center>
                    <div class="ficon"><span class="fa fa-map-marker"></span></div>
                    <div class="infodetail">	Ethiopia, Addis ababa <br>
                        cherkos<br>
            </div>
                    </div>
                    <div class="contact-message">
                        <?php message();?>
                        <center>Contact form</center>
                        <form method="post">
                            <input type="text" name="name" placeholder="your name"><br>
                            <input type="text" name="phone" placeholder="Your phone"><br>
                            <textarea placeholder="Message!!" name="message"></textarea>
                            <input type="submit" name="messagesub">
                        </form>
                    </div>
                </div>
                
            </section>

<section class="category_view">
<span class="fa fa-times" id="cloth_view"></span>
	<center><h1 id="title_view"></h1></center>
<div class="post_container" id="apply">
</div>

<div class="ph"></div>
</section>

<section class="order_view">
    <?php
order_post();
    ?>
    <span class="fa fa-times" id="cloth_order"></span>
        <center><h1>Order your custom design</h1></center>
<div class="form_div">
   <form method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name" required=""><br>
    <input type="text" name="phone" placeholder="phone" required=""><br>
    <center>type</center>
    <select name="type_order">
        
        <option value="choir">Choir</option>
        <option value="uniform">uniform</option>
        <option value="other">other</option>
    </select>
 <center><h4>select size</h4></center>
   small <input type="checkbox" name="small" class="small"> 
   medium <input type="checkbox" name="medium" class="medium"> 
   larg <input type="checkbox" name="larg" class="larg"> <br>
   <div class="small_view"> 
    <input type="text" name="small" placeholder="How many Small size" id="small">
    </div>
    <div class="medium_view"> 
    <input type="text" name="medium" placeholder="How many Medium size" id="medium">
    </div>
    <div class="larg_view"> 
    <input type="text" name="larg" placeholder="How many Larg size" id="larg">
    </div>
    <center><h4>choose Image</h4></center>
  <input type="file" name="image" id = "image" ><br>

  <center><h4>choose Date</h4></center>
  <input type="date" name="deliveryDate" ><br>
  <input type="submit" class = "submitQuery" name="Upload_order">  

</form> 

</div>

</section>


<section class="order_selected">
<?php
order_selected();

?>
    <span class="fa fa-times" id="cloth_orse"></span>
        <center><h1>Order Selected design</h1></center>
<div class="form_div">
<img src="" class="select_img">
<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name" required=""><br>
    <input type="text" name="phone" placeholder="phone" required=""><br>

 <center><h4>select size</h4></center>
   small <input type="checkbox" name="small" class="small_selected"> 
   medium <input type="checkbox" name="medium" class="medium_selected"> 
   larg <input type="checkbox" name="larg" class="larg_selected"> <br>
   <div class="small_view"> 
    <input type="text" name="small" placeholder="How many Small size" id="small_selected">
    </div>
    <div class="medium_view"> 
    <input type="text" name="medium" placeholder="How many Medium size" id="medium_selected">
    </div>
    <div class="larg_view"> 
    <input type="text" name="larg" placeholder="How many Larg size" id="larg_selected">
    </div>
    <center><h4>choose Date</h4></center>
  <input type="date" name="deliveryDate" ><br>
  <input type="hidden" name="picid" id="hiddeninput"><br>
  <input type="submit" name="Upload_order_selected">  

</form> 

</div>
</section>


</body>
</html>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>