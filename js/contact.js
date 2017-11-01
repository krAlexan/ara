/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 var temp=0; 
$(document).ready(function() { 
  $(".go-right").submit(function(){ 
     $.ajax({
  url: "/mail.php",
  type: "POST",
  data:$(".go-right").serialize(),
  
  complete: function(resposne){  
  }
}).done(function() {
  $(".go-right").find('input').val("");
  $(".go-right").find('textarea').val("");
  $(".forms").find('form').hide();
  $(".forms").append("<p class='success'> Ваш заказ принят. В течении 10 минут мы свами свяжемся</p>");
  setTimeout(function(){$(".forms").find(".success").remove(); $(".forms").find('form').show(); $("#close").trigger('click');}, 15000);
});
      return false;});

$(".order").click(function(e){
   if (typeof $(this).data("order") !== "undefined") {
    

  if(temp!=$(this).data("order")){$("#"+temp).hide("slow"); }
    $("#order").val($(this).data("order"));
    temp=$(this).data("order");
$(".form-order").show("slow", arguments.callee);
   $("#"+ $("#order").val()).show("slow", arguments.callee);
   //$(".form-order").ScrollTo({easing: "easeOutExpo"});
   $.scrollTo('.form-order', { duration:800 });
  } 
});
$("#close").click(function(e){ 
    
$(".form-order").hide("slow", function () {
    // use callee so don't have to name the function
    $(this).next().hide("fast", arguments.callee);
  });
});
});