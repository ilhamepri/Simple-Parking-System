<?php
session_start();

	if (isset($_SESSION ['Login'])){
		
		include "home.php";
		
	}
	else{
		


?>
<html>
    <head>
        <title>Login</title>
		<link rel="shortcut icon" href="img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="">
                    <strong>Login</strong>
                </a>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->

            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form method="POST" action="login.php"> 
                                <h1>Log in</h1> 
                                <br> 
                                    <label for="username" class="uname" data-icon="u" > Username</label>
                                    <input name="user" type="text" required="required" placeholder="username"/>
                                <br>
                                <br> 
                                    <label for="password" class="youpasswd" data-icon="p"> Password </label>
                                    <input name="pass" type="password" required="required" placeholder="password" /> 
                                <br>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Register
									<a href="#toregister" class="to_register">Signup</a>
								</p>
                            </form>
                        </div>
						

                        <div id="register" class="animate form">
                            <form  action="register.php" method="POST"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Username</label>
                                    <input id="usernamesignup" name="user" required="required" type="text" placeholder="username" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="uname" data-icon="u" >Nama</label>
                                    <input id="usernamesignup" name="name" required="required" type="text" placeholder="nama"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p"> Password </label>
                                    <input id="passwordsignup" name="pass" required="required" type="password" placeholder="password"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already have account
									<a href="#tologin" class="to_register"> Login </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
			


        </div>
    </body>
</html>

<?php 
} 
?>