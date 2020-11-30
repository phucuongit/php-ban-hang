let prodDel = document.querySelectorAll(".prod-del");
function getUrl(){
  return window.location.href.replace(/\?action(.+)$/, ''); 
}
function showAlert(text){
  var close = document.getElementsByClassName("alert");
  close[0].innerHTML = text
  close[0].style.opacity = "1";
  close[0].style.display = "block";

  setTimeout(function () {
    close[0].style.opacity = "0";
  }, 1000);
}

// xóa sản phẩm
prodDel.forEach((prod) => {
  prod.addEventListener("click", async function (e) {
    e.preventDefault();

    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    let url = getUrl();
    fd.append("id", idPro);
    fetch(url + "?action=prodDel", {
      method: "POST",
      body: fd,
    })
    .then(response => response.json())
    .then((response) => {
      showAlert(response.message)
      this.parentElement.parentElement.remove();
    });
  });
});

// xóa đơn hàng
let orderDel = document.querySelectorAll(".order-del");
orderDel.forEach((order) => {
  order.addEventListener("click", async function (e) {
    e.preventDefault();

    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    let url = getUrl();
    fd.append("id", idPro);
    fetch(url + '?action=orderDel', {
      method: "POST",
      body: fd,
    })
    .then(response => response.json())
    .then((response) => {
      showAlert(response.message)
      this.parentElement.parentElement.remove();
    });
  });
});


// update trạng thái đơn hàng
let updateStatus = document.querySelector(".updateStatus");
if (updateStatus) {
  updateStatus.addEventListener("click", function () {
    let display = document.querySelector(".update_status").style.display;

    if (display == "none" || display == "") {
      document.querySelector(".update_status").style.display = "block";
      document.querySelector(".show_status").style.display = "none";
    } else {
      document.querySelector(".update_status").style.display = "none";
      document.querySelector(".show_status").style.display = "block";
      let newStatus = document.querySelector("select[name='update_status']");
      let status = newStatus.value;
      let regexp = new RegExp(/id=(\d+)/);
      let formData = new FormData();
      let url = getUrl();
      formData.append("id", regexp.exec(window.location.href)[1]);
      formData.append("status", status);
      document.querySelector(".show_status").innerHTML = "<b>" + newStatus.options[status].text + "</b>";
      fetch(url + '/don-hang?action=updateStatus', {
        method: "POST",
        body: formData,
      })
      .then(response => response.json())
      .then((response) => {
        showAlert(response.message)
      })
      .catch(e => {
        console.log(e)
      });
    }
  });
}


// xoa user
let userDel = document.querySelectorAll(".user-del");
userDel.forEach((user) => {
  user.addEventListener("click", async function (e) {
    e.preventDefault();

    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    let url = getUrl();
    fd.append("id", idPro);
    fetch(url + '/user?action=userDel', {
      method: "POST",
      body: fd,
    })
    .then(response => response.json())
    .then((response) => {
      showAlert(response.message)
      if(response.status === 'OK'){
        this.parentElement.parentElement.remove();
      }
     
    });
  });
});
let menuMobile = document.querySelector(".menu-mobile");
menuMobile.addEventListener("click", function () {
  let sidebar = document.querySelector(".main-sidebar");
  sidebar.classList.toggle("showMenu");
});

//xoa cate
let cateDel = document.querySelectorAll(".cate-del");
cateDel.forEach((cate) => {
  cate.addEventListener("click", async function (e) {
    e.preventDefault();
    let url = getUrl();
    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    fd.append("id", idPro);
    fetch(url + '?action=cateDel', {
      method: "POST",
      body: fd,
    })
    .then(response => response.json())
    .then((response) => {
      showAlert(response.message)
      this.parentElement.parentElement.remove();
    });
  });
});


//text editor

$(document).ready(function() {
  $('#editor').summernote({
    height: 300,
    placeholder: 'Nhập mô tả',
  });
  $('#editor_short_des').summernote({
    height: 300,
    placeholder: 'Nhập mô tả ngắn',
  });
});