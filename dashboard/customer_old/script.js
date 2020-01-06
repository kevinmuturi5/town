
function search(){
    var searchItem = $("#search").val();
    console.log(searchItem)

    $.ajax({
        type: "get",
        url: "search.php",
        data: {
        product:searchItem 
        },

        success: function (data, status) {
            $("#product-row").html(data)
            console.log(data+status)
        }
    });
}

function readAll(){
    $.ajax({
        type: "get",
        url: "readAll.php",
        success: function (data, status) {
            $("#product-row").html(data)
        }
    });
}


function confirmOrder(product_id){
    output = ``
    $.ajax({
        type: "get",
        url: "details.php",
        data: {
        product_id:product_id 
        },

        success: function (d, status) {
            data = JSON.parse(d)
            data = data[0]
            console.log(data)
            output = `
                <div class="card">
                <div class="row no-gutters">
                    <aside class="col-sm-5 border-right">
                <article class="gallery-wrap"> 
                <div class="img-big-wrap">
                <div> <a href="images/items/1.jpg" data-fancybox=""><img src='https://via.placeholder.com/150?text=product' width='100%' height='100%' "></a></div>
                </div> <!-- slider-product.// -->
                
                <div class="img-small-wrap">

                </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
                    </aside>
                    <aside class="col-sm-7">
                <article class="p-5">
                <h3 class="title mb-3">${data["name"]}</h3>

                <div class="mb-3"> 
                <var class="price h3 text-warning"> 
                    <span class="currency">KES </span><span class="num">${data["price"]}</span>
                </var> 
                <span></span> 
                </div> <!-- price-detail-wrap .// -->
                <dl>
                <dt>Description</dt>
                <dd><p>Here goes description consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco </p></dd>
                </dl>
                <dl class="row">
                <dt class="col-sm-3">Model#</dt>
                <dd class="col-sm-9">12345611</dd>

                <dt class="col-sm-3">Color</dt>
                <dd class="col-sm-9">Black and white </dd>

                <dt class="col-sm-3">Delivery</dt>
                <dd class="col-sm-9">Russia, USA, and Europe </dd>
                </dl>
                <div class="rating-wrap">

                <ul class="rating-stars list-unstyled">
                    <li style="width:80%" class="stars-active"> 
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                        <i class="fa fa-star"></i> 
                    </li>
                </ul>
                <div class="label-rating">154 orders </div>
                </div> <!-- rating-wrap.// -->
                <hr>
                <form action="confirmOrder.php" method="POST">
                <input  type="text" name="id" hidden value="${data["id"]}">
                <div class="row">
                    <div class="col-sm-5">
                        <dl class="dlist-inline">
                        <dt>Quantity: </dt>
                        <dd> 
                            <select class="form-control form-control-sm" style="width:70px;">
                                <option> 1 </option>
                                <option> 2 </option>
                                <option> 3 </option>
                            </select>
                        </dd>
                        </dl>  <!-- item-property .// -->
                    </div> <!-- col.// -->
                    <div class="col-sm-7">
                        <dl class="dlist-inline">
                            <dt>Size: </dt>
                            <dd>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">SM</span>
                                </label>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">MD</span>
                                </label>
                                <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <span class="form-check-label">XXL</span>
                                </label>
                            </dd>
                        </dl>  <!-- item-property .// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
                <hr>
                <button type="submit" class="btn  btn-primary"> Order now </button>
                </form>
                <!-- <a href="#" class="btn  btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Add to cart </a> -->
                </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
                </div> <!-- card.// -->




            `
            $("#confirm-details").html(output)
        }       
    })
}


function logging(){{
    console.log("Working")
}}

$(document).ready(function(){
    
    readAll()

    $("#search-btn").click(function (e) { 
        console.log("searching...")
        e.preventDefault();
        search();
    });

    $("#toggle-services").click(function(){
        alert("Active")

        if ($(this).attr("class") == "active"){
            console.log("Active")
        }
    })

    $("#servicesbtn").focus(function(){
        $(this).css({"outline":"none", "border-radius": "50%"})
    })

    $("#servicesbtn").focusout(function(){
        $(this).css({"outline":"none", "border-radius": "0%"})
    })
})

$(document).ajaxComplete(function(){
    console.log("Ajax Complete...")
    // $('#confirmBtn').click(function(){
    //     var product_id = $(this).attr('data-id');
    //     // $("#confirmOrder").modal("hide")
    //     console.log("Id is " + product_id)
    //     confirmOrder(product_id)
    // });
})