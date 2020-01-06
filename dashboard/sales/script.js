function readAll(){
    $.ajax({
        type: "get",
        url: "readAll.php",
        success: function (data, status) {
            var response = JSON.parse(data)
            // console.log(response.data[3030])
            var output = ``
            if(response.status == "success"){
                
                for(var i in response.data){
                    var receipt = response.data[i]
                    console.log(receipt.length)

                    // console.log(sale)
                    
                    var target="ts"+i
                    output += `
                    <tr class="text-left">
                    <td id="toggle" data-toggle="collapse" classs="closed" data-target=".${target}">`
                    if(receipt.length > 1){
                        output += `<i class="fa fa-plus mr-1"></i>`
                    }else{
                    }
                    output += `${i}</td>
                    <td>
                        <ul>
                        <li>${receipt[0].product_name}</li>
                        <div class="${target} collapse out">`

                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            console.log(receipt[j])
                            let sale = receipt[j]
                            output += `
                            <li>${sale.product_name}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>`

                    // console.log(receipt[(receipt.length - 1)])
                        output += `<td>
                                <ul>
                                    <li>${response.data[i][0].quantity}</li>
                                    <div class="${target} collapse out">`

                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            let sale = receipt[j]
                            output += `
                            <li>${sale.quantity}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>`

                        output += `<td>
                                <ul>
                                    <li>${response.data[i][0].fraction}</li>
                                    <div class="${target} collapse out">`

                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            let sale = receipt[j]
                            output += `
                            <li>${sale.fraction}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>`

                        output += `<td>
                            <ul>
                                <li>${response.data[i][0].unit_price}</li>
                                <div class="${target} collapse out">`
                                    
                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            let sale = receipt[j]
                            output += `
                            <li>${sale.unit_price}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>`
                            
                        output += `<td>
                            <ul>
                                <li>${response.data[i][0].sku}</li>
                                <div class="${target} collapse out">`
                        
                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            let sale = receipt[j]
                            output += `
                            <li>${sale.sku}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>`
                        output += `<td>
                            <ul>
                                <li>${response.data[i][0].vat}</li>
                                <div class="${target} collapse out">`
                        
                    if(receipt.length > 1){
                        for(var j=1; j<receipt.length; j++){
                            let sale = receipt[j]
                            output += `
                            <li>${sale.vat}</li>`
                            console.log(output)
                        }
                    }else{

                    }
                    output += `</div>
                    </ul>
                    </td>` 
                        output +=`
                        <td><button class="btn btn-outline-danger btn-sm delete-btn" data-id="${i}">Delete</button></td>
                    </tr>
                        `                     
                        
                    }   
                // console.log(output)
            }else{
                $(".op").html(`<div class="alert alert-danger mt-2">You have not added sales receipts yet</div>`)
                $(".op").effect( "bounce", {times:3}, 200 );
            }
            
            $("#table-data").html(output)
        }
    });
}


function search(){
    var searchItem = $("#search").val();
    if(searchItem != ""){
        $.ajax({
            type: "get",
            url: "search.php",
            data:{
                product_name:searchItem,
            },
            success: function (data, status){
                var response = JSON.parse(data)
                console.log(response)
                var output = ``
                var count = 0
                if(response.status == "success"){
                    for(var i in response.data){
                        // console.log(response.data[i].length)
                        var receipt = response.data[i]
                        // console.log(sale)
                        var target="ts"+i
                        output += `
                        <tr>
                        <td id="toggle" data-toggle="collapse" classs="closed" data-target=".${target}"><i class="fa fa-minus mr-1"></i>${i}</td>
                        <td>
                            <ul>
                            <li>${receipt[0].product_name}</li>
                            <div class="${target} collapse out">`
    
                        for(var j=0; j<=response.data[i].length; j++){
                            // cons
                            let sale = receipt[j]
                            if(j > 0  && receipt.length > 1 && sale != null){
                                console.log(response.data)
                                output += `
                                <li>${sale.product_name}</li>
                                <li>${receipt[(receipt.length - 1)].product_name}</li>
                                </div>
                                </ul>
                                </td>`
                            }else{
                                continue
                            }
                        }
                        // console.log(receipt[(receipt.length - 1)])
                            output += `<td>
                                    <ul>
                                        <li>${response.data[i][0].quantity}</li>
                                        <div class="${target} collapse out">`
    
                            for(var j=1; j<=response.data[i].length; j++){
                                let sale = receipt[j]
    
                                if(j > 0  && receipt.length > 1 && sale != null){
                                    output += `
                                        <li>${sale.quantity}</li>
                                        <li>${receipt[(receipt.length - 1)].quantity}</li>
                                        </div>
                                        </ul>
                                        </td>`
                                    }
                            }
    
                            output += `<td>
                                    <ul>
                                        <li>${response.data[i][0].fraction}</li>
                                        <div class="${target} collapse out">`
    
                            for(var j=1; j<=response.data[i].length; j++){
                                let sale = receipt[j]
    
                                if(j > 0  && receipt.length > 1 && sale != null){
                                    output += `
                                        <li>${sale.fraction}</li>
                                        <li>${receipt[(receipt.length - 1)].fraction}</li>
                                        </div>
                                        </ul>
                                        </td>`
                                    }
                            }
    
                            output += `<td>
                                <ul>
                                    <li>${response.data[i][0].unit_price}</li>
                                    <div class="${target} collapse out">`
                                        
                            for(var j=1; j<=response.data[i].length; j++){
                                let sale = receipt[j]
    
                                if(j > 0  && receipt.length > 1 && sale != null){
                                    output += `
                                        <li>${sale.unit_price}</li>
                                        <li>${receipt[(receipt.length - 1)].unit_price}</li>
                                        </div>
                                        </ul>
                                        </td>`
                                    }                                    
                                }
                                
                            output += `<td>
                                <ul>
                                    <li>${response.data[i][0].sku}</li>
                                    <div class="${target} collapse out">`
                            
                            for(var j=0; j<=response.data[i].length; j++){
                                let sale = receipt[j]
    
                                if(j > 0  && receipt.length > 1 && sale != null){
                                    output += `
                                        <li>${sale.sku}</li>
                                        <li>${receipt[(receipt.length - 1)].sku}</li>
                                        </div>
                                        </ul>
                                        </td>`
                                }   
                            }
                            
                            output += `<td>
                                <ul>
                                    <li>${response.data[i][0].vat}</li>
                                    <div class="${target} collapse out">`
                            
                            for(var j=0; j<=response.data[i].length; j++){
                                let sale = receipt[j]
    
                                if(j > 0  && receipt.length > 1 && sale != null){
                                    output += `
                                        <li>${sale.vat}</li>
                                        <li>${receipt[(receipt.length - 1)].vat}</li>
                                        </div>
                                        </ul>
                                        </td>`
                                }   
                            }   
                            output +=`
                            <td><button class="btn btn-outline-danger btn-sm delete-btn" data-id="${i}">Delete</button></td>
                        </tr>
                            `                     
                        count += 1
                        }
                        $(".op").html(`<div class="alert alert-success mt-2">${count} receipt(s) exist with the search keywords</div>`)
                        $(".op").effect( "bounce", {times:3}, 200 );   
                    // console.log(output)
                }else{
                    $(".op").html(`<div class="alert alert-danger mt-2">Zero sale receipts exist with the search keywords</div>`)
                    $(".op").effect( "bounce", {times:3}, 200 );
                }
                
                $("#table-data").html(output)
            }
        });
    }else{
        $(".op").html(``)
        readAll()
    }

}

function deleteSale(receipt) {
    var deleteConfirmation = confirm("This Sale will be deleted permanently from your Inventory")
    var receipt_id = receipt
    if(deleteConfirmation){
        $.ajax({
            type: "get",
            url: "delete_sale.php",
            data: {
                receipt_id: receipt_id
            },
            success: function (data, status) {
                console.log(data)
                var response = JSON.parse(data)
                if(response.status == "success"){
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.data}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                    setTimeout(function(){
                        location = "index.php"
                    }, 1000)

                }else{
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.data}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                }
            }
        });
    }
}


function checkSKU(sku){
    var sku = sku
    $.ajax({
        type: "get",
        url: "check_sale.php",
        data: {
            sku:sku
        },
        dataType: "dataType",
        success: function (data, status) {
            console.log(data)
        }
    });
}

function populateFields(sku,fraction){
    console.log(sku+fraction)
    if(sku != "" && fraction != ""){
        $.ajax({
            type: "get",
            url: "get_ready_sale.php",
            data: {
                sku:sku,
                fraction:fraction
            },
            success: function (data, status) {
                var response = JSON.parse(data)
                if(response.status == "success"){
                    var ready_product = response.data[0]
                    $("#product_name").html(`<span class="text-success">${ready_product["name"]}</span>`)
                    $("#unit_price").html(`<span class="text-success">${ready_product["selling_price"]}</span>`)
                    $("#error").html(``)
                }else{
                    $("#product_name").html(`<span class="text-danger">DNE</span>`)
                    $("#unit_price").html(`<span class="text-danger">DNE</span>`)
                    $("#error").html(`<div class="alert alert-danger">Product Does not exist or is not ready for sale. Confirm this at the Store tab</div>`)
                }
            },
            error: function(data, status){
                console.log(data)
            }
        });
    }
}


function getTotal(){
    $("#total_price").text( Number($("#quantity").val()) * Number($("#unit_price").text()))
}

function addSale(){
    var name = $("#product_name").text()
    var receipt_id = $("#receipt_id").val()
    var unit_price = Number($("#unit_price").text())
    var quantity = $("#quantity").val()
    var sku = $("#sku").val()
    var fraction = $("#fraction").val().split("/")
    fraction = Number(fraction[0]) / Number(fraction[1])
    var vat = $("#vat").val()

    // console.log(name+receipt_id+unit_price+quantity+sku+fraction+vat)
    if(name == "" || sku == "" || receipt_id == "" || quantity == "" || fraction == ""){
        $("#error").html(`<div class="alert alert-danger">Error! Fill in all fields to proceed</div>`);
        $("#error").effect("bounce", { times: 3 }, 300)
    }else{
        var formData= new FormData()
        formData.append('name', name);
        formData.append('receipt_id', receipt_id);
        formData.append('unit_price', unit_price);
        formData.append('quantity', quantity);
        formData.append('vat', vat);
        formData.append('sku', sku);
        formData.append('fraction', fraction);

        // formData.append('availablity', availability);formData.append('other', other);

        // for(var pair of formData.entries()) {
        //     console.log(pair[0]+ ', '+ pair[1]);
        // }

        $.ajax({
            type: "post",
            url: "addsale.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status){
                console.log(data)
                var response = JSON.parse(data);
                if(response.status == "success"){
                    $("#add-modal").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-success">${response.message}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                    setTimeout(function(){
                        location.href = "index.php"
                    }, 2000)
                }else{
                    $("#add-modal").modal("hide")
                    $(".op").html(`<div class=" mt-2 alert alert-danger">${response.message}</div>`)
                    $(".op").effect( "bounce", {times:3}, 300 );
                }
                console.log(response)
            },
            error: function(data){
                console.log(data)

            }
        })
    }
}



$(document).ready(function () {

    readAll()

    // $("#sku").focusout(function(){
    //     check_sale();
    // })  

    $("#add-btn").click(function (event) {
        event.preventDefault()
        $('#add-modal').modal("show");
    })

    $("#add-submit").click(function(){
        addSale()
    })

    $("#sku").focusout(function(){
        var sku = $(this).val()
        var fraction = $("#fraction").val()
        populateFields(sku, fraction)
    })

    $("#fraction").focusout(function(){
        var fraction = $(this).val()
        var sku = $("#sku").val()
        populateFields(sku, fraction)
    })

    $("#quantity").focusout(function(){
        getTotal()
    })

    $("#servicesbtn").focus(function () {
        $(this).css({ "outline": "none", "border-radius": "50%" })
    })

    $("#servicesbtn").focusout(function () {
        $(this).css({ "outline": "none", "border-radius": "0%" })
    })

    $("#search-btn").click(function (e) {
        console.log("searching...")
        e.preventDefault();
        search();
    });

    $("#search").keyup(function() {
        console.log("searching...")
        search();
    });
})


$(document).ajaxComplete(function(){
    $(".delete-btn").click(function () {
        var receipt_id = $(this).attr("data-id")
        deleteSale(receipt_id)
    });
})