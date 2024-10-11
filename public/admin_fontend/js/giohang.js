
var giohang1 = new Array();

function themvaogiohang1(x) {
  var boxsp = x.parentElement.children;
  var tensp = boxsp[0].innerText;
  var gia =  boxsp[1].innerText;
  var soluong = boxsp[3].children[1].value;
  

  if(checkspgiohang(tensp)>=0){
    capnhatslsp(checkspgiohang(tensp));
  }
  else{
    var sp = new Array(tensp, gia, soluong);
    giohang1.push(sp);
  }
  // console.log(giohang);
  // showcountsp();

  // lưu giỏ hàng tren sessionStorage
  sessionStorage.setItem("giohang1", JSON.stringify(giohang1));

}


//trang chi tiết sang giỏ hàng


let amountElement = document.getElementById('amount');
let amount = amountElement.value;
// console.log(amount);

let render=(amount)=>{
    amountElement.value=amount
}
// handlePlus
let handlePlus=()=>{
    amount++
    render(amount); 
}

let handleMinus=()=>{
    if(amount>1)
        amount--;
    render(amount);
}

amountElement.addEventListener('input',()=>{
    amount=amountElement.value;
    amount=parseInt(amount);
    amount=(isNaN(amount) ||amount==0)?1:amount;
    render(amount);
    console.log(amount);
})
