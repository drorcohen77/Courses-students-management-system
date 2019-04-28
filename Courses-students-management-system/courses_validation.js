function add_crs_validation(event) {
    event.preventDefault();

    clean_a();

    var name = document.getElementById('name').value;
    var course_id = document.getElementById('courseid').value;
    var image = document.getElementById('fupload').files[0];
   
    var reg1 = new RegExp('^[a-z]+$');
    var reg2 = new RegExp(/[\/.](gif|jpg|jpeg|tiff|png)$/i);


    if (name == "") {
        document.getElementById('name_massage').innerHTML = "**Please Fill Course Name";
        return false;
    }

    if (course_id == "") {
        document.getElementById('id_massage').innerHTML = "**Please Fill Course ID";
        return false;
    }

    if (image) {

        if (!reg2.test(image.type)) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, Only JPG, JPEG, PNG & GIF Files Are Allowed.";
            return false;
        }

        if (image.size > 500000) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, Only Files With Size Less Than 500kb Are Aloud.";
            return false;
        }
    }

    for (e = 0; e < courses.length; e++) {

        if (name == courses[e].name) {
            document.getElementById('name_massage').innerHTML = "**The Name Of The Course You Entered Is Already Exists!";
            return false;
        }

        if (course_id == courses[e].course_id) {
            document.getElementById('id_massage').innerHTML = "**The Course ID You Entered Is Already Exists!";
            return false;
        }
    }

    document.getElementById('submit_form').submit();

}


function edit_crs_validation(event) {
    event.preventDefault();

    clean_e();

    var id = document.getElementById('course_id').value;
    var name = document.getElementById('name').value;
    var image = document.getElementById('fupload').files[0];
    //var form = event.target;

    var reg1 = new RegExp('^[a-z]+$');
    var reg2 = new RegExp(/[\/.](gif|jpg|jpeg|tiff|png)$/i);


    if (name == "") {
        document.getElementById('name_massage').innerHTML = "**Please Fill Course Name";
        return false;
    }

    if (course_id == "") {
        document.getElementById('id_massage').innerHTML = "**Please Fill Course ID";
        return false;
    }

    if (image) {

        if (!reg2.test(image.type)) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, Only JPG, JPEG, PNG & GIF Files Are Allowed.";
            return false;
        }

        if (image.size > 500000) {
            document.getElementById('fupload_massage').innerHTML = "** Sorry, Only Files With Size Less Than 500kb Are Aloud.";
            return false;
        }
    }

    for (e = 0; e < courses.length; e++) {

        if (name == courses[e].name) {
            document.getElementById('name_massage').innerHTML = "**The Name Of The Course You Entered Is Already Exists!";
            return false;
        }
    }

    document.getElementById('submit_form').submit();
}


function clean_a() {
    document.getElementById('name_massage').innerHTML = "";
    document.getElementById('id_massage').innerHTML = "";
    document.getElementById('fupload_massage').innerHTML = "";

}

function clean_e() {
    document.getElementById('name_massage').innerHTML = "";
   
//    if (document.getElementById('fupload_massage'))
        document.getElementById('fupload_massage').innerHTML = "";

}
