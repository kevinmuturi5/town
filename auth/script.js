function update_password(old_password,new_password,user_mail){
    var oldpass = old_password;
    var newpass = new_password;
    var user_email = user_mail;
    $.ajax({
        type: "get",
        url: "updatepass.php",
        data:{
            oldpass:oldpass,
            newpass:newpass,
            user_email:user_email
        },
        success: function (data, status) {
            var response = JSON.parse(data)
            console.log(response)
            for(var feedback in response){
                switch (feedback) {

                    case "newpass_err":
                        if (response.newpass_err !=""){
                            $("#newpass").removeClass('is-valid');
                            $("#newpass").addClass('is-invalid');
                            $("#newerr").html(`<div class="text-danger text-small">${response.newpass_err}</div>`);

                        } else{
                            $("#newpass").removeClass('is-invalid');
                            $("#newpass").addClass('is-valid');
                            $("#newerr").html(`<div class="text-danger text-small"></div>`)
                        }
                        break;
                        
                    case "oldpasserr":
                        if (response.oldpasserr !=""){
                            $("#oldpass").removeClass('is-valid');
                            $("#oldpass").addClass('is-invalid');
                            $("#olderr").html(`<div classs="text-danger text-small">${response.oldpasserr}</div>`);
                        } else {
                            $("#oldpass").removeClass('is-invalid');
                            $("#oldpass").addClass('is-valid');
                            $("#olderr").html(`<div classs="text-danger text-small"></div>`);
                        }
                        break;

                    case "usermailerr":
                        if (response.usermailerr != ""){
                            $("#msg").html(`<div class="alert alert-danger">${response.usermailerr}</div>`);

                        }
                        break;
                        

                    case "status":
                        if(response[feedback] == "success"){
                            $("#msg").html(`<div class="alert alert-success">${response.message}</div>`);
                            $("html").animate({scrollTop:0}, "slow");
                            window.setTimeout(function () {
                                location.href = "login.php";
                            }, 5000);

                        }else {
                            $("#msg").html(`<div class="alert alert-warning">Correct the errors below and try again</div>`);
                            $("html").animate({scrollTop: 0}, "slow");
                        }
                        break;


                }
            }

        }
    })
}




$(document).ready(function(){
    $("#servicesbtn").click(function(){
        if($(this).attr("class") == "expanded"){
            console.log("Expanded");
            $(this).attr("class", "collapsed");
            $("#services").css("display", "none")            
        }else{
            console.log("Collapsed");
            $(this).attr("class", "expanded");
            $("#services").css("display", "block")            
        }

    })

    $("#changepass").click(function () {
        var old_password = $("#oldpass").val();
        var new_password = $("#newpass").val();
        var user_email = $("#email").attr("value");
        if (old_password != "" && new_password != "" && user_email !="") {
            update_password(old_password, new_password, user_email)
        }
    })
});
