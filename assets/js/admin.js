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
