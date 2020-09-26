//increase - decrease
let increase = document.getElementsByClassName("number-increment");
if (increase.length > 0) {
  increase[0].addEventListener("click", function () {
    let input = document.querySelector(".input-number");
    input.value = parseInt(input.value, 10) + 1;
  });
}
let decrease = document.getElementsByClassName("inumber-decrement");
if (decrease.length > 0) {
  decrease[0].addEventListener("click", function () {
    let input = document.querySelector(".input-number");
    if (input.value > 1) {
      input.value = parseInt(input.value, 10) - 1;
    }
  });
}

// increase - decrease cart

let inputCart = document.querySelectorAll(".product_count");

if (inputCart.length > 0) {
  inputCart.forEach((product) => {
    let inputIn = product.querySelector(".input-number-increment");
    let inputDe = product.querySelector(".input-number-decrement");
    if (inputIn && inputDe) {
      inputIn.addEventListener("click", function (e) {
        let input = product.querySelector(".input-number");
        input.value = parseInt(input.value) + 1;
      });

      inputDe.addEventListener("click", function (e) {
        let input = product.querySelector(".input-number");
        if (input.value > 0) {
          input.value = parseInt(input.value) - 1;
        }
      });
    }
  });
}

//add to cart
addTocart(".single_product_text");
addTocart(".product_image_area");
function addTocart(query) {
  let blockProduct = document.querySelectorAll(query);
  if (blockProduct.length > 0) {
    // console.log(blockProduct);
    blockProduct.forEach((product) => {
      // console.log(product);
      let url = product.querySelector("a.add_cart").href;
      let data = {
        product_id: product.querySelector("input[name=product_id]").value,
        quality: 1,
      };
      product
        .querySelector("a.add_cart")
        .addEventListener("click", async function (event) {
          // console.log("click day");
          event.preventDefault();
          const fd = new FormData();
          for (let key in data) {
            fd.append(key, data[key]);
          }
          await fetch(url + "?action=addToCart", {
            method: "POST",
            body: fd,
          });
          var close = document.getElementsByClassName("alert");
          close[0].style.opacity = "1";
          close[0].style.display = "block";

          setTimeout(function () {
            close[0].style.opacity = "0";
            // close[0].style.display = "none";
          }, 1000);
        });
    });
  }
}

function closeBtn() {
  var close = document.getElementsByClassName("closebtn");
  var div = close[0].parentElement;

  div.style.opacity = "0";

  setTimeout(function () {
    div.style.display = "none";
  }, 600);
}
