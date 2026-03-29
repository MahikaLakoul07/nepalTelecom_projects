<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Nepal Telecom Projects</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>

    <div class="split-screen">
        <div class="left-panel">
            <div class="brand-text">
                <h1>Join the<br>Network</h1>
                <p>Create your account and start collaborating on Nepal Telecom's latest projects.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-wrapper">
                <div class="form-header">
                    <h2>Create Account</h2>
                    <p>Enter your details below to sign up.</p>
                </div>

                <form name="form" action="register.php" method="POST">

                    <div class="input-group">
                        <input type="text" class="input-field" id="full_name" name="full_name" placeholder=" " required>
                        <label class="input-label" for="full_name">Full Name</label>
                    </div>

                    <div class="input-group">
                        <input type="text" class="input-field" id="employeeId" name="employeeId" placeholder=" " required>
                        <label class="input-label" for="employeeId">Employee ID</label>
                    </div>

                    <div class="input-group">
                        <input type="email" class="input-field" id="email" name="email" placeholder=" " required>
                        <label class="input-label" for="email">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" class="input-field" id="phone_no" name="phone_no" placeholder=" " required>
                        <label class="input-label" for="phone_no">Phone</label>
                    </div>

                    <div class="input-group">
                        <input type="text" class="input-field" id="username" name="username" placeholder=" " required>
                        <label class="input-label" for="username">Username</label>
                    </div>

                    <div class="input-group">
                        <input type="password" class="input-field" id="password" name="password" placeholder=" " required>
                        <label class="input-label" for="password">Password</label>
                    </div>

                    <div class="input-group">
                        <select id="user_type" name="user_type" class="input-field">
                            <option value="General">General User</option>
                            <option value="Admin">Admin</option>
                            <option value="Super_Admin">Super Admin</option>
                        </select>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">User Type</label>
                    </div>

                    <button type="submit" class="btn-primary">Register Now</button>
                    
                    <div class="footer-link">
                        Already have an account? <a href="../index.php">Login Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>