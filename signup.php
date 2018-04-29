<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script>
            function validateForm() {
                return false;
            }
        </script>
        
        <script>
            $(document).ready( function(){
                $("#user").change(function()
                {
                    error = true;
                    // alert("Enter name please.");
                    $.ajax({
                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#user").val() },
                        success: function(data,status) {
                            // alert(data);
                            if(!data) {
                                document.getElementById("username").style.color = "#008000";
                                $("#username").html("Available");
                                error = false;
                            }
                            else {
                                document.getElementById("username").style.color = "#ff0000";
                                $("#username").html("Username Already Taken");
                                error = true;
                            }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });
                $("#repassword").change(function()
                {
                    if($("#password").val() != $("#repassword").val()) {
                        document.getElementById("rePassword").style.color = "#ff0000";
                        $("#rePassword").html("Password Does Not Match");
                        error = true;
                    }
                    else {
                        document.getElementById("rePassword").style.color = "#008000";
                        $("#rePassword").html("Match");
                        error = false;
                    }
                });
                $("#state").change(function() {
                    //alert($("#state").val());
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                        //alert(data[0].county);
                        $("#county").html("<option> - Select One -</option>");
                        for(var i = 0; i < data.length; i++){
                             $("#county").append("<option>" + data[i].county + "</option>");
                        }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                });
                
                $("#zipCode").change( function(){  
                    
                    // alert( $("#zipCode").val() );  
                    
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) {
                            if(data == false) {
                                document.getElementById("zipcode").style.color = "#ff0000";
                                $("#zipcode").html("Invalid Zipcode");
                                error = true;
                            }
                            else {
                               $("#zipcode").html(""); 
                               error = false;
                            }
                            $("#city").html(data.city);
                            $("#latitude").html(data.latitude);
                            $("#longitude").html(data.longitude);
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//ajax
                } );
                $("#Submit").click(function() {
                    document.getElementById("setInfo").style.fontSize = "24px";
                    if(error == false) {
                        document.getElementById("setInfo").style.color = "#008000";
                        $("#setInfo").html("Record Added!");
                    }
                    else if(error == true){
                        document.getElementById("setInfo").style.color = "#ff0000";
                        $("#setInfo").html("Fix Error!");
                    }
                    else{
                        document.getElementById("setInfo").style.color = "#ff0000";
                        $("#setInfo").html("Fill in Blank!");
                    }
                });
            }); //documentReady
        </script>
    </head>
    <body>
       <h1> Sign Up Form </h1>
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend></legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode"> <span class="text-danger" id="zipcode"></span> <br>
                City:        <span id="city"></span>
                <br>
                Latitude: <span id="latitude"></span>
                <br>
                Longitude: <span id="longitude"></span>
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                
                Desired Username: <input type="text" id = "user"> <span class="text-danger" id="username"></span> <br>
                
                Password: <input type="password" id = "password"><br>
                
                Type Password Again: <input type="password" id ="repassword"> <span class="text-danger" id="rePassword"></span> <br><br>
                
                <input type="submit" value="Sign up!" id="Submit"><br><br>
                <div id="setInfo"></div>
                 <legend></legend>
            </fieldset>
        </form>
    
    </body>
</html>