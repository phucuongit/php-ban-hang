//increase - decrease
let increase = document.getElementsByClassName("number-increment");
if (increase.length > 0) {
  increase[0].addEventListener("click", function () {
    let input = document.querySelector(".input-number");
    if(parseInt(input.value, 10) + 1 <= input.getAttribute('max')){
      input.value = parseInt(input.value, 10) + 1;
    }else{
      alert('Vui lòng mua nhỏ hơn ' + input.getAttribute('max') + 'sản phẩm')
    }
 
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
     
      let tagAddTocart = product.querySelector("a.add_cart");
        if(tagAddTocart){
          tagAddTocart.addEventListener("click", async function (event) {
            // console.log("click day");
            event.preventDefault();
            let url = product.querySelector("a.add_cart").href;
            let input = document.querySelector(".input-number");
            let data = {
              product_id: product.querySelector("input[name=product_id]").value,
            }
            if(input){
              let maxInput = input.getAttribute('max') ;
              if (parseInt(input.value) <= 0 || parseInt(input.value) > maxInput) {
                alert('Vui lòng mua lớn hơn 1 sản phẩm và nhỏ hơn ' + maxInput + 'sản phẩm')
                return
              }
              data = Object.assign(data, {
                quality: parseInt(input.value, 10),
              })
            }else{
              data = Object.assign(data, {
                quality: 1,
              })
            }
      
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
      
      }
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

var buttonsDelCart = document.querySelectorAll('.del-cart')
buttonsDelCart.forEach(button => {
  button.addEventListener('click', async function(e){
    e.preventDefault();
    var del = this;

    let id = del.parentElement.parentElement.querySelector('input[type="hidden"').value;
    await fetch('/gio-hang?action=delCart/' + id, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      // body: JSON.stringify({id: id})
    })
    alert('Xóa thành công sản phẩm trong giỏ hàng');
    del.parentElement.parentElement.remove();
  })
})

