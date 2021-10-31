<?php
$main=mysqli_connect("localhost","root","","mola") or die("Can not Connect to server");

include '../php/compress.php';

function createPost(){


    global $main;

    $category=$_POST['type'];
    $originalImage = 
    $target ="../img/".basename($_FILES['image']['name']);        
    $image=$_FILES['image']['name'];
    if (isset($_POST['post'])) {

            
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if($check !== false) {
                $insert="INSERT INTO posts (category, img) VALUES ('$category',  '$image')";

                $inserted = mysqli_query($main, $insert);
                if($inserted &&  compress($_FILES['image']['tmp_name'], $target,75) ){
                    echo("<script>alert('Order uploaded')</script>");
                }else{
                    echo("<script>alert('Order not uploaded')</script>");
                }
            } else {
               
                    echo("<script>alert('Order not uploaded')</script>");
            }
            
            
}
}


function updatePost(){
    global $main;

    if (isset($_POST['update'])) {
           
            $id=$_POST['hiddenId']; 
            
            $old_image = $_POST['hiddenIdImaage'];

            $category = $_POST["category"];  

            $target ="../img/".basename($_FILES['image1']['name']);        
            $image1=$_FILES['image1']['name'];
            
         if(!file_exists($target) ){

            
                unlink("../img/$old_image");

                $update="UPDATE posts SET category = '$category' , img = '$image1' WHERE id = $id";
                
                compress($_FILES['image1']['tmp_name'], $target,75) ;

                $updated = mysqli_query($main, $update);
                if($updated){
                    echo("<script>alert('Upload Updated')</script>");
                }else{
                    echo("<script>alert('Upload not updated')</script>");
                }
        }else{
        
                $update="UPDATE posts SET category = '$category' , img = '$old_image' WHERE id = $id";
                
                $updated = mysqli_query($main, $update);
                if($updated){
                    echo("<script>alert('Upload Updated')</script>");
                }else{
                    echo("<script>alert('Upload not updated')</script>");
                }
    }
   
}
}

if(array_key_exists("post", $_POST)){
    createPost();
}
else if(array_key_exists("update", $_POST)){
    updatePost();
}

?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/media.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">


    <script type="text/javascript">
    
        function show(shown, hidden){

            
            document.getElementById(shown).style.display= "block";
            document.getElementById(hidden).style.display= "none";
            return false;
        }

        function reset(){
            document.getElementById('page2').style.display= "none";
            document.getElementById('page3').style.display= "none";
            document.getElementById('page4').style.display= "none";
        }
    </script>
</head>
<body>

        <section class="cover">

                <div class="nav">
                        <div class="left-pad"><a href="#home"><span style="color: rgb(206, 174, 110)">የማሞ Panel</span> </a></div>

         
                <div class="nav-bar" >
                        <nav> 
                            <ul class="nav-menu">
                              <li><a href="#page3" class = "allorder">Orders<span class="space" id = "orders"></span></a></li>
                              <li><a href="#page4" class = "allmessage">Messages<span id = "messages"></span></a></li>
                              <li><a href="logout.php">Logout</a></li>
                            </ul>
                
                        </nav>
                    </div>
                <div class="mobile">
                    
                </div>
                </div>
                
                </section>
                

                <section class="clothes" id = "page0">

                    <p class="header"> All Clothes</p>
                        
                        <div class="clothes_container"></div>
   
                </section>
            
                <section class="edit_detail" id = "page2" style="display: none">
                    <p class="header">Edit Detail</p>  
                    <form method="post" enctype="multipart/form-data" >  
                                <div class="edit_clothe">
                                        <p> <a href="image/ebs.jpg"><img src ="" width="400px" height="200px" id="viewImage3" ></a></p>
                                        <button class="add editPost"  type="button" id="button">Change Photo</button>
                                        <input class="image_input" id="file-input" type="file" name="image1"  onchange="readURL(this, 'viewImage3')">
                            </div>
                              
                    <div class="edit_input_detail">
                            
                                <p class="fill">Fill to post your content</p>
                                
                                <p>category</p>
                                <select class="input_style" id = "category" name = "category">
                                <option>Uniform</option>
                                <option>Choir</option>
                                
                                <option>Others</option>
                                </select>
                                <input type= "hidden" id = "hiddenObject" name = "hiddenId"  value = "">
                                <input type= "hidden" id = "hiddenObjectImage" name = "hiddenIdImaage"  value = "">
                                <p><button class="update" name = "update">Update</button></p>
                            
                                <p><a  href ="index.php" class="back" name = "back" >Back</a></p>
                           
                        </div>
                    </form>

                </section>
                <section class="orders" id = "page3" >
                    <p class="header">Orders</p>
                    <div class = "order_selected">
                    
                    </div>

                      <div class = "order_post">
                      
                      </div>

                </section>
                <section class="creating_post" id = "page4">
                    <p class="header">Create Post</p>
                    <form method="POST" enctype="multipart/form-data" id = "form_data">
                        
                    <div class="clothe">
                            
                            <p> <img src ="" id="viewImage1"></p>
                            <button class="add" id="button1" type="button">Add Photo</button>
                            <input class="image_input" id="file-input1" type="file" name="image"  onchange="readURL(this, 'viewImage1')">
                </div>
                    
                    <div class="input_detail">
                        
                            <p class="fill">Fill to post your content</p>
                           
                            <p>Category</p>
                            <p class="req" style="display: none">*required</p>
                            <select class="input_style" id="type" name ="type" required>
                                <option>Choir</option>
                                <option>Uniform</option>
                                <option>Others</option>
                            </select>
            
                            <p><button class="post" type="submit" id= "save" name = "post">Post</button></p>
                        
                       
                    </div>
                </form>

                </section>
                <section class="comments" id = "page5" >
                    <p class="header">Messages</p>
                    <div class="comment_container"></div>    
               

                </section>
                
                <script>
                        function readURL(input, id) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
        
                                    reader.onload = function (e) {
                                        document.getElementById(id).src = e.target.result;
                                    }
        
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jPages.js"></script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
</body>
</html>

    