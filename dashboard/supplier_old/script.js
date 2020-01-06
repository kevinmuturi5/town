



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
})