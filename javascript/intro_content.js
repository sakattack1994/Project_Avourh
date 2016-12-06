function intro(){
  var content;
  content='\
  <h2>Department of Electrical and Computer Engineering</h2>\
  <p>Welcome to the Department of Electrical and Computer Engineering, which\
   was founded in 1967 as the first part of the University of Patras. Our Department \
   covers educational and research areas Electricity, Telecommunications and Information \
   Technology, Electronics and Computer Systems and Automatic Control. We invite you to visit our premises or website.</p>\
  ';
  $('#content').append(content) ;
}

function login(){
    var login;
    login='\
    <div class=\"wrapper\">\
			<div class=\"content\">\
				<div id=\"form_wrapper\" class=\"form_wrapper\">\
					<form class=\"register\">\
						<h3>Register</h3>\
						<div class=\"column\">\
							<div>\
								<label>First Name:</label>\
								<input type=\"text\" />\
								<span class=\"error\">This is an error</span>\
							</div>\
							<div>\
								<label>Last Name:</label>\
								<input type=\"text\" />\
								<span class=\"error\">This is an error</span>\
							</div>\
							<div>\
								<label>Website:</label>\
								<input type=\"text\" value=\"http://\"/>\
								<span class=\"error\">This is an error</span>\
							</div>\
						</div>\
						<div class=\"column\">\
							<div>\
								<label>Username:</label>\
								<input type=\"text\"/>\
								<span class=\"error\">This is an error</span>\
							</div>\
							<div>\
								<label>Email:</label>\
								<input type=\"text\" />\
								<span class=\"error\">This is an error</span>\
							</div>\
							<div>\
								<label>Password:</label>\
								<input type=\"password\" />\
								<span class=\"error\">This is an error</span>\
							</div>\
						</div>\
						<div class=\"bottom\">\
							<div class=\"remember\">\
								<input type=\"checkbox\" />\
								<span>Send me updates</span>\
							</div>\
							<input type=\"submit\" value=\"Register\" />\
							<a href=\"index.html\" rel=\"login\" class=\"linkform\">You have an account already? Log in here</a>\
							<div class=\"clear\"></div>\
						</div>\
					</form>\
					<form class=\"login active\">\
						<h3>Login</h3>\
						<div>\
							<label>Username:</label>\
							<input type=\"text\" />\
							<span class=\"error\">This is an error</span>\
						</div>\
						<div>\
							<label>Password: <a href=\"forgot_password.html\" rel=\"forgot_password\" class=\"forgot linkform\">Forgot your password?</a></label>\
							<input type=\"password\" />\
							<span class=\"error\">This is an error</span>\
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
