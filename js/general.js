$(document).ready(function(){
	$("#btn-login").click(function() {
		loginUser($("#username").val(),$("#password").val());
	});
	
	$("#insert_data_surficial").click(function() {
		console.log("LOAD ASSETS");
	});
});

function loginUser(username,password) {
	let creds = {
		"user": username,
		"pass": password
	}

	$.post("../login/validateCredentials", creds)
        .done((result) => {
            let isValid = JSON.parse(result);
            if (isValid.length != 0) {
            	sessionStorage['username'] = isValid[0].username;
            	sessionStorage['id'] = isValid[0].user_id;
            	sessionStorage['site_id'] = isValid[0].site_id;
            	sessionStorage['salutation'] = isValid[0].salutation;
            	sessionStorage['firstname'] = isValid[0].first_name;
            	sessionStorage['lastname'] = isValid[0].last_name;
            	window.location.href = "../dashboard";
            } else {
            	alert("Login failed! username or password is incorrect");
            }
        });
}