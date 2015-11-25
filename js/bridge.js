$('#Reg').submit(function(ev) {
		ev.preventDefault(); // to stop the form from submitting
		    /* Validations go here */
        var username = document.forms["Registo"]["username"].value;
        var password = document.forms["Registo"]["password"].value;

        if(password=="" || username=="") {
            swal("Oops...", "Something went wrong!", "error");
            return false;
        }
        
        $.post(
            '../php/login.php',
            {
                'username' : username,
                'password' : password
            },
            function(data) {
                var response = data['login'];
                switch(response) {
                    case 'wrong_login':
                        swal("Login failed.", "Try again.", "insuccess")
                        break;
                    case 'success':
                        swal("Login successfull.", "success")
                        break;
                    default:
                        //displayError("Error while processing the login...");
                        break;
                }


        })

        /*.fail(function(error) {
                displayError("Error while processing the login...");
            });
        */
        this.submit(); // If all the validations succeeded
});

$("#Log").click(function(){
    swal({   
        title: "Login",   
        text: "",   
        type: "input",
        showCancelButton: true,   
        closeOnConfirm: false,   
        animation: "slide-from-top",   
        inputPlaceholder: "Username" },
        function(inputValue){ if (inputValue === false) return false;      
                if (inputValue === "") {     
                swal.showInputError("You need to write something!");     
                return false   
                }      
        swal({   
            title: "Login",   
            text: "",   
            type: "input",
            showCancelButton: true,   
            closeOnConfirm: false,   
            animation: "slide-from-top",   
            inputPlaceholder: "Password" },
            function(inputValue) {
                if (inputValue === false)
                        return false;      
                            if (inputValue === "") {     
                                swal.showInputError("You need to write something!");     
                                return false   
                            }
            //verificar se a password coincide com a password do username na base de dados
            // se coincidir, entrar
            swal("Nice!", "Password: " + inputValue, "success");

            // se nao coincidir, mostrar inputError 
        });
        // se nao existir, mostrar inputError
        })

    $.post(
            '../php/register.php',
            {
                'username' : username,
                'password' : password
            },
            function(data) {
                var response = data['register'];
                switch(response) {
                    case 'user_exists':
                        swal("Login failed, the username already exists.", "Try again.", "insuccess")
                        break;
                    case 'success':
                        swal("Login successfull.", "success")
                        break;
                    default:
                        //displayError("Error while processing the login...");
                        break;
                }


        });                 
});