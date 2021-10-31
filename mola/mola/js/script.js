$(".box_image").click(function(){
 var type=$(this).attr('id');
 $("#title_view").text(type + " collections")
  $.get("ajax.php",{
type:type
  }, function(data){
    $("#apply").html(data);
    $(".paginationdip button").on("click" , function(){
  var page=$(this).attr('id');
  var type=$(this).attr('class');
  $.get("ajax.php",{
type:type,
page:page

  }, function(data){
    $("#apply").html(data);
  });
});

  });
$(".category_view").show();

$.post("ajax.php",{
  type:type
},function(data){

  $(".ph").html(data);
});
});

$("#cloth_view").click(function(){

$(".category_view").hide();
});

$("#cloth_orse").click(function(){

$(".order_selected").hide();
});

$("#cloth_order").click(function(){

$(".order_view").hide();
});

$(".pagination button").on("click" , function(){
  var page=$(this).attr('id');
  $.get("php/php.php",{
page:page
  }, function(data){
    $(".post_container").html(data);
  });
});


// order show

$(".Order").click(function(){

$(".order_view").show();
});


$(".order_single").click(function(){
var img=$(this).closest('.single_post').attr('id');
var src=$("#" + img + " img ").attr('src');
$(".select_img").attr("src",src);
$("#hiddeninput").val(img);
$(".order_selected").show();
});

// check box

$(".small").click(function(){
	$("#small").show()
})

$(".medium").click(function(){
	$("#medium").show()
})

$(".larg").click(function(){
	$("#larg").show()
})

$(".small_selected").click(function(){
	$("#small_selected").show()
})

$(".medium_selected").click(function(){
	$("#medium_selected").show()
})

$(".larg_selected").click(function(){
	$("#larg_selected").show()
})


