function login(){
    var username=$("#username").val();
    var password=$("#password").val();
    //alert("asdasd");
//    alert(username);
    //alert(password);
        $.ajax({
            type: 'json',
            url: "include/login.php",
            data: {"username": username ,"password" :password},
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
                if(data == "logindone")
                {
                    //alert("login");
                    window.location = 'master.php';
                }
                else
                {
                    //alert("not");
                    document.getElementById("error").innerHTML = "Invalid Username and Password !!! ";

                }
            }
        });


    return false;


}

