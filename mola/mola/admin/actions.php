<?php


$main=mysqli_connect("localhost","root","","mola") or die("Can not Connect to server");

$response = array();
$output="";

function Prepare_FromForm($data)
{
	global $main;
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($main,$data);
		return $data;	  
}



if(isset($_POST["action"])){

    
    global $main;

    if($_POST["action"] == "login"){
        $name = Prepare_FromForm($_POST["name"]);
        $phone = Prepare_FromForm($_POST["phone"]);

        
        $sql = "SELECT * FROM admin WHERE name = '$name' AND phone = '$phone'";
        $result = mysqli_query($main, $sql);
       
        if(mysqli_num_rows($result) > 0){   
        
            while($row = mysqli_fetch_assoc($result)) {
                $response['status'] ='success';
           
            }
        }else{
            $response['status'] ='error';
        }
        
        echo json_encode($response);
    }

    if($_POST["action"] == "choirClothes"){

        
        $record_per_page = 8;
        $page='';
        if(isset($_POST["page"]))
        {
        $page = $_POST["page"];
        }
        else
        {
        $page = 1;
        }

        $start_from = ($page-1)*$record_per_page;
        $query="SELECT * FROM posts  order by id  DESC LIMIT $start_from, $record_per_page";
        $result=mysqli_query($main,$query);

        $output .="<div>";
        

        while ($row=mysqli_fetch_array($result)) {

            $output .= "
            <div class='clothe'>
                    
                    <div class='clothe_img>
                        <a href='../img/{$row['img']}'><img src='../img/{$row['img']}' height='100' width='100'/></a>
                    </div>

                    <p class='cloth_name'>{$row['category']}</p>
                    <a class = 'edit' href='#' id = '{$row['id']}'>Edit</a>
                    <a class = 'delete' href='#' id = '{$row['id']}'>Delete</a>
                    
            </div>";
        
                    }
            $output .="</div><div align='center'>";       
                

            $page_query = "SELECT * FROM `posts` ORDER BY id DESC";
            $page_result = mysqli_query($main, $page_query);
            $total_records = mysqli_num_rows($page_result);
            $total_pages = ceil($total_records/$record_per_page);
            

            for ($i=1; $i <= $total_pages; $i++) { 
                
                if($i == $page){

                    $active = "active";
                }
                else{

                    $active = "";
                }
                $output .= "<button style='margin-top:10px;margin-bottom:10px; cursor:pointer; padding:6px; margin-left:4px' class ='$active choir' id = '".$i."'>".$i."</button>";

            
            }
            $output.="</div>";

    
        
    
            echo $output;
    }



    if($_POST["action"] == "allMessages"){


        $getdata="SELECT * FROM message";
        $sucdata=mysqli_query($main,$getdata);
        if(mysqli_num_rows($sucdata) >0){

        while ($row=mysqli_fetch_array($sucdata)) {

            $dt = new DateTime($row['date']);
            $date = $dt->format('d/m/y');
            $output .= "
                         <div class='Comment_detail'>
                                
                            <div class='commenter'>{$row['name']}/ {$row['phone']}</div>
                            <div class='content'>{$row['massege']}</div>
                            <div class = 'comment_date'>{$date}</div>
                        </div>
            ";
        
        }
    }else{
        $output .= "No data yet";
    }
        echo $output;
       
    }

    if($_POST["action"] == "deletePost"){

        $id = $_POST["id"];
        
        $sql = "DELETE FROM posts WHERE id=$id";
        $result=mysqli_query($main,$sql);


        $response = array(
            'messages' => "deleted",
                    );
        echo json_encode($response);

    }

    if($_POST["action"] == "selectPost"){


        global $main;
        $id = $_POST["id"];

        
        $sql = mysqli_query($main, "SELECT * FROM posts WHERE id = $id");
        $row = mysqli_fetch_array($sql);

        
            $response = array(
                'id' => $row['id'],
                'cat'=>$row['category'],
                'image'=>$row['img']
                        );

        echo json_encode($response);

    
}
    


    if($_POST["action"] == "Numbers"){

        $getdata="SELECT * FROM message WHERE seen = 0";
        $getdata1="SELECT * FROM order_post WHERE seen = 0";
        $getdata2="SELECT * FROM order_selected WHERE seen = 0";
        $sucdata=mysqli_query($main,$getdata);
        $sucdata1=mysqli_query($main,$getdata1);
        $sucdata2=mysqli_query($main,$getdata2);
        $messages=mysqli_num_rows($sucdata);
        $order= mysqli_num_rows($sucdata1);
        $custom_order = mysqli_num_rows($sucdata2);



        $response = array(
            'messages' => $messages,
            'orders' =>$order + $custom_order,
                    );
        echo json_encode($response);
    }

    if($_POST["action"] == "resetOrderToZero"){
        $sql = "UPDATE `order_post` SET seen=1";
        $sql2 = "UPDATE `order_selected` SET seen=1";
        mysqli_query($main, $sql);
        mysqli_query($main, $sql2);
        $response = array(
            'messages' => "reseted"
                    );
        echo json_encode($response);
    }
    if($_POST["action"] == "resetMessageToZero"){
        $sql = "UPDATE `message` SET seen=1";
        mysqli_query($main, $sql);
        $response = array(
            'messages' => "reseted"
                    );
        echo json_encode($response);
    }


    if($_POST["action"] == "OrderPost"){

        $record_per_page = 1;
        $page='';
        if(isset($_POST["page"]))
        {
        $page = $_POST["page"];
        }
        else
        {
        $page = 1;
        }

        $start_from = ($page-1)*$record_per_page;
        $query="SELECT * FROM `order_post` order by id DESC LIMIT $start_from, $record_per_page";
        $result=mysqli_query($main,$query);
        
        if(mysqli_num_rows($result) >0){

        while ($row=mysqli_fetch_array($result)) {
            $dt = new DateTime($row['orderedDate']);
            $date = $dt->format('d/m/y');

            $output .= "<div class='clothe'>
                                    
                <div class='clothe_img_con'>
                    <div class='img-1'><a href='../img/gallery/{$row['img']}'><img src='../img/gallery/{$row['img']}' height='100' width='100' /></a></div>
                
                

                <p class='cloth_name'>{$row['type']}</p>
                <p class='ordered'>Selected Order</p>
                    
                </div>
                
                <div class='order_detail'>
                        <p class='detail_style'>Order Detail</p>
                    <p><span class='title'>Username</span> : <span class='value'>{$row['name']}</span></p>
                    <p><span class='title'>Phone Number</span> : <span class='value'>{$row['phone']}</span></p> 
                    <p><span class='title'>Small</span> : <span class='value'>{$row['small']}</span></p>
                    <p><span class='title'>Medium</span> : <span class='value'>{$row['medium']}</span></p>
                    <p><span class='title'>Large</span> : <span class='value'>{$row['larg']}</span></p>
                    
                    <p><span class='title'>Ordered Date</span> : <span class='value'>{$date}</span></p>
                    <p><span class='title'>Delivery Date</span> : <span class='value'>{$row['deliveryDate']}</span></p>

                                        
                </div></div>";
                
        }

        $page_query = "SELECT * FROM `order_post` ORDER BY id DESC";
            $page_result = mysqli_query($main, $page_query);
            $total_records = mysqli_num_rows($page_result);
            $total_pages = ceil($total_records/$record_per_page);
            
            $output .= "<div>";

            for ($i=1; $i <= $total_pages; $i++) { 
                
                if($i == $page){

                    $active = "active";
                }
                else{

                    $active = "";
                }
                $output .= "<button style='margin-top:10px;margin-bottom:10px; cursor:pointer; padding:6px; margin-left:4px' class ='$active post' id = '".$i."'>".$i."</button>";
            }
            $output.="</div>";
            
    
        
        echo $output;
    }
}

if($_POST["action"] == "OrderSelected"){
    global $main;

    $record_per_page = 1;
    $page='';
    if(isset($_POST["page"]))
    {
    $page = $_POST["page"];
    }
    else
    {
    $page = 1;
    }

    $start_from = ($page-1)*$record_per_page;
    $query="SELECT * FROM `order_selected` order by id DESC LIMIT $start_from, $record_per_page";
    $result=mysqli_query($main,$query);
    
    if(mysqli_num_rows($result) >0){

    while ($row=mysqli_fetch_array($result)) {
        $dt = new DateTime($row['orderedDate']);
            $date = $dt->format('d/m/y');
            $id = $row['picture_id'];
            
            $sql2 = mysqli_query($main, "SELECT img FROM posts WHERE id = $id");
            $row2= mysqli_fetch_array($sql2);
            $img = $row2['img'];

        $output .= "<div class='clothe'>
                                
            <div class='clothe_img_con'>
                <div class='img-1'><img src='../img/$img'/></div>
            
            

            <p class='cloth_name'>choir</p>
            <p class='ordered'>Design Order</p>
                
        
            </div>
            <div class='order_detail'>
                    <p class='detail_style'>Order Detail</p>
                <p><span class='title'>Username</span> : <span class='value'>{$row['name']}</span></p>
                <p><span class='title'>Phone Number</span> : <span class='value'>{$row['phone']}</span></p> 
                <p><span class='title'>Small</span> : <span class='value'>{$row['small']}</span></p>
                <p><span class='title'>Medium</span> : <span class='value'>{$row['medium']}</span></p>
                <p><span class='title'>Large</span> : <span class='value'>{$row['larg']}</span></p>
                
                <p><span class='title'>Ordered Date</span> : <span class='value'>{$date}</span></p>
                <p><span class='title'>Delivery Date</span> : <span class='value'>{$row['deliveryDate']}</span></p>

                                    
            </div> </div>";
    }

    $page_query = "SELECT * FROM `order_selected` ORDER BY id DESC";
        $page_result = mysqli_query($main, $page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records/$record_per_page);
        $output .= "<div>";

       
        for ($i=1; $i <= $total_pages; $i++) { 
                
            if($i == $page){

                $active = "active";
            }
            else{

                $active = "";
            }
            $output .= "<button style='margin-top:10px;margin-bottom:10px; cursor:pointer; padding:6px; margin-left:4px' class ='$active selected' id = '".$i."'>".$i."</button>";
        }
        $output.="</div>";
        


    
    echo $output;
}
}

}    
     
?>