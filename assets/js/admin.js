let prodDel = document.querySelectorAll(".prod-del");
prodDel.forEach((prod) => {
  prod.addEventListener("click", async function (e) {
    e.preventDefault();

    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    fd.append("id", idPro);
    fetch("/admin/san-pham?action=prod_del", {
      method: "POST",
      body: fd,
    }).then((response) => {
      console.log(this.parentElement.parentElement.remove());
    });
  });
});
let orderDel = document.querySelectorAll(".order-del");
orderDel.forEach((order) => {
  order.addEventListener("click", async function (e) {
    e.preventDefault();

    let idPro = this.querySelector("input").value;
    let fd = new FormData();
    fd.append("id", idPro);
    fetch("/admin/don-hang?action=orderDel", {
      method: "POST",
      body: fd,
    }).then((response) => {
      console.log(this.parentElement.parentElement.remove());
    });
  });
});
let updateStatus = document.querySelector(".updateStatus");
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
    formData.append("id", regexp.exec(window.location.href)[1]);
    formData.append("status", status);
    document.querySelector("p.show_status").innerHTML =
      "<b>" + newStatus.options[status].text + "</b>";
    fetch("/admin/don-hang?action=updateStatus", {
      method: "POST",
      body: formData,
    }).then((result) => {});
  }
});
