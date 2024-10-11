const inputUsername = document.querySelector(".input-login-username");
const inputPassword = document.querySelector(".input-login-password");
const btnLogin = document.querySelector(".login__signInButton");

// Mảng cố định chứa thông tin của admin
var adminInfo = [{
    "username": "admin",
    "password": "admin"
  }];
  
  // Hàm kiểm tra xem một người dùng có phải là admin hay không
  function isAdmin(username, password) {
    for (let i = 0; i < adminInfo.length; i++) {
      if (adminInfo[i].username === username && adminInfo[i].password === password) {
        return true; // Người dùng là admin
      }
    }
    return false; // Người dùng không phải là admin
  }
  
  // Sử dụng hàm trong mã đăng nhập
  btnLogin.addEventListener("click", (e) => {
    e.preventDefault();
    if (inputUsername.value === "" || inputPassword.value === "") {
      alert("Vui lòng không để trống");
    } else {
      const username = inputUsername.value;
      const password = inputPassword.value;
  
      // Kiểm tra xem người dùng có phải là admin hay không
      if (isAdmin(username, password)) {
        alert("Đăng Nhập Thành Công (Admin)");
        window.location.href = "/admin";
      } else {
        // Nếu không phải admin, kiểm tra thông tin người dùng khác (như trong ví dụ trước)
        const user = JSON.parse(localStorage.getItem(username));
        if (user && user.password === password) {
          if (user.role === "user") {
            alert("Đăng Nhập Thành Công (User)");
            window.location.href = "user.html";
          } else {
            alert("Đăng Nhập Thành Công");
            window.location.href = "index.html";
          }
        } else {
          alert("Đăng Nhập Thất Bại");
        }
      }
    }
  });