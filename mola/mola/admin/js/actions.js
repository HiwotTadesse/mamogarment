$(document).ready(function(){


    messages();
    loadData();
    numbers();
    OrderPost();
    OrderSelected();
    resetOrderToZero();
    resetMessageToZero();
    loadDataForOrderedPost();
    loadDataForOrderedSelected();

    function loadData(page){

       $.ajax({
            type:"post",
            dataType:'html',
            async : true,
            url:"actions.php",
            data :{
                action: 'choirClothes',
                page :page
            },
            success :function(response){
                $(".clothes_container").html(response);
            }
       })
    }

    $(document).on("click",".choir", function(){

        var pageid = $(this).attr("id");
        loadData(pageid);
    })
    function loadDataForOrderedPost(page){

        $.ajax({
             type:"post",
             dataType:'html',
             async : true,
             url:"actions.php",
             data :{
                 action: 'OrderPost',
                 page :page
             },
             success :function(response){
                 $(".order_post").html(response);
             }
        })
     }
 
     $(document).on("click",".post", function(){
 
         var pageid = $(this).attr("id");
         loadDataForOrderedPost(pageid);
     })
     function loadDataForOrderedSelected(page){

        $.ajax({
             type:"post",
             dataType:'html',
             async : true,
             url:"actions.php",
             data :{
                 action: 'OrderSelected',
                 page :page
             },
             success :function(response){
                 $(".order_selected").html(response);
             }
        })
     }
 
     $(document).on("click",".selected", function(){
 
         var pageid = $(this).attr("id");
         loadDataForOrderedSelected(pageid);
     })

    $(document).on("click",".edit", function(e){

        e.preventDefault();
        var id = $(this).attr("id");
        reset();show("page2", "page0");

        $(".allorder").attr("href", "index.php");
        $(".allmessage").attr("href", "index.php");

        $.ajax({
    
            type:"post",
            async : true,
            dataType:"json",
            url:"actions.php",
            data: {id:id, action: 'selectPost'},
            success : function(response){
               $(".edit_input_detail #category option:selected").html(response["cat"]);
                $(".edit_clothe img").attr("src", "../img/"+response["image"]+"");
                $("#hiddenObjectImage").attr("value", response['image']);
                $("#hiddenObject").attr("value", response["id"]);
            },
            error:function(e){
                console.log("error");
            }
    })
        
    })

    $(document).on("click",".delete", function(e){

        e.preventDefault();
        var id = $(this).attr("id");

        $(this).closest(".clothe").hide();

        $.ajax({
    
            type:"post",
            async : true,
            url:"actions.php",
            data: {id:id, action: 'deletePost'},
            success : function(response){
                alert("Deleted Successfully!");
                Window.location.href("index.php");
            },
            error:function(e){
                console.log("error");
            }
    })
        
    })
    $("#login").on("click", function(event){
       
        event.preventDefault();
        

        var name = $("#name").val();
        var phone = $("#phone").val();
        console.log(name, phone)
            $.ajax({

                type:"post",
                dataType:'json',
                async : true,
                url:"actions.php",
                data:{
                    name:name,
                    phone:phone,
                    action:"login"
                    },
                success:function(response)
                {
                    if(response.status == "success"){

                        console.log("login");
                        location.href = "index.php";


                    }
                    else if(response.status = "error"){

                        $("#name").val("")
                        $("#phone").val("")

                        $("#status").text("Login Failed")
                                .slideDown(200)
                                .css({"color":"red", "font-size":"large"})
                                .show()
                    }
                },
                error:function(e){
                    console.log("error");
                }
    

        })
    })

    function messages(){

       $.ajax({
    
            type:"post",
            dataType:'html',
            async : true,
            url:"actions.php",
            data: {action: 'allMessages'},
            success : function(response){
                
                $(".comment_container").html(response);
            },
            error:function(e){
                console.log("error");
            }
    })
        }

        function OrderPost(){

            $.ajax({
         
                 type:"post",
                 dataType:'html',
                 async : true,
                 url:"actions.php",
                 data: {action: 'OrderPost'},
                 success : function(response){
                     
                     $(".order_post").html(response);
                 },
                 error:function(e){
                     console.log("error");
                 }
         })
             }

             function OrderSelected(){

                $.ajax({
             
                     type:"post",
                     dataType:'html',
                     async : true,
                     url:"actions.php",
                     data: {action: 'OrderSelected'},
                     success : function(response){
                         
                         $(".order_selected").html(response);
                     },
                     error:function(e){
                         console.log("error");
                     }
             })
                 }

        function numbers(){

            $.ajax({
         
                 type:"post",
                 dataType:'json',
                 async : true,
                 url:"actions.php",
                 data: {action: 'Numbers'},
                 success : function(response){
                    $('#messages').text(response['messages']);
                    $('#orders').text(response['orders']);
                    console.log(response['messages']);
                 },
                 error:function(e){
                     console.log("error");
                 }
         })
             }

             function resetOrderToZero(){

                $(".allorder").on("click", function(e){

                $.ajax({
         
                    type:"post",
                    dataType:'json',
                    async : true,
                    url:"actions.php",
                    data: {action: 'resetOrderToZero'},
                    success : function(response){
                       console.log(response['messages']);

                       $("#orders").text("0");
                    },
                    error:function(e){
                        console.log("error");
                    }
            })
        })
             }

             function resetMessageToZero(){


                $(".allmessage").on("click", function(){

                $.ajax({
         
                    type:"post",
                    dataType:'json',
                    async : true,
                    url:"actions.php",
                    data: {action: 'resetMessageToZero'},
                    success : function(response){
                       console.log(response['messages']);
                       $("#messages").text("0");
                        
                    },
                    error:function(e){
                        console.log("error");
                    }
            })
        })
             }

                
                
             
})
