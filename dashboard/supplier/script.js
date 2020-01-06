function readAll(){
    $.ajax({
        type: "get",
        url: "read_ready.php",
        success: function (data, status) {
            // console.log(data)
            var response = JSON.parse(data);
            output = ``;
            if (response.status == "success"){
                var details = response.data
                console.log(details[1]["description"])
                for (var i in details){
                    if(details[i]["images"] != ""){
                        var images = details[i]["images"].split(",")
                        console.log(images)
                        // var src = `../../upload/${image[0]}`;
                        output += `
                        <div class="card d-flex col-md-4 p-1">
                        <div class="card-body">
                        <h5 class="card-title">${details[i]["product_name"]}</h5>
                        <div>
                            <div class='media owl-carousel owl-theme img-slide'>`
                                for (var j=0; j<images.length; j++){
                                // console.log(images)
                                output += `<div class='item'><img src='../../upload/${images[j]}' height="150" width="150" class=''></div>`
                                }
                            output +=`
                            </div>
                        </div>
                        <div>`
                    }else{
                        var src = "https://via.placeholder.com/150";
                        output += `
                        <div class="card d-flex col-md-4 p-1">
                        <div class="card-body">
                        <h5 class="card-title">${details[i]["product_name"]}</h5>
                        <div>
                            <figure class='media'>
                            <div class='img-wrap'><img src='${src}' height="100" width="100" class=''></div>
                                <figcaption class='media-body'>
                                </figcaption>
                            </figure>
                        </div>
                        <div>`
                    }

                    if (details[i]["description"] != ""){
                        output += `<p>${details[i]["description"]}</p>`
                    }else{
                        output += `<div class="alert alert-warning">This product does not have a description yet. Edit Product details <a href="../inventory/index.php"><b>Here</b></a></div>`
                    }
                    // console.log(details[i]["description"])
                    output += `
                    </div>
                    </div>
                    <div class="card-footer">
                    <div>
                        <dl>
                            <dt>Fraction</dt>
                            <dd>${details[i]["fraction"]}</dd>
                            </div>

                            <dt>Quantity</dt>
                            <dd>${details[i]["quantity"]}</dd>
        
                        </dl>   
                    </div>
                    <big class="text-muted">Ksh ${details[i]["selling_price"]}</big>
                    <button class="btn btn-outline-secondary edit-btn" style="float: right;" id='${details[i]["ready_id"]}' fraction=${details[i]["fraction"]}>Edit Sale details</button>
                    </div>
                    </div>
                    `;}
                      output +=``
                $("#card-columns").html(output)
                }}})
}


function searchItem(keyword) {
    var search = keyword
    $.ajax({
        type: "get",
        url: "readOne.php",
        data: {
            search: search,
        },
        success: function (data, status) {
            console.log(data)
            var response = JSON.parse(data)
            output = ``;
            if (response.status == "success") {
                var details = response.data
                for (var i in details){
                    if(details[i]["images"] != ""){
                        var image = details[i]["images"].split(",")
                        var src = `../../upload/${image[0]}`;
                    }else{
                        var src = "https://via.placeholder.com/150";
                    }
                }
                for (var i in details){
                    output += `
                    <div class="card card d-flex col-md-4 mb-2 p-1">
                    <div class="card-body">
                    <h5 class="card-title">${details[i]["product_name"]}</h5>
                    <div>
                        <figure class='media'>
                            <div class='img-wrap'><img src='${src}' class='img-thumbnail img-sm'></div>
                            <figcaption class='media-body'>
                            </figcaption>
                        </figure>
                    </div>
                    <div>`
                    if (details[i]["description"] != ""){
                        output += `<p>${details[i]["description"]}</p>`
                    }else{
                        output += `<div class="alert alert-warning">This product does not have a description yet. Edit Product details <a href="../inventory/index.php"><b>Here</b></a></div>`
                    }
                    console.log(details[i]["description"])
                    output += `
                    </div>
                    </div>
                    <div class="card-footer">
                    <div>
                        <dl class="row">
                            <dt>Fraction</dt>
                            <dd>${details[i]["fraction"]}</dd>

                            <dt>Quantity</dt>
                            <dd>${details[i]["quantity"]}</dd>
                        </dl>   
                    </div>
                    <big class="text-muted">Ksh ${details[i]["selling_price"]}</big>
                    <button class="btn btn-outline-secondary edit-btn" style="float: right;" id='${details[i]["ready_id"]}' fraction=${details[i]["fraction"]}>Edit Sale details</button>
                    </div>
                    </div>
                    `;}
                $(".op").html(`<div class=" mt-2 alert alert-success">Success product found </div>`)
                $(".op").effect("bounce", {times: 1}, 100);
                $("#card-columns").html(output)

            }else {
                $("#card-columns").html("")
                $(".op").html(`<div class=" mt-2 alert alert-danger">Product Not found</div>`)
                $(".op").effect("bounce", {times: 1}, 100);
            }
        }

    });
}

//Load Modal With Product data before editing
function editPrepare(id, fraction){
    var ready_id = id
    var fraction = fraction
    $.ajax({
        type: "get",
        url: "edit_item.php",
        data: { 
            ready_id: ready_id,
            fraction: fraction,
         },
        success: function (data, status) {
            var response = JSON.parse(data)
            // console.log(response.data)

            if(response.status == "success"){
                response = response["data"][0]
                // $("#edit-image").val(response.images)
                $("#ready_id").val(ready_id)
                $("#fraction").val(fraction)
                $("#edit-quantity").val(response.quantity)
                $("#edit-selling_price").val(response.selling_price)
            $("#edit_good").modal("show")

            }else{
                //Spawn Error messages
            }
            
            //Open Edit modal
        }
    });
}

function editSubmit() {
    var ready_id = $("#ready_id").val()
    var fraction = $("#fraction").val()
    var quantity = $("#edit-quantity").val()
    var selling_price = $("#edit-selling_price").val()
    // console.log(ready_id, fraction, quantity, selling_price)
    if (ready_id == "") {
        $("#edit-error").html(`<div class="alert alert-danger">Error! Add a product name to proceed</div>`)
        $("#edit-error").effect("bounce", { times: 3 }, 300)
    }else {
        var formData = new FormData()

        formData.append('ready_id', ready_id);
        formData.append('fraction', fraction);
        formData.append('quantity', quantity);
        formData.append('selling_price', selling_price);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: "post",
            url: "update_item.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data, status) {
                var response = JSON.parse(data);
                console.log(response.message)

                if (response.status == "success") {
                    $("#edit_good").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 1 }, 300);
                    setTimeout(function(){
                        window.location = "index.php"
                    }, 1000)
                } else {
                    $("#edit_good").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 1 }, 300);
                }
            },
            error: function (data){
                console.log(data)
            }
        })
    }
}

$(document).ready(function () {
   readAll()
    $("#search").keyup(function () {
        var search_key = $("#search").val()
        console.log(search_key)
        if(search_key != ""){
            searchItem(search_key)
        }else{
            $(".op").html("")
            readAll()
        }
    })

    $("#save").click(function () {
        editSubmit()

    })


});

$(document).ajaxComplete(function(){
    
    $(".img-slide").owlCarousel({
        navigation : true, // Show next and prev buttons
        margin : 10,
        paginationSpeed : 400,
        items: 1,
	});
	
})


$(document).on("click",".edit-btn", function(){
    var product_id = $(this).attr("id")
    var fraction = $(this).attr("fraction")
   editPrepare(product_id, fraction)

})
