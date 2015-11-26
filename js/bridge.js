$('#Reg').submit(function(ev) {
		ev.preventDefault(); // to stop the form from submitting
		    /* Validations go here */
        var username = document.forms["Registo"]["username"].value;
        var password = document.forms["Registo"]["password"].value;

        if(password == "" || username == "") {
            swal("Oops...", "You didn't fill one of the fields.", "error");
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

$("#Log").click(function(ev){
    ev.preventDefault();

    var username = document.forms["Login"]["username"].value;
    var password = document.forms["Login"]["password"].value;
    var repPassword = document.forms["Login"]["repeatPassword"].val;

    if (password == "" || username == "") {
        swal("Oops...", "Something went wrong!", "error");
        return false;
    }

    if (password !== repPassword) {
        swal("Oops...", "The passwords don't match.", "error");
        return false;
    }


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
    this.submit();                 
});