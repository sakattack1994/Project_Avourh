function login(){
    var login;
    login='\
    <div class=\"wrapper\">\
			<div class=\"content\">\
				<div id=\"form_wrapper\" class=\"form_wrapper\">\
					<form class=\"login active\" action=\"login.php\" method=\"POST\">\
						<h3>Login</h3>\
						<div>\
							<label>Username:</label>\
							<input type=\"text\" name=\"username\" required=\"\"/>\
							<span class=\"error_user\">Username not found!</span>\
						</div>\
						<div>\
							<label>Password: <a href=\"forgot_password.html\" rel=\"forgot_password\" class=\"forgot linkform\">Forgot your password?</a></label>\
							<input type=\"password\" name=\"password\" required=\"\"/>\
							<span class=\"error_pw\">Wrong password!</span>\
						</div>\
						<div class=\"bottom\">\
							<div class=\"remember\"><input type=\"checkbox\" /><span>Keep me logged in</span></div>\
							<input type=\"submit\" value=\"Login\"></input>\
							<div class=\"clear\"></div>\
						</div>\
					</form>\
					<form class=\"forgot_password\">\
						<h3>Forgot Password</h3>\
						<div>\
							<label>Username or Email:</label>\
							<input type=\"text\" />\
							<span class=\"error\">This is an error</span>\
						</div>\
						<div class=\"bottom\">\
							<input type=\"submit\" value=\"Send reminder\"></input>\
							<a href=\"index.html\" rel=\"login\" class=\"linkform\">Suddenly remebered? Log in here</a>\
							<a href=\"register.html\" rel=\"register\" class=\"linkform\">You don\'t have an account? Register here</a>\
							<div class=\"clear\"></div>\
						</div>\
					</form>\
				</div>\
				<div class=\"clear\"></div>\
			</div>\
		</div>';
    $('#side_bar').append(login) ;
}
