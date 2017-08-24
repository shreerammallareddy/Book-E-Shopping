/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validfname()
{
    var name = document.getElementById("fname").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("fnerror").innerHTML = "<font color=red>First Name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("fnerror").innerHTML = "<font color=red>First Name should not contain Digits or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("fnerror").innerHTML = "";
        return true;
    }
}

function validlname()
{
    var name = document.getElementById("lname").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;

    if (name == "" || name == null)
    {
        document.getElementById("lnerror").innerHTML = "<font color=red>Last Name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("lnerror").innerHTML = "<font color=red>Last Name should not contain Digits or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("lnerror").innerHTML = "";
        return true;
    }
}

function validadminname()
{
	var name = document.getElementById("email").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;

    if (name == "" || name == null)
    {
        document.getElementById("emerror").innerHTML = "<font color=red>User name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("emerror").innerHTML = "<font color=red>User name should not contain Digits or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("emerror").innerHTML = "";
        return true;
    }
}

function validpass()
{
    var password = document.getElementById("password").value;
    var pattern = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$/;
    if (password === null || password === "")
    {
        document.getElementById("perror").innerHTML = "<font color=red>Please enter a password</font>";
        return false;
    }
    if (pattern.test(password)) 
	{
		 //alert("no prob");
		 document.getElementById("perror").innerHTML = "";
		 return true;
	}
    if (!pattern.test(password))
    {
        document.getElementById("perror").innerHTML = "<font color=red>Please enter valid password</font>";
        return false;
    }
return true;
}


function validcpass()
{
    var password = document.getElementById("cpassword").value;
    if (password === null || password === "")
    {
        document.getElementById("cperror").innerHTML = "<font color=red>This field is required</font>";
        return false;
    }
	else if (password != document.getElementById("password").value)
	{
		document.getElementById("cperror").innerHTML = "<font color=red>Passwords Does not match</font>";
        return false;
	}
    else if (password == document.getElementById("password").value) {
		document.getElementById("cperror").innerHTML = "";
		return true;
	}
	
}



function validemail() {
    var x = document.getElementById("email").value;
    var pattern = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (x === "" || x === null)
    {
        document.getElementById("emerror").innerHTML = "<font color='red'>Email address cannot be empty</font>";
        return false;
    } else if (!pattern.test(x))
    {
        document.getElementById("emerror").innerHTML = "<font color='red'>Please enter valid Email Address</font>";
        return false;
    } else {
        document.getElementById("emerror").innerHTML = "";
        return  true;
    }

}

function finalValidation()
{
    if (validfname() == true && validlname() == true && validpass() == true && validemail() == true && validcpass()== true)
    {
        return true;
    } else
    {
        alert("Please fill in mandatory fields to proceed further");
        return false;

    }


}

function finalAdminValidation()
{
    if (validadminname() == true && validpass() == true )
    {
        return true;
    } else
    {
        alert("Please fill in mandatory fields to proceed further");
        return false;

    }


}


/* validations for admin books*/

function validatebname()
{
    var name = document.getElementById("bookname").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]+[0-9]*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("bnerror").innerHTML = "<font color=red>Book Name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("bnerror").innerHTML = "<font color=red>Book Name should not contain spaces or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("bnerror").innerHTML = "";
        return true;
    }
}

function validateaname()
{
    var name = document.getElementById("authorname").value;
    var pattern = /^[a-zA-Z]+[ a-zA-Z-_]*$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("anerror").innerHTML = "<font color=red>Author Name cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("anerror").innerHTML = "<font color=red>Author Name should not contain spaces or any Special characters</font>";
        return false;
    } else
    {
        document.getElementById("anerror").innerHTML = "";
        return true;
    }
}

function validateprice()
{
    var name = document.getElementById("price").value;
    var pattern = /^[0-9]*(?:\.\d{1,2})?$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("prerror").innerHTML = "<font color=red>Price cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("prerror").innerHTML = "<font color=red>Price should contain only digits</font>";
        return false;
    } else
    {
        document.getElementById("prerror").innerHTML = "";
        return true;
    }
}

function validateavail()
{
    var name = document.getElementById("availability").value;
    var pattern = /^[0-9]*(?:\.\d{1,2})?$/;             /*/^[a-zA-Z ]*$/;*/
    

    if (name == "" || name == null)
    {
        document.getElementById("averror").innerHTML = "<font color=red>Availability cannot be empty</font>";
        return false;
    } else if (!pattern.test(name))
    {
        document.getElementById("averror").innerHTML = "<font color=red>Availability should contain only digits</font>";
        return false;
    } else
    {
        document.getElementById("averror").innerHTML = "";
        return true;
    }
}