function readAll() {
    var output = ``;
    var count = 1;
    $.ajax({
        type: "get",
        url: "read_all.php",
        success: function (data, status) {
            // console.log(data)
            var response = JSON.parse(data)
            if (response.status == "success") {
                var read = response.data;
                for (var i in read) {
                    output += `
                    <tr class='text-center'>
                        <td>${count}</td>
                            <td>${read[i]["supplier_name"]}</td>
                            <td>${read[i]["pin"]}</td>
                            <td>${read[i]["supplier_location"]}</td>                     
                            <td>${read[i]["product_name"]}</td>
                            <td>${read[i]['receipt_number']}</td>
                            <td>${read[i]["description"]}</td>
                            <td>${read[i]["quantity"]}</td>
                            <td>${read[i]["unit_price"]}</td>
                            <td>${read[i]["total_price"]}</td>
                            <td>${read[i]["vat"]}</td>
                            <td>${read[i]["sub_total"]}</td>
                            <td>${read[i]["date"]}</td>
                            <td>${read[i]["time"]}</td>
                            <td>${read[i]["sku"]}</td> 
                            <td><button class="btn btn-danger" id='${read[i]["id"]}'>Delete</button></td> 
                                     
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-info">${count > 1 ? count - 1 : count }</span> Purchases done</td>
                </tr>
                `;
                $("#table_result").html(output)
            }



        }

    });
}

function searchPurchase(keyword) {
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
             console.log(data)
            var response = JSON.parse(data)
            if(response.status == "success"){
                var purchase = response.data;
                for(var i in purchase){
                    output += `
                    <tr class='text-center'>
                        <td>${count}</td>
                            <td>${purchase[i]["supplier_name"]}</td>
                            <td>${purchase[i]["pin"]}</td>
                            <td>${purchase[i]["supplier_location"]}</td>                     
                            <td>${purchase[i]["product_name"]}</td>
                            <td>${purchase[i]["receipt_number"]}</td>
                            <td>${purchase[i]["description"]}</td>
                            <td>${purchase[i]["quantity"]}</td>
                            <td>${purchase[i]["unit_price"]}</td>
                            <td>${purchase[i]["total_price"]}</td>
                            <td>${purchase[i]["vat"]}</td>
                            <td>${purchase[i]["sub_total"]}</td>
                            <td>${purchase[i]["date"]}</td>
                            <td>${purchase[i]["time"]}</td>
                            <td>${purchase[i]["sku"]}</td>  
                            <td><button class="btn btn-danger" id='${purchase[i]["id"]}'>Delete</button></td>
                            </tr>             
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-info">${count>1 ? count-1 : count }</span> Purchases done</td>
                </tr>
                `;
                $(".op").html(`<div class=" mt-2 alert alert-success">Success ${count>1 ? count-1 : count } Purchase found </div>`)
                $(".op").effect("bounce", { times: 3 }, 300);
                $("#table_result").html(output)

            }else{
                $(".op").html(`<div class=" mt-2 alert alert-danger">Purchase Not found</div>`)
                $(".op").effect("bounce", { times: 1 }, 300);
            }
        }
    });
}

//Load Modal With Supplier data
function SupplierDetails(pin) {

    supplier_pin = pin
    $.ajax({
        type: "get",
        url: "getdetails.php",
        data: { supplier_pin: supplier_pin },
        success: function (data, status) {
            var response = JSON.parse(data)
            console.log(response)
            console.log(response)
            if (response.status == "success") {
                response = response.data[0]
                $("#pin").val(response.pin)
                $("#name").val(response.name)
                $("#tel").val(response.phone)
                $("#mail").val(response.email)
                $("#loc").val(response.location)
            }else{
                $("#error").html(`<div class="alert alert-warning">Supplier KRA Pin does not exist. Please enter data to register</div>`)
                $("#error").effect("bounce", {times:3}, 300 )
            }
        }
    });
}

//Load Modal With Product data
function productDetails(sku) {

    product_sku = sku
    $.ajax({
        type: "get",
        url: "product_details.php",
        data: { product_sku: product_sku },
        success: function (data, status) {
            var response = JSON.parse(data)
            console.log(response)
            if (response.status == "success") {
                response = response.data[0]
                $("#product_code").val(response.sku)
                $("#prod").val(response.name)
                $("#description").val(response.description)
                }else{
                $("#error").html(`<div class="alert alert-warning">Product does not exist. Please enter data to register</div>`)
                $("#error").effect("bounce", {times:3}, 300 )
            }
        }
    });
}

function addPurchase(){
    var pin = $("#pin").val()
    var supplier_name = $("#name").val()
    var receipt = $("#receipt").val()
    var supplier_phone_number = $("#tel").val()
    var supplier_email = $("#mail").val()
    var location = $("#loc").val()
    var sku = $("#product_code").val()
    var product_name = $("#prod").val()
    var description = $("#description").val()
    var quantity = $("#quantity").val()
    var unit_description = $("#unit_description").val();
    var unit_price =$("#unit_price").val();
    var total_price = $("#price").val()
    var vat = $("#vat").val()
    var date = $("#date").val()
    var time = $("#time").val()


       if(supplier_name == "" || product_name == ""){
        $("#error").html(`<div class="alert alert-danger">Error! Add a Supplier name and Product name to proceed</div>`)
        $("#error").effect("bounce", {times:3}, 300 )
    }else{

        var formData= new FormData()
        formData.append('KRA_pin',pin);
        formData.append('supplier_name', supplier_name);
        formData.append('supplier_phone_number', supplier_phone_number);
        formData.append('supplier_email',supplier_email);
        formData.append('location',location);
        formData.append('sku', sku);
        formData.append('product_name',product_name);
        formData.append('receipt_number', receipt);
        formData.append('description', description);
        formData.append('quantity', quantity);
        formData.append('unit_description',unit_description);
        formData.append('unit_price',unit_price);
        formData.append('total_price', total_price);
        formData.append('vat',vat);
        formData.append('date_of_purchase', date);
        formData.append('time_of_purchase', time);


        for(var pair of formData.entries()) {
            console.log(pair[0]+ ', '+ pair[1]);
        }

        $.ajax({
            type: "post",
            url: "addpurchase.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status){
                console.log(data)
                var response = JSON.parse(data);
                if(response.status == "success"){
                    var total = quantity * unit_price;
                    var subt;
                    var vt;
                    if (vat != ""){
                        vat = vt;
                        subt = total - vt;

                    }else {
                        subt = total * (100/116);
                        vt = total - subt;
                    }

                    $("#purchaseModal").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                    setTimeout(function(){
                        location.href = "index.php"
                    }, 500); 
                    // $("#purchaseModal")[0].reset();
                }else if(response.status == "error"){
                    $("#purchaseModal").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                }
                console.log(data)
            },
            error: function(){
                console.log(data)

            }
        })
    }
}

function deleteProduct(id) {
    var deleteConfirmation = confirm("This Purchase will be deleted permanently")

    if (deleteConfirmation){
        $.ajax({
            type: "post",
            url: "delete_purchase.php",
            data: {
                purchase_id: id
            },
            success: function (data, status) {
                var response = JSON.parse(data)
                if (response.status == "success") {
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect("bounce", { times: 3 }, 300);
                    window.location = "index.php"

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

$(document).ready(function () {

    readAll()

    $("#search").keyup(function () {
        var search_key = $("#search").val()
        if(search_key != ""){
            searchPurchase(search_key)
        }else{
            readAll()
        }
    })

       $("#addPurchase-btn").on("click",function (event) {
        event.preventDefault()
        $("#purchaseModal").modal("show")
    })

    $("#purchase-btn").click(function (e) {
        e.preventDefault()
        addPurchase()

    })

    $("#search-btn").on("click",function (e) {
        e.preventDefault()
        var search_key = $("#search").val()
        if(search_key != ""){
            searchPurchase(search_key)
        }else{
            readAll()
        }

    })

    $("#pin").focusout(function () {
        var spin = $("#pin").val()
        if (spin != ""){
            SupplierDetails(spin)
        }
    })

    $("#product_code").focusout(function () {
        var prod_code = $("#product_code").val()
        if (prod_code != ""){
            productDetails(prod_code)
        }
    })

})

$(document).on("click",".btn-danger", function(){
     var purchase_id = $(this).attr("id")
    deleteProduct(purchase_id)


})