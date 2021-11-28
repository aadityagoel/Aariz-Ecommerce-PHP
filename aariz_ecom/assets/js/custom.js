

/*-----------------------------------------------
    21 Contact Form Submit
-------------------------------------------------*/
function send_message() {
    // alert("hii");
    jQuery('.validation').html('');

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var message = jQuery("#message").val();
    var is_error= '';

    
    if(name==""){
        jQuery('#name-error').html("Please enter Name")
        is_error = 1;
    }
    if(email==""){
        jQuery("#email-error").html("Please enter Email");
        is_error = 1;
    }
    if(mobile==""){
        jQuery("#mobile-error").html("Please enter Mobile");
        is_error = 1;
    }
    if(message==""){
        jQuery("#message-error").html("Please enter Message");
        is_error = 1;
    }

    if(is_error == ''){
        jQuery.ajax({
            url:'send_message.php',
            type:'POST',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
            success:function (result) {
                alert(result);
            }

        });
    }

   
}


/*-----------------------------------------------
    22 Register Form Submit
-------------------------------------------------*/
function user_register() {

    jQuery('.validation').html('');

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var password = jQuery("#password").val();

    var is_error = '';
    

    if(name==""){
        jQuery('#name-error').html("Please enter Name");
        is_error = 1;
    }
    if(email==""){
        jQuery("#email-error").html("Please enter Email");
        is_error = 1;
    }
    if(mobile==""){
        jQuery("#mobile-error").html("Please enter Mobile");
        is_error = 1;
    }
    if(password==""){
        jQuery("#password-error").html("Please enter Password");
        is_error = 1;
    }
    
    if(is_error == ''){
        jQuery.ajax({
            url:'register_submit.php',
            type:'POST',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function (result) {
                if(result == "Present"){
                    jQuery("#email-error").html("Email Already Exist!!! Please Login.");
                }
                if(result == "Not Present"){
                    $(".register-msg p").addClass("success");
                    jQuery(".register-msg p").html("Thank You For Registration");
                    jQuery("#name").val('');
                    jQuery("#email").val('');
                    jQuery("#mobile").val('');
                    jQuery("#password").val('');
                }
                // alert(result);
            }

        });
    }

}



/*-----------------------------------------------
    23 User Login
-------------------------------------------------*/
function user_login() {

    jQuery('.validation').html('');

    var email = jQuery("#login_email").val();
    var password = jQuery("#login_password").val();

    var is_error = '';
    

    if(email==""){
        jQuery("#login_email-error").html("Please enter Email");
        is_error = 1;
    }
    if(password==""){
        jQuery("#login_password-error").html("Please enter Password");
        is_error = 1;
    }
    
    if(is_error == ''){
        jQuery.ajax({
            url:'login_submit.php',
            type:'POST',
            data:'email='+email+'&password='+password,
            success:function (result) {
                if(result == "wrong"){
                    $(".login_msg p").addClass("error");
                    $(".login_msg p").html("Please enter valid login details");
                }
                if(result == "right"){
                    window.location.href = window.location.href;
                }
                // alert(result);
            }

        });
    }

}






/*-----------------------------------------------
    23 Add to cart
-------------------------------------------------*/
function manage_cart(pid,type,quty) {
    if(quty == null){
        if(type == 'update'){
            var qty = $("#"+pid+"-qty").val();
        }else{
            var qty = jQuery("#qty").val();
        }
    }else{
        var qty = quty;
    }
    
    
    jQuery.ajax({
        url:'manage_cart.php',
        type:'POST',
        data:'pid='+pid+'&qty='+qty+'&type='+type,
        success:function (result) {
            if(type == 'update' || type == 'remove'){
                location.reload();
            }else{
                $('.htc__qua').html(result);
            }
            //add
            
            // alert(result);
        }

    });
}



/*-----------------------------------------------
    23 Product sorting
-------------------------------------------------*/

function sort_product_drop(cat_id, site_path) {
    var sort_product_id = jQuery('#sort_product_id').val();
    
    //#region Future use only
    // $.ajax({
    //     type: 'POST',
    //     url : site_path+"categories.php?id="+ cat_id +"&sort=" + sort_product_id,
    //     dataType: "json",			
    //     data:{id:cat_id, sort:sort_product_id},
    //     success: function (data) {
    //         alert(data);
    //     }
    // });
    //#endregion

    window.location.href=site_path+"categories.php?id="+ cat_id +"&sort=" + sort_product_id;
}