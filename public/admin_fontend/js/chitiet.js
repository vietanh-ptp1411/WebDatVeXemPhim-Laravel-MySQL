$(document).ready(function() {
    $('nav ul li').hover(
      function() {
        $(this).find('ul').stop().slideDown(200);
      },
      function() {
        $(this).find('ul').stop().slideUp(200);
      }
    );
  });
  
  function chkname(){
    var ten=document.getElementById("txtnamekh");
    var error = document.getElementById("chkName")
    if(ten.value==""){
        error.innerHTML=("Vui lòng nhập họ tên");
        error.style.display="inline";
        ten.style.borderRadius ="5px";
    }
    else{
        error.style.display="none";
    }
  }
  