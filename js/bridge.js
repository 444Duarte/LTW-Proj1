$('#Reg').submit(function(ev) {
		ev.preventDefault(); // to stop the form from submitting
		    /* Validations go here */
        var username = document.forms["Registo"]["username"].value;
        var password = document.forms["Registo"]["password"].value;
        var repPassword = document.forms["Registo"]["repPassword"].value;

        if(password == "" || username == "") {
            swal("Oops...", "You didn't fill one of the fields.", "error");
            return false;
        }

        if (password !== repPassword) {
            swal("Oops...", "The passwords don't match.", "error");
            return false;
        }
        
        $.post(
            'php/register.php',
            {
                'username' : username,
                'password' : password
            },
            function(data) {
                var response = data['register'];
                switch(response) {
                    case 'user_exists':
                        swal("Register failed.", "That username already exists.");
                        break;
                    case 'success':
                        swal("Register successfull.", "Success.");
                        break;
                    default:
                        //displayError("Error while processing the login...");
                        break;
                }
        }).fail(function(error) {
                return false;
            });
});

function showForm(value) {
    if (value == 1) {
        document.getElementById("LogForm").style.display="block";
        document.getElementById("Log").style.display="none";
    }
    else document.getElementById("LogForm").style.display="none";
}

$("#LogForm").submit(function(ev){
    ev.preventDefault();

    var username = document.forms["Login"]["username"].value;
    var password = document.forms["Login"]["password"].value;

    if (password == "" || username == "") {
        swal("Oops...", "You didn't fill one of the fields.", "error");
        return false;
    }

    $.post(
        'php/login.php',
        {
        'username' : username,
        'password' : password
        },
        function(data) {
            var response = data['login'];
            switch(response) {
                case 'wrong_login':
                    swal("Login failed, the username doesn't exist.", "Try again.");
                    break;
                case 'success':
                    swal("Login successfull.", "Success.");
                    window.location.href="mainpage.php?event=0";
                    break;
                default:
                    //displayError("Error while processing the login...");
                    break;
            }
    }).fail(function(error) {
                return false;
        });              
});

$('#searchForm').submit(function(ev) {
    ev.preventDefault();

    var search=$("#search-bar").val();

    $.post(
        'php/search.php',
        {
            'search' : search
        },
        function(data) {
            var response = data['search'];
            switch(response) {
                case 'wrong_search':
                swal("An event with that title doesn't exist.", "Try again.");
                break;
                case 'success':
                swal("Search successfull", "Success.");
                break;
                default:
                break;
            }
        }).fail(function(error) {
            return false;
        });
});

 $('#create').submit(function(ev) {
        ev.preventDefault();

        formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "../php/createEvent.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var data=JSON.parse(response);
                switch (data) {
                    case 'Success':
                        swal("Event created with success.", "Success.");
                        break;
                    case 'Failure':
                        swal("Event creation failed.", "Insuccess.");
                        break;
                    default:
                        break;
                }
            },
            error: function(errResponse) {
                console.log(errResponse);
            },
            complete: function() 
            {
                location.reload();
            }
    });
});

$('#edit').submit(function(ev) {
    ev.preventDefault();

    formData = new FormData(this);

    formData.append('idEvent', 0); //mudar para ir buscar ao url

    $.ajax({
            type: "POST",
            url: "../php/editEvent.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var data=JSON.parse(response);
                switch (data) {
                    case 'Success':
                        swal("Event created with success.", "Success.");
                        break;
                    case 'Failure':
                        swal("Event creation failed.", "Insuccess.");
                        break;
                    default:
                        break;
                }
            },
            error: function(errResponse) {
                console.log(errResponse);
            },
            complete: function() 
            {
                location.reload();
            }
    });
});