<?php
    include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nepal Telecom Projects</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    
    <div class="split-screen">
        <div class="left-panel">
            <div class="brand-text">
                <h1>Future of<br>Connectivity</h1>
                <p>Welcome to the Nepal Telecom Projects Portal. Secure access to your workspace starts here.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-wrapper">
                <div class="form-header">
                    <h2>Welcome Back</h2>
                    <p>Please enter your credentials to continue.</p>
                </div>

                <form name="form" action="auth/login.php" onsubmit="return isvalid()" method="post">
                    
                    <div class="input-group">
                        <input type="text" class="input-field" id="UserName" name="UserName" placeholder=" " required>
                        <label class="input-label" for="UserName">Username</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="input-field" id="password" name="password" placeholder=" " required>
                        <label class="input-label" for="password">Password</label>
                    </div>

                    <button type="submit" class="btn-primary" id="btn" name="submit">Login</button>
                    
                    <div class="footer-link">
                        Don't have an account? <a href="auth/registration.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function isvalid()
        {
            var username = document.form.UserName.value;
            var password = document.form.password.value;
            if(username.length=="" && password.length=="")
            {
                alert("UserName and Password fields are empty");
                return false;
            }
            else
            {
                if(username.length=="")
                {
                    alert("UserName is empty");
                    return false;
                }
                if (password.length=="")
                {
                    alert("Password field is empty");
                    return false;
                }
            }
        }
    </script>
</body>
</html>