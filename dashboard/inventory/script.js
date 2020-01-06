
function addProduct() {
    var name = $("#name").val()
    var description = $("#description").val()
    var brand = $("#brand").val()
    var unit_price = $("#unit_price").val()
    var quantity = $("#quantity").val()
    var unit_description = $("#unit_description").val()
    var sku = $("#sku").val()
    var size = $("#size").val()
    var color = $("#color").val()
    // var images = $("#images").val()
    var availability = $("input[name='available']:checked").val()
    var other = $("#other").val()

    if (name == "" || sku == "") {
        $("#error").html(`<div class="alert alert-danger">Error! Add a product name and its SKU to proceed</div>`)
        $("#error").effect("bounce", { times: 3 }, 300)
        var images = document.getElementById('images').files;
        // console.log(images[0])
    } else {

        var formData = new FormData()
        var images = document.getElementById('images').files;
        // console.log(images)
        var filesLength = images.length;
        for (var i = 0; i < filesLength; i++) {
            if(images[i]["isvalid"] != false){
                formData.append("images[]", images[i]);
            }
        }

        formData.append('name', name);
        formData.append('description', description); 
        formData.append('brand', brand);
        formData.append('unit_price', unit_price);
        formData.append('quantity', quantity);
        formData.append('unit_description', unit_description);
        formData.append('sku', sku);
        formData.append('size', size);
        formData.append('color', color);
        formData.append('availablity', availability); 
        formData.append('other', other);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: "post",
            url: "add_product.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data, status) {
                console.log(data)
                var response = JSON.parse(data);
                if (response.status == "success") {
                    $("#add_product").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                    setTimeout(function(){
                        location.href="index.php"
                    }, 1000)
                } else {
                    $("#add_product").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                }
            },
            error: function (data) {

            }
        })
    }
}

//Load Modal With Product data before editing
function editPrepare(id) {
    var product_id = id
    console.log(id)
    $.ajax({
        type: "get",
        url: "read_products.php",
        data: { product_id: product_id },
        success: function (data, status) {
            var response = JSON.parse(data)
            if(response.status == "success"){
                response = response["data"][0]
                $("#edit-id").val(response.id)
                $("#edit-name").val(response.name)
                $("#edit-description").val(response.description)
                $("#edit-brand").val(response.brand)
                $("#edit-unit_price").val(response.unit_price)
                $("#edit-quantity").val(response.quantity)
                $("#edit-unit_description").val(response.unit_description)
                $("#edit-sku").val(response.sku)
                $("#edit-size").val(response.size)
                $("#edit-color").val(response.color)
                // $("#images").val(response.images)
                var images = response.images != "" ? response.images.split(",") : null
                var existingImagePreview = ``
                if(images != null){
                    for (var i=0; i<images.length; i++){
                        existingImagePreview += `
                            <div class="col-md-3">
                            <img class="m-2" src="../../upload/${images[i]}" width=100 height=100 alt="${response.name}"></img>
                            <div class="btn btn-sm btn-outline-danger deleteUploadedImageBtn w-100" img-name="${images[i]}"  style="cursor:pointer"><span class="fa fa-trash m-auto"></span></div>
                            </div>
                        `
                    }
    
                }else{
                    var existingImagePreview = `
                        <div class="col-md-12">
                            <div class="alert alert-warning text-center">Zero images found for this product. Try adding new images</div>                    
                        </div>
                        `
                }
            }

            $("#existingImagePreview").html(existingImagePreview)
            
            // $("input[name='available']:checked").val()
            $("#other").val(response.other)
        }
    });
}


function deleteUploadedImage(image_name, product_id){
    if(image_name != ""  && product_id != ""){
        console.log("Deleting.. "+image_name)
        $.ajax({
            type: "get",
            url: "deleteImg.php",
            data: {
                name: image_name,
                product_id: product_id
            },
            success: function (data, status) {
                var response = JSON.parse(data)
                if(response.status == "success"){
                    editPrepare(product_id)
                    console.log("Deleted.. "+image_name)
                }else{
                    console.log("Nothing")
                }
            }
        });
    }
    return false
}


function clearAll(){
    //TODO
    //Function to clear all modal data, to  prevent double submissions after AJAX calls..
    $("#edit-id").val("")
    $("#edit-name").val("")
    $("#edit-description").val("")
    $("#edit-brand").val("")
    $("#edit-unit_price").val("")
    $("#edit-quantity").val("")
    $("#edit-unit_description").val("")
    $("#edit-sku").val("")
    $("#edit-size").val("")
    $("#edit-color").val("")
    $("#edit-images").val("")
    $("input[name='edit-available']:checked").val("")
    $("#edit-other").val("")
}


function readAll() {
    $.ajax({
        type: "get",
        url: "read_all.php",
        success: function (data, status) {
            // console.log(data)
            var response = JSON.parse(data);
            
            output = ``;
            var count = 1;
            if (response.status == "success") {
                var products = response.data
                for (var i in products){
                    if(products[i]["images"] != ""){
                        var image = products[i]["images"].split(",")
                        var src = `../../upload/${image[0]}`;
                    }else{
                        var src = "https://via.placeholder.com/150";
                    }

                    if(products[i]["available"] == 1){
                        var availability = "Yes"
                    }else if(products[i]["available"] == 0 ){
                        var availability = "No"
                    }else{
                        var availability = "Not Set"
                    }
                    output += `
                    <tr class='text-center'>
                        <td>${count}</td>
                            <td>${products[i]["name"]}</td>
                            <td>${products[i]["description"]}</td>
                            <td>${products[i]["brand"]}</td>
                            <td>${products[i]["quantity"]}</td>
                            <td>${products[i]["unit_price"]}</td>
                            <td>${availability}</td>
                            <td>${products[i]["sku"]}</td>
                            <td>
                            <figure class='media'>
                                <div class='img-wrap'><img src='${src}' class='img-thumbnail img-sm'></div>
                                <figcaption class='media-body'>
                                </figcaption>
                            </figure> 
                        </td>

                        <td>
                            <button class='btn btn-sm btn-outline-primary edit-btn' data-id='${products[i]["id"]}'>Edit</button>

                            <button class='btn btn-sm btn-outline-info prepare-btn' data-id='${products[i]["id"]}'>Prepare</button>
                                                    
                            <button class='btn btn-sm btn-outline-danger delete-btn' data-id='${products[i]["id"]}'>Delete</button>
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
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-info">${count>1 ? count-1 : count }</span> Products in store</td>
                </tr>
                `
                $("#table-result").html(output)
            }else{
                $(".op").html(`<div class="alert alert-danger mt-2">You have not added products to your store yet</div>`)
                $(".op").effect( "bounce", {times:3}, 200 );
            }
        }
    });
}

function editSubmit(e){

    var product_id = $("#edit-id").val()
    var name = $("#edit-name").val()
    var description = $("#edit-description").val()
    var brand = $("#edit-brand").val()
    var unit_price = $("#edit-unit_price").val()
    var quantity = $("#edit-quantity").val()
    var unit_description = $("#edit-unit_description").val()
    var sku = $("#edit-sku").val()
    var size = $("#edit-size").val()
    var color = $("#edit-color").val()
    var availability = $("input[name='edit-available']:checked").val()
    var other = $("#edit-other").val()
    // console.log(product_id + sku)

    if (name == "" || sku == "") {
        $("#edit-error").html(`<div class="alert alert-danger">Error! Add a product name and its SKU to proceed</div>`)
        $("#edit-error").effect("bounce", { times: 3 }, 300)
    } else {
        var formData = new FormData()
        var filesLength = document.getElementById('edit-images').files.length;
        var images = document.getElementById('edit-images').files
        console.log(images)
        if (filesLength > 0){
            for (var i = 0; i < filesLength; i++) {
                formData.append("images[]", document.getElementById('edit-images').files[i]);
            }
        }

        formData.append('product_id', product_id);
        formData.append('name', name);
        formData.append('description', description); 
        formData.append('brand', brand);
        formData.append('unit_price', unit_price);
        formData.append('quantity', quantity);
        formData.append('unit_description', unit_description);
        formData.append('sku', sku);
        formData.append('size', size);
        formData.append('color', color);
        formData.append('availablity', availability); 
        formData.append('other', other);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: "post",
            url: "edit.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data, status) {
                $('#edit-submit').one('click', editSubmit)
                console.log(data)
                var response = JSON.parse(data);
                if (response.status == "success"){
                    $("#edit_product").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                    setTimeout(function(){
                        location.href="index.php"
                    }, 1000)
                } 
                else{
                    $("#edit_product").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                }
            },
            error: function (data) {
            }
        })
    }

    e.stopImmediatePropagation();
    return false;
}

function searchProduct(keyword){
    var search = keyword
    var output = ``;
    var count = 1;
    $.ajax({
        type: "get",
        url: "read_one.php",
        data: {
            search: search,
        },
        success: function (data, status) {
            var response = JSON.parse(data)
            if(response.status == "success"){
                var product = response.data;
                for(var i in product){
                    // console.log(product[i])
                    if(product[i]["images"] != "" && product[i]["images"] != undefined ){
                        var image = product[i]["images"].split(",")
                        var src = `../../upload/${image[0]}`;
                    }else{
                        var src = "https://via.placeholder.com/150";
                    }

                    output += `
                    <tr class='text-center'>
                        <td>${count}</td>
                            <td>${product[i]["name"]}</td>
                            <td>${product[i]["description"]}</td>
                            <td>${product[i]["brand"]}</td>
                            <td>${product[i]["quantity"]}</td>
                            <td>${product[i]["unit_price"]}</td>
                            <td>${product[i]["available"]}</td>
                            <td>${product[i]["SKU"]}</td>
                            <td>
                            <figure class='media'>
                                <div class='img-wrap'><img src='${src}' class='img-thumbnail img-sm'></div>
                                <figcaption class='media-body'>
                                </figcaption>
                            </figure> 
                        </td>

                        <td>
                            <button class='btn btn-sm btn-outline-primary edit-btn' data-id='${product[i]["id"]}'>Edit</button>

                            <button class='btn btn-sm btn-outline-info prepare-btn' data-id='${product[i]["id"]}'>Prepare</button>
                                                    
                            <button class='btn btn-sm btn-outline-danger delete-btn' data-id='${product[i]["id"]}'>Delete</button>
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
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-info">${count>1 ? count-1 : count }</span> Products in store</td>
                </tr>
                `;
                $(".op").html(`<div class=" mt-2 alert alert-success">Success ${count>1 ? count-1 : count } products found </div>`)
                $(".op").effect("bounce", { times: 3 }, 300);
                $("#table-result").html(output)

            }else{
                $(".op").html(`<div class=" mt-2 alert alert-danger">Product Not found</div>`)
                $(".op").effect("bounce", { times: 1 }, 300);                
            }
        }
    });
}

function deleteProduct(id) {
    var deleteConfirmation = confirm("This Product will be deleted permanently from your Inventory")
    if (deleteConfirmation){
        $.ajax({
            type: "post",
            url: "delete_product.php",
            data: {
                product_id: id
            },
            success: function (data, status) {
                var response = JSON.parse(data)
                if (response.status == "success") {
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                    setTimeout(function(){
                        location.href="index.php"
                    }, 1000)

                } else {
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                }

            }
        });
    }else{
        //Else !!
    }
}


function prepareProduct(product_id){
    // console.log("Loading prepare modal data")
    var product_id = product_id
    $.ajax({
        type: "get",
        url: "load_prepare.php",
        data: {
            product_id:product_id
        },
        success: function (data, status) {
            var response = JSON.parse(data)
            if(response.status == "success"){
                var product = response.data
                $("#product-name").text(product["product_name"])
                $("#buying-price").text(product["buying_price"])
                $("#id").val(product["id"])
                $("#sku").val(product["sku"])
            }
            $("#prepare-product").modal("show")
        },
        error: function (data, status) {
            console.log("Error")
            // $("#prepare-product").modal("show")
        }
    });
}


function sellingPrice(expense, profit_margin){
    var buying_price = $("#buying-price").text()
    console.log(buying_price + expense + profit_margin)
    var selling_price = Number(buying_price) + Number(expense)+ Number(profit_margin)
    $("#selling-price").text(selling_price)
}

function prepareSubmit(){
    var id = $("#id").val()
    var fraction = $("#fraction").val()

    //Non-fraction whole number breaks php script ie division by zero
    if(fraction.indexOf("/") > -1){
        fraction = fraction.split("/")
        fraction = Number(fraction[0])/ Number(fraction[1])
    }else if(fraction.isNaN()){
        fraction = null
    }else{
        fraction = fraction
    }

    // console.log(fraction)
    var selling_price = Number($("#selling-price").text())
    var buying_price = Number($("#buying-price").text())
    var sku = $("#sku").val()
    var id = $("#id").val()
    var quantity = $("#amount").val()

    if(selling_price != "" && fraction != "" && quantity != "" && fraction != null){
        $.ajax({
            type: "post",
            url: "prepare_sale.php",
            data: {
                product_id:id,
                fraction:fraction,
                buying_price:buying_price,
                selling_price:selling_price,
                sku:sku,
                quantity:quantity,
            },
            success: function (data, status){
                // console.log(data)
                var response = JSON.parse(data)
                if(response.status == "success"){
                    $(".op").html(`<div class="alert alert-success">${response.message}</div>`)
                    $("#prepare-product").modal("hide")
                    setTimeout(function(){
                        location.href="../supplier/index.php"
                    }, 1000)
                }else if(response.status == "error"){
                    $(".op").html(`<div class="alert alert-danger">${response.message}</div>`)
                    $("#prepare-product").modal("hide") 
                }
            },
            error: function(data){
                // console.log("Errors..")
                $(".op").html(`<div class="alert alert-danger">Error! Could not prepare this product for sale</div>`)
                $("#prepare-product").modal("hide")  
            }
        });
    }else{
        $("#prepare-error").html(`<div class="alert alert-danger">Error! One or more key fields are empty</div>`)
    }
}

function suspendProduct(id) {
    var product_id = id
    //TO DO Add product status
}

var log = function(){
    // console.log("Clicked")
}

var imagesPreview = function(input, placeToInsertImagePreview, type) {
    $(placeToInsertImagePreview).html(``) //Clear Displaye after every Image selection..
    if (input.files) {
        // console.log(input.files)
        var action = type == "add" ? "deleteImageBtn" : "deleteEditImageBtn" ;
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            var count = 0;
            reader.onload = function(event) {
                var imgContainer = $($.parseHTML(`<div class="imgContainer col-md-3">`))

                var image = $($.parseHTML('<img class="previewImg m-1" width=100 height=100>')).attr('src', event.target.result)
                image.appendTo(imgContainer);

                var deleteBtn = $($.parseHTML(`<div class="btn btn-sm btn-outline-danger ${action} w-100" img-name="${images[i]}"  style="cursor:pointer"><span class="fa fa-trash m-auto"></span></div>`)).attr('data-id', count);
                deleteBtn.appendTo(imgContainer);

                imgContainer.appendTo(placeToInsertImagePreview);
                count += 1;
            }

            reader.readAsDataURL(input.files[i]);
            input.files[i]["isvalid"] = true; //A check to confirm which image actually gets send to backend for processing.
        }

    }
};


$(document).ready(function () {
    //Populate Inventory Table with Products
    readAll()

    $("#search").keyup(function () {
        var search_key = $("#search").val()
        if(search_key != ""){
            searchProduct(search_key)
        }else{
            readAll()
        }
    }) 

    $("#prepare-submit").click(function(){
        prepareSubmit()
    })

    $("#purchases").on("mouseenter", function () {
        $("#purchases").addClass("show")
        $("#purchases > .dropdown-menu").addClass("show")
    })

    $("#purchases").on("mouseleave", function () {
        // console.log("Leave")
        $("#purchases").removeClass("show")
        $("#purchases > .dropdown-menu").removeClass("show")
    })

    $("#sales").on("mouseenter", function () {
        $("#sales").addClass("show")
        $("#sales > .dropdown-menu").addClass("show")
    })

    $("#sales").on("mouseleave", function () {
        // console.log("Leave")
        $("#sales").removeClass("show")
        $("#sales > .dropdown-menu").removeClass("show")
    })

    $("#servicesbtn").focus(function () {
        $(this).css({ "outline": "none", "border-radius": "50%" })
    })

    $("#servicesbtn").focusout(function () {
        $(this).css({ "outline": "none", "border-radius": "0%" })
    })

    $('#images').on('change', function() {
        editPrepare()
        imagesPreview(this, '#previewTab', "add");
    });


    $('#edit-images').on('change', function() {
        editPrepare()
        imagesPreview(this, '#editPreview', "edit");
    });
})

//Removing images from add product modal view 
$(document).on("click", ".deleteImageBtn", function(){
    var image = $(this).attr("data-id")
    $(this).parent(".imgContainer").remove()
    var images = document.getElementById("images").files
    images[image]["isvalid"] = false
})

//Removing images from edit Product modal view
$(document).on("click", ".deleteEditImageBtn", function(){
    var image = $(this).attr("data-id")
    $(this).parent(".imgContainer").remove()
    var images = document.getElementById("edit-images").files
    images[image]["isvalid"] = false
})



//Removing images from edit product modal view 
$(document).on("click", ".deleteUploadedImageBtn", function(){
    var imageName = $(this).attr("img-name")
    var productId = $("#edit-id").val()
    deleteUploadedImage(imageName, productId)

})

//Insert Event listener after an AJAX call
$(document).ajaxComplete(function(){
    $(".delete-btn").click(function () {
        var id = $(this).attr("data-id")
        deleteProduct(id)
    })

    $(".prepare-btn").click(function(){
        var id = $(this).attr("data-id")
        prepareProduct(id)
    })

    $("#profit-margin").focusout(function(){
        var expense = $("#expenses").val()
        var profit_margin = $("#profit-margin").val()
        sellingPrice(expense, profit_margin)
    })

    // $('#edit_modal').on('hidden.bs.modal', function () {
    //     $("#edit-name").val("")
    //     $("#edit-description").val("")
    //     $("#edit-brand").val("")
    //     $("#edit-unit_price").val("")
    //     $("#edit-quantity").val("")
    //     $("#edit-unit_description").val("")
    //     $("#edit-sku").val("")
    //     $("#edit-size").val("")
    //     $("#edit-color").val("")
    //     // $("input[name='available']:checked").val()
    //     $("#other").val("")
    // })

    $("#edit-submit").on("click", editSubmit)

    $(".edit-btn").click(function () {
        var id = $(this).attr("data-id")
        editPrepare(id)
        //Open Edit modal
        $("#edit_product").modal("show")        
    })

    $("#add-submit").click(function () {
        addProduct()
    })
 
});

