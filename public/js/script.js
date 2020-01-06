
function search(keyword){
    var search = keyword
    var output = ``;
    $.ajax({
        type: "get",
        url: "search_prod.php",
        data:{
            search:search,
        },
        success: function (data, status) {
            var response = JSON.parse(data)
            console.log(response);
            if(response.status == "success"){
                var product = response.data;
                for(var i in product){
                    console.log(product[i])
                    if(product[i]["images"] != "" && product[i]["images"] != undefined ){
                        var image = product[i]["images"].split(",")
                        var src = `upload/${image[0]}`;
                    }else{
                        var src = "https://via.placeholder.com/150";
                    }

                    output += `
                     <div class="card">
                      <img src='${src}' height="300px" width="100%">
                      <h1>${product[i]["product_name"]}</h1>
                      <p>${product[i]["description"]}</p>
                      <div class="card-footer">
                       <p class="price"><big class="text-muted">Ksh ${product[i]["selling_price"]}</big></p>
                       <p><button class="btn-outline-primary cart" id="${product[i]['id']}" style="float: right;"><i class="fas fa-shopping-cart"></i>Buy</button></p>
                       </div>
                    </div>
                    `;}
                output +=``
                $("#row").show()
                $(".container-fluid").html(output)
            }
             else {
                  $(".op").html(`<div class=" mt-2 alert alert-danger">"NO product found meeting the search criteria"</div>`)
                console.log(data)
            }

        }
    });
}

function read(){
    var output = `<h1 class="text-center">Online Supermarket</h1>
                    <!--<form class="mx-auto" role="form" enctype="multipart/form-data" method="post" action="search.php">-->
                        <div class="text-center" >
                            <img src="public/img/LOGO.png" height="224px" width="150px">
                        </div>
                        <br>
                        <div class="row mx-auto w-100">
                            <div class="col-md-2 col-sm-1"></div>
                            <div class="col-md-8 col-sm-10 mx-auto">
                                <input id="input" class="form-control" type="text" name="product">
                                <br>
                            </div>
                            <div class="col-md-2 col-sm-1"></div>
                        </div>
                        <div class="row w-75 m-auto">
                            <div class="m-auto">
                                <button class="btn btn-outline-secondary" id="search">Search</button>
                                <button class="btn btn-outline-secondary">Feeling Lucky</button>
                            </div>
                        </div>
                   <!--</form>-->
                   `;
                   $("#row").show()
    $(".col-sm-10").html(output)

}


$(document).ready(function(){
    read()
    $("#servicesbtn").focus(function(){
        $(this).css({"outline":"none", "border-radius": "50%"})
    })

    $("#servicesbtn").focusout(function(){
        $(this).css({"outline":"none", "border-radius": "0%"})
    })
    
    $(".menu-drop").on("mouseenter", function(){
        console.log("Hover")
        $(".menu-drop > dropdown-menu").addClass("show")
    })
    
    $("#search").click(function () {
        var search_item = $("#input").val()
         if (search_item != ""){
            search(search_item);

         }

    })
    
})
$(document).on("click",".cart", function(){
    var product_id = $(this).attr("id")
    console.log(product_id)
    location.href="dashboard/customer/details.php?product_id="+product_id

})
