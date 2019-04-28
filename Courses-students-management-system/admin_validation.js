function add_validation(event) {
    event.preventDefault();

    clean();


    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    // var role = document.getElementById('role').value;
    var image = document.getElementById('fupload').files[0];

    var reg1 = new RegExp(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g);
    var reg2 = new RegExp('^[-0-9]+$');
    var reg3 = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var reg4 = new RegExp(/[\/.](gif|jpg|jpeg|tiff|png)$/i);


    if (name == "") {
        document.getElementById('name_massage').innerHTML = "**Please Fill Admin Name";
        return false;
    }

    if (!reg1.test(name)) {
        document.getElementById('name_massage').innerHTML = "**Please Enter Only Letters";
        return false;
    }

    if (phone == "") {
        document.getElementById('phone_massage').innerHTML = "**Please Fill Admin Phone";
        return false;
    }

    if (!reg2.test(phone)) {
        document.getElementById('phone_massage').innerHTML = "**Please Enter Only Numbers";
        return false;
    }

    if (phone.length != 11) {
        document.getElementById('phone_massage').innerHTML = "**Please Enter Phone Number Format As xxx-xxxxxxx and Check for 10 Digits!";
        return false;
    }

    if (email == "") {
        document.getElementById('email_massage').innerHTML = "**Please Fill Admin Email";
        return false;
    }

    if (!reg3.test(email)) {
        document.getElementById('email_massage').innerHTML = "**Please Enter Correct Email Format";
        return false;
    }

    if (password == "") {
        document.getElementById('password_massage').innerHTML = "**Please Fill Admin Password";
        return false;
    }

    if (image) {

        if (!reg4.test(image.type)) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }

        if (image.size > 500000) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, only files with size less than 500kb are aloud.";
            return false;
        }
    }


//    for (e = 0; e < admins.length; e++) {
//
//        if (phone == admins[e].phone) {
//            document.getElementById('phone_massage').innerHTML = "**The Phone You Entered Is Already Exists!";
//            return false;
//        }
//
//        if (email == admins[e].mail) {
//            document.getElementById('email_massage').innerHTML = "**The Email You Entered Is Already Exists!";
//            return false;
//        }
//
//        if (password == admins[e].password) {
//            document.getElementById('password_massage').innerHTML = "**The Password You Entered Is Already Exists!";
//            return false;
//        }
//    }

    document.getElementById("submit_form").submit();
}


function edit_validation() {
    event.preventDefault();

    clean();

    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    
    if(role_admin==0)
    var password = document.getElementById('password').value;
    
    var image = document.getElementById('fupload').files[0];

    var reg1 = new RegExp(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g);
    var reg2 = new RegExp('^[-0-9]+$');
    var reg3 = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var reg4 = new RegExp(/[\/.](gif|jpg|jpeg|tiff|png)$/i);


    if (name == "") {
        document.getElementById('name_massage').innerHTML = "**Please Fill Admin name";
        return false;
    }

    if (!reg1.test(name)) {
        document.getElementById('name_massage').innerHTML = "**Please Enter Only Letters";
        return false;
    }

    if (phone == "") {
        document.getElementById('phone_massage').innerHTML = "**Please Fill Admin phone";
        return false;
    }

    if (!reg2.test(phone)) {
        document.getElementById('phone_massage').innerHTML = "**Please Enter Only Numbers";
        return false;
    }

    if (phone.length != 11) {
        document.getElementById('phone_massage').innerHTML = "**Please Enter Phone Number Format As xxx-xxxxxxx and Check for 10 Digits!";
        return false;
    }

    if (email == "") {
        document.getElementById('email_massage').innerHTML = "**Please Fill Admin Email";
        return false;
    }

    if (!reg3.test(email)) {
        document.getElementById('email_massage').innerHTML = "**Please Enter Correct Email Format";
        return false;
    }

    if (password == "") {
        document.getElementById('password_massage').innerHTML = "**Please fill Admin Password";
        return false;
    }

    if (image) {

        if (!reg4.exec(image.type)) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }

        if (image.size > 500000) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, only files with size less than 500kb are aloud.";
            return false;
        }
    }


//    for (e = 0; e < admins.length; e++) {
//
//        if (phone == admins[e].phone && id != admins[e].id) {
//            document.getElementById('phone_massage').innerHTML = "**The Phone You Entered Is Already Exists!";
//            return false;
//        }
//
//        if (email == admins[e].mail && id != admins[e].id) {
//            document.getElementById('email_massage').innerHTML = "**The Email You Entered Is Already Exists!";
//            return false;
//        }
//
//        if (password == admins[e].password && id != admins[e].id) {
//            document.getElementById('password_massage').innerHTML = "**The Password You Entered Is Already Exists!";
//            return false;
//        }
//    }

    document.getElementById('submit_form').submit();
}


function clean() {
    document.getElementById('name_massage').innerHTML = "";
    document.getElementById('phone_massage').innerHTML = "";
    document.getElementById('email_massage').innerHTML = "";
   
//   if(role_admin==0) 
//    document.getElementById('password_massage').innerHTML = "";
    document.getElementById('fupload_massage').innerHTML = "";

}
