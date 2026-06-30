$(".sign-out").on("click", function(e){
    e.preventDefault();
    console.log("here");
    $.ajax({
        url: "signout.php",
        success: function(data){
            if(data == "Success")
                window.location.href = "login.php";
        }
    });
    
});