//
// function (){
//     var searchItem = $("#search").val();
//     console.log(searchItem)
//
//     $.ajax({
//         type: "get",
//         url: "search.php",
//         data: {
//         product:searchItem 
//         },
//
//         success: function (data, status) {
//             $("#product-row").html(data)
//             console.log(data+status)
//         }
//     });
// }
//
// function readAll(){
//     $.ajax({
//         type: "get",
//         url: "readAll.php",
//         success: function (data, status) {
//             $("#product-row").html(data)
//         }
//     });
// }
//
//
// function confirmOrder(product_id){
//     output = ``
//     $.ajax({
//         type: "get",
//         url: "details.php",
//         data: {
//         product_id:product_id 
//         },
//
//         success: function (d, status) {
//             data = JSON.parse(d)
//             data = data[0]
//             console.log(data)
//             output = `
//                 <div class="card">
//                 <div class="row no-gutters">
//                     <aside class="col-sm-5 border-right">
//                 <article class="gallery-wrap"> 
//                 <div class="img-big-wrap">
//                 <div> <a href="images/items/1.jpg" data-fancybox=""><img src='https://via.placeholder.com/150?text=product' width='100%' height='100%' "></a></div>
//                 </div> <!-- slider-product.// -->
//                
//                 <div class="img-small-wrap">
//
//                 </div> <!-- slider-nav.// -->
//                 </article> <!-- gallery-wrap .end// -->
//                     </aside>
//                     <aside class="col-sm-7">
//                 <article class="p-5">
//                 <h3 class="title mb-3">${data["name"]}</h3>
//
//                 <div class="mb-3"> 
//                 <var class="price h3 text-warning"> 
//                     <span class="currency">KES </span><span class="num">${data["price"]}</span>
//                 </var> 
//                 <span></span> 
//                 </div> <!-- price-detail-wrap .// -->
//                 <dl>
//                 <dt>Description</dt>
//                 <dd><p>Here goes description consectetur adipisicing elit, sed do eiusmod
//                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
//                 quis nostrud exercitation ullamco </p></dd>
//                 </dl>
//                 <dl class="row">
//                 <dt class="col-sm-3">Model#</dt>
//                 <dd class="col-sm-9">12345611</dd>
//
//                 <dt class="col-sm-3">Color</dt>
//                 <dd class="col-sm-9">Black and white </dd>
//
//                 <dt class="col-sm-3">Delivery</dt>
//                 <dd class="col-sm-9">Russia, USA, and Europe </dd>
//                 </dl>
//                 <div class="rating-wrap">
//
//                 <ul class="rating-stars list-unstyled">
//                     <li style="width:80%" class="stars-active"> 
//                         <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
//                         <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
//                         <i class="fa fa-star"></i> 
//                     </li>
//                 </ul>
//                 <div class="label-rating">154 orders </div>
//                 </div> <!-- rating-wrap.// -->
//                 <hr>
//                 <form action="confirmOrder.php" method="POST">
//                 <input  type="text" name="id" hidden value="${data["id"]}">
//                 <div class="row">
//                     <div class="col-sm-5">
//                         <dl class="dlist-inline">
//                         <dt>Quantity: </dt>
//                         <dd> 
//                             <select class="form-control form-control-sm" style="width:70px;">
//                                 <option> 1 </option>
//                                 <option> 2 </option>
//                                 <option> 3 </option>
//                             </select>
//                         </dd>
//                         </dl>  <!-- item-property .// -->
//                     </div> <!-- col.// -->
//                     <div class="col-sm-7">
//                         <dl class="dlist-inline">
//                             <dt>Size: </dt>
//                             <dd>
//                                 <label class="form-check form-check-inline">
//                                 <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
//                                 <span class="form-check-label">SM</span>
//                                 </label>
//                                 <label class="form-check form-check-inline">
//                                 <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
//                                 <span class="form-check-label">MD</span>
//                                 </label>
//                                 <label class="form-check form-check-inline">
//                                 <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
//                                 <span class="form-check-label">XXL</span>
//                                 </label>
//                             </dd>
//                         </dl>  <!-- item-property .// -->
//                     </div> <!-- col.// -->
//                 </div> <!-- row.// -->
//                 <hr>
//                 <button type="submit" class="btn  btn-primary"> Order now </button>
//                 </form>
//                 <!-- <a href="#" class="btn  btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Add to cart </a> -->
//                 </article> <!-- card-body.// -->
//                     </aside> <!-- col.// -->
//                 </div> <!-- row.// -->
//                 </div> <!-- card.// -->
//
//
//
//
//             `
//             $("#confirm-details").html(output)
//         }       
//     })
// }
//
//
// function logging(){{
//     console.log("Working")
// }}
//
// $(document).ready(function(){
//    
//     readAll()
//
//     $("#search-btn").click(function (e) { 
//         console.log("searching...")
//         e.preventDefault();
//         search();
//     });
//
//     $("#purchases").on("mouseenter", function(){
//         $("#purchases").addClass("show")
//         $("#purchases > .dropdown-menu").addClass("show")
//     })
//
//     $("#purchases").on("mouseleave", function(){
//         console.log("Leave")
//         $("#purchases").removeClass("show")
//         $("#purchases > .dropdown-menu").removeClass("show")
//     })
//
//     $("#sales").on("mouseenter", function(){
//         $("#sales").addClass("show")
//         $("#sales > .dropdown-menu").addClass("show")
//     })
//
//     $("#sales").on("mouseleave", function(){
//         console.log("Leave")
//         $("#sales").removeClass("show")
//         $("#sales > .dropdown-menu").removeClass("show")
//     })
//
//     $("#servicesbtn").focus(function(){
//         $(this).css({"outline":"none", "border-radius": "50%"})
//     })
//
//     $("#servicesbtn").focusout(function(){
//         $(this).css({"outline":"none", "border-radius": "0%"})
//     })
// })
//
// $(document).ajaxComplete(function(){
//     console.log("Ajax Complete...")
//     // $('#confirmBtn').click(function(){
//     //     var product_id = $(this).attr('data-id');
//     //     // $("#confirmOrder").modal("hide")
//     //     console.log("Id is " + product_id)
//     //     confirmOrder(product_id)
//     // });
// })
function view_cart(id){
    var prod_id = id;
    var output = ``;
    var count = 1;
    $.ajax({
        type: "get",
        url: "view_cart_items.php",
        data: {
            product_id: prod_id,
        },

        success: function (data,status) {
            console.log(data)
            var response = JSON.parse(data)
            output = ``;
            if (response.status == "success"){
                var result = response.data;
                console.log(result)
                for (var i in result){
                    if(result[i]["images"] != ""){
                        var image = result[i]["images"].split(",")
                        var src = '../../upload/${image[0]}';
                    }else{
                        var src = "https://via.placeholder.com/150";
                    }
                    output += `
                    <tr class='text-center'>
                        <td>${count}</td>
                          <td>
                            <figure class='media'>
                                <div class='img-wrap'><img src='{$src}' class='img-thumbnail img-sm'></div>
                                <figcaption class='media-body'>
                                </figcaption>
                            </figure> 
                        </td>
                            <td>${result[i]["product_name"]}</td>
                            <td>${result[i]["supplier_name"]}</td>
                            <td>${result[i]["units"]}</td>                                                   
                            <td>${result[i]["cost"]}</td>
                            <td>${result[i]["sku"]}</td>
                        <td>
                            <button class='btn btn-sm btn-outline-success pay-btn' data-id='${result[i]["id"]}'>Check out</button>
                        </td>"
                        `;

                    count += 1;
                }
                output += `
                <tr class="mt-3">
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-info">${count>1 ? count-1 : count }</span> Products in cart</td>
                </tr>
                `
                $("#table-result").html(output)

            }

        }
    })
}


//Converted add_to_cart to addToCart
function addToCart(ready_id){
    $.ajax({
        type: "get",
        url: "addtocart.php",
        data: {
            ready_id:ready_id,
        },
        success: function (data, status) {
            console.log(ready_id)
            location.href="view_cart.php";
        },
        error: function(){

        }
    });
}


function order(btn_id) {
    var id = btn_id;
    var prod = document.getElementById('prod_name');
    var prod_name = prod.textContent;
    var p = document.getElementById('price');
    var price = p.textContent;
    var pid =$("#pid").val();
    var sku = $("#sku").val();
    var units = $("#units").val();
    var supplier_id = $("#supplier_id").val()

    var cost = units * price;

    var formData = new FormData();
    formData.append('prod_name', prod_name);
    formData.append('price', price);
    formData.append('pid', pid);
    formData.append('sku', sku);
    formData.append('units', units);
    formData.append('supplier_id', supplier_id);
    formData.append('cost', cost);

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        type: "post",
        url: "order.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, status) {
            console.log(data)
            var response = JSON.parse(data);
            if (response.status == "success"){
                view_cart();
                location.href = "onorder.php?id="+id;

                // $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                // $(".op").effect("bounce", { times: 3 }, 300);
            }
            else {
                $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                $(".op").effect("bounce", { times: 3 }, 300);
                // location.href = "details.php";
            }
            console.log(data)

        },
        error: function (data) {
            console.log(data)

        }
    })

}

function search(keyword){
    var search = keyword
    var output =``
    $.ajax({
        type: "get",
        url: "search.php",
        data:{
            search : search,
        },
        success:function (data, status) {
            var response = JSON.parse(data)
            if (response.status == "success"){
                var details = response.data

                for (var i in details){
                    output += `
                    <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">${details[i]["product_name"]}</h5>
                    <div><img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap"></div>
                    <div><p>${details[i]["description"]}</p></div>
                    </div>
                    <div class="card-footer">
                    <big class="text-muted">Ksh ${details[i]["selling_price"]}</big>
                    </div>
                    </div>
                    `;}
                output +=``
                $(".op").html(`<div class=" mt-2 alert alert-success">Success product found </div>`)
                $(".op").effect("bounce", {times: 3}, 300);
                $(".card-columns").html(output)
                }

            }

    })
}

function read(){
    $.ajax({
        type: "get",
        url: "read_all.php",
        success: function (data, status) {
            // console.log(data)
            var response = JSON.parse(data)
            output = ``;
            if (response.status == "success"){
                var result = response.data;
                for (var i in result){
                    if(result[i]["images"] != ""){
                        var image = result[i]["images"].split(",")
                        var src = `../../upload/${image[0]}`;
                    }else{
                        var src = "https://via.placeholder.com/50";
                    }
                    output += `
                        <div class="card cards">
                        <img src='${src}' height="150px" width="100%">
                        <h4>${result[i]["product_name"]}</h4>
                        <p>${result[i]["description"]}</p>
                        <div class="card-footer">
                        <p class="price"><big class="text-muted">Ksh ${result[i]["selling_price"]}</big></p>
                        <p><button class="btn-outline-primary cart" id="${result[i]['id']}" style="float: right;"><i class="fas fa-shopping-cart"></i>Buy</button></p>
                        </div>
                        </div>
                    `;}
                output +=``
                $(".dis").html(output)

            } else {
                // $(".op").html(`<div class=" mt-2 alert alert-danger">Product Not found</div>`)
                // $(".op").effect("bounce", {times:3}, 300);
            }
                }

    })
}


$(document).ready(function () {
    read()

    $("#search-btn").click(function () {
        if ($("#search") != "") {
        var item = $("#search").val()
            console.log(item)

        }
    })

    $("#search").keyup(function () {
        var item = $("#search").val()
        console.log(item)
    })

    // $("#fashion").on({
    //     mouseenter: function () {
    //        $("#dropdown-menu").slideToggle("slow")
    //        },
    //     click: function () {
    //         $("#dropdown-menu").slideToggle("slow")
    //     }
    // })

    // $("#food_and_drinks").on({
    //     mouseenter: function () {
    //         $("#food_and_drinks_items").slideToggle("slow")
    //     },
    //     click: function () {
    //         $("#food_and_drinks_items").slideToggle("slow")
    //     }
    // })

    // $("#housing").on({
    //     mouseenter: function () {
    //         $("#housing_items").slideToggle("slow")
    //     },
    //     click: function () {
    //         $("#housing_items").slideToggle("slow")
    //     }
    // })

    $("#cartBtn").click(function () {
        var ready_id = $(this).attr('data-id')
        addToCart(ready_id)

    })
    $("#payment").on({
        click: function () {
            
        }
    })

})


// $(document).on("click",".cart", function(){
//     var product_id = $(this).attr("id")
//     console.log(product_id)
//     location.href="details.php?product_id="+product_id
//
// })
$(document).on("click",".cart", function(){
    var product_id = $(this).attr("id")
    console.log(product_id)
    location.href="details.php?product_id="+product_id

})

