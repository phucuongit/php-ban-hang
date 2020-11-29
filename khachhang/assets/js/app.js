function getUrl(){
  return window.location.href.replace(/\?action(.+)$/, ''); 
}

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
    blockProduct.forEach((product) => {
      let tagAddTocart = product.querySelector("a.add_cart");
        if(tagAddTocart){
          tagAddTocart.addEventListener("click", async function (event) {
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
            console.log('chay day')
            fetch(url + "?action=addToCart", {
              method: "POST",
              body: fd,
            }).then(response => response.json())
            .then((data) => {
                showAlert(data.message);
            }).catch(error => {
                console.log(error)
                showAlert('Lỗi không thể thêm sản phẩm này vào giỏ hàng');
            })
           
          });
      
      }
    });
  }
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
    var url = getUrl();
    let id = del.parentElement.parentElement.querySelector('input[type="hidden"').value;
    console.log(id);
    const formData = new FormData();
    formData.append('item_id', id);
    fetch(url + '/'+id+'?action=delCart', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then((data) => {
      showAlert(data.message);
      del.parentElement.parentElement.remove();
    }).catch((error) => {
      showAlert("Xãy ra lỗi, xóa thất bại")
      console.log(error)
    })
  
  })
})


//scroll to top
$(document).ready(function(){
 
  $(".back-to-top").on('click', function(event) {
      $('html, body').animate(
        {
          scrollTop: 0
        }, 800);
  });
  if(window.pageYOffset < 200){
    $('.back-to-top').removeClass('show');
  }else{
    $('.back-to-top').addClass('show');
  }
});

$(window).scroll(function(){
    if($(this).scrollTop() < 200){
      $('.back-to-top').removeClass('show');
    }else{
      $('.back-to-top').addClass('show');
    }
});
