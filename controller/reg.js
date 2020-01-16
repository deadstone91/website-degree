function accountValidation(){

    var f = $('#modal-firstname').val().trim();
    var s = $('#modal-surname').val().trim();
    var e = $('#modal-email').val().trim();
    var u = $('#modal-username').val().trim();
    var m = $('#modal-mobile').val().trim();
    var p1 = $('#modal-password1').val().trim();
    var p2 = $('#modal-password2').val().trim();

    //console.log(p1 + "\n" + p2);
        var fail = true;

        if(f === "")
        {
            fail =false;
        }else{
            if(!isNaN(f))
            {
                alert("Firstname is not a valid name");
            }
        }
        if(s === "")
        {

            fail =false;
        }}else{
    if(!isNaN(f))
    {
        alert("Surname is not a valid name");
    }
}
        if(e === "")
        {

            fail =false;
        }
        if(u === "")
        {
        //return false;
        if (confirm("username is empty,\nso you want to use email for username?")) {

            $('#modal-username').val(e);
        } else {
            fail =false;
        }
    }

    if(m === "")
    {
        fail =false;
    }else{
        if(m.length != 11)
        {
            alert("mobile number length does not seem to be correct");
        }
    }
    if(p1 === "")
    {
        fail =false;
    }else{
        if(p1.length < 8 )
        {
            alert("Password to short, please ensure a least 8 characters long")
        }

    }
    if(p2 === "")
    {
        fail =false;
    }

    if(p1 !== p2)
    {
        alert('passwords don\'t match');
    }

    if(fail === false)
    {
        alert('data missing');
        return fail;
    }
}





