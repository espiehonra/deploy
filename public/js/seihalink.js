$( document ).ready(function() {
    $('#btnSavePass').click(function(){
        $("#panelbottomMsg").hide();
        var errors = ["Error/s:<br>"];
        var errorCtr=0,msg;
        var empno=$("#empno").val();
        var cpassword=$("#cpassword").val();
        var password=$("#password").val();
        var passwordconfirm=$("#password-confirm").val();
        if(!$.trim(cpassword).length) {
            errorCtr++;errors.push("Current password field is required.<br>");
        }
        if(!$.trim(password).length) {
            errorCtr++;errors.push("Password field is required.<br>");
        }else{
            if(password!=passwordconfirm){
                alert(password+"---"+passwordconfirm)
                errorCtr++;errors.push("Passwords do not match.<br>");
            }else{
                if(password.length<6){
                    errorCtr++;errors.push("Password must be more than 6 characters in length.<br>");
                }
            }
        }
        if(errorCtr>0){
            $("#panelbottomMsg").show();
            msg="<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+errors+"</div>";
            $("#panelbottomMsg").html(msg);
        }else{
            $.ajax({
                url: '/chkpword{empno}',
                type: 'GET',
                data: { 'empno': empno,'cpassword':cpassword,'password':password },
                success: function (response) {
                    $("#panelbottomMsg").show();
                    if(response==1){ 
                        var msg="<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Successfully changed password. You can login now <a href='login' >here</a> with your new password</div>";
                       $("#panelbottomMsg").html(msg);
                    } else if(response==0) { 
                        var msg="<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You entered an invalid current password. Please try again.</div>";
                        $("#panelbottomMsg").html(msg);
                    } else {
                        var msg="<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You must not use your current password as your new password.</div>";
                        $("#panelbottomMsg").html(msg);
                    }
                }
            });
        }



    });

});

