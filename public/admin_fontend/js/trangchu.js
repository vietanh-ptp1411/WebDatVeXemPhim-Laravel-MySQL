
///////////////////////////////////chuyển slide///////////////////
var index=1;
changeimage =function(){
var imgs = ["/DoAn3_IMG/slidehome3.webp","/DoAn3_IMG/slidehome2.jpg","/DoAn3_IMG/slidehome1.png"];
    document.getElementById("imgg").src =imgs[index];
    index++;
    if (index==3){
        index=0;
    }
}

///////////////////////////////////nút xem thêm///////////////////

document.addEventListener("DOMContentLoaded", function() {
    var currentPage = 1;
    var perPage = 8; // Số lượng sản phẩm mỗi lần tải thêm

    document.getElementById("load-more-button").addEventListener("click", function() {
        // Gửi yêu cầu AJAX để lấy sản phẩm tiếp theo từ trang n+1
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/get-more-products?page=" + (currentPage + 1), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Nếu lấy dữ liệu thành công, thêm sản phẩm vào danh sách
                var newProducts = JSON.parse(xhr.responseText);
                var productList = document.getElementById("product-list");
                newProducts.forEach(function(product) {
                    var li = document.createElement("li");
                    var div = document.createElement("div");
                    div.className = "product-item";
                    div.innerHTML = `
                        <div class="product-top">
                            <a href="{{ route('detailt', ['ProID' => $sp->ProID]) }}" class="product-thumb">
                                <img src="DoAn3_IMG/${product.ProImage}" alt="">  
                            </a>
                            <a href="" class="buy-now">Mua ngay</a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('detailt', ['ProID' => $sp->ProID]) }}" class="product-name" title="${product.ProName}">${product.ProName}</a>
                            <div class="product-price" style="text-align: center;">${product.price} đ</div>
                        </div>`;
                    li.appendChild(div);
                    productList.appendChild(li);
                });
                // Tăng số trang hiện tại lên
                currentPage++;
            } else {
                console.error("Lỗi khi tải thêm sản phẩm.");
            }
        };
        xhr.send();
    });


    var currentPage2 = 1;
    var perPage2 = 4; // Số lượng sản phẩm mỗi lần tải thêm

    document.getElementById("load-more-button2").addEventListener("click", function() {
        // Gửi yêu cầu AJAX để lấy sản phẩm tiếp theo từ trang n+1
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/get-more-products2?page2=" + (currentPage2 + 1), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Nếu lấy dữ liệu thành công, thêm sản phẩm vào danh sách
                var newProducts = JSON.parse(xhr.responseText);
                var productList = document.getElementById("product-list2");
                newProducts.forEach(function(product) {
                    var li = document.createElement("li");
                    var div = document.createElement("div");
                    div.className = "product-item";
                    div.innerHTML = `
                        <div class="product-top">
                            <a href="{{ route('detailt', ['ProID' => $sp->ProID]) }}" class="product-thumb">
                                <img src="DoAn3_IMG/${product.ProImage}" alt="">  
                            </a>
                            <a href="" class="buy-now">Mua ngay</a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('detailt', ['ProID' => $sp->ProID]) }}" class="product-name" title="${product.ProName}">${product.ProName}</a>
                            <div class="product-price" style="text-align: center;">${product.price} đ</div>
                        </div>`;
                    li.appendChild(div);
                    productList.appendChild(li);
                });
                // Tăng số trang hiện tại lên
                currentPage++;
            } else {
                console.error("Lỗi khi tải thêm sản phẩm.");
            }
        };
        xhr.send();
    });
});





////////////////////////chuyển slide bột sưu tập//////////////////////////////

 


    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })

    let inde=0
    const right=document.querySelector('.fa-angle-right-two')
    const left=document.querySelector('.fa-angle-left-two')
    const number=document.querySelectorAll(".zx")
    right.addEventListener("click",function(){
        inde=inde+1
        if(inde>number.length-1){
            inde=0
        }
        document.querySelector(".qqq").style.right=inde*100+"%"
    }) 
    left.addEventListener("click",function(){
        inde=inde-1
        if(inde<=0){
            inde=number.length-1
        }
        document.querySelector(".qqq").style.right=inde*100+"%"
    }) 
