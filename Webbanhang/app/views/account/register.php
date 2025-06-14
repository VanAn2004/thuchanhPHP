<?php
// File: app/views/account/register.php
// It's recommended to put these custom styles into your app/views/shares/header.php
// if you plan to reuse them across multiple pages for better organization.
?>
<style>
    body {
        background: linear-gradient(to right, #e0f2f7, #c1e7f3); /* Light blue gradient background */
        /* Removed flexbox centering from body to allow header to be at the top */
    }

    /* Style for the main card container */
    .register-card {
        background-color: #fff;
        border-radius: 20px; /* More rounded corners for the card */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
        padding: 40px;
        max-width: 500px; /* Adjust max width as needed */
        width: 100%;
        text-align: center;
        /* Add margin-top to push it down from the header */
        margin-top: 50px; /* Example value, adjust as needed */
        margin-bottom: 50px; /* Add some bottom margin */
    }

    /* Style for the circular user icon above the card */
    .register-card .user-icon-circle {
        width: 80px;
        height: 80px;
        background-color: #e0f2f7; /* Light blue background for the circle */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -80px auto 20px auto; /* Position above the card, adjust margin-top */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .register-card .user-icon-circle svg {
        color: #888; /* Icon color */
        width: 40px;
        height: 40px;
    }

    /* Style for the "Sign up" title */
    .register-card h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    /* Custom styles for Bootstrap's form-control-user to make inputs rounded */
    .form-control.form-control-user {
        border-radius: 10px; /* Rounded input fields matching the image */
        height: 50px; /* Consistent height */
        background-color: #f8f9fa; /* Light background for inputs */
        border: 1px solid #dee2e6; /* Subtle border */
    }
    
    /* Styling for form groups that include icons */
    .form-group-with-icon {
        position: relative;
        margin-bottom: 20px; /* Ensure consistent spacing */
    }

    .form-group-with-icon .form-control {
        padding-left: 45px; /* Space for the icon */
    }

    .form-group-with-icon .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #888; /* Icon color */
        font-size: 1.2rem;
    }

    /* Custom styles for the Register button */
    .btn-primary.btn-icon-split {
        background-color: #007bff; /* Custom blue color for the button, similar to Bootstrap primary */
        border-color: #007bff;
        border-radius: 10px; /* Rounded button matching the image */
        padding: 12px 20px; /* Adjust padding as per original request (p-3 was specific, this is more generic) */
        font-size: 1.1em;
        font-weight: bold;
        width: 100%;
        margin-top: 20px;
    }

    .btn-primary.btn-icon-split:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Style for the bottom link */
    .login-link-section {
        margin-top: 20px;
        font-size: 0.95em;
        color: #666;
    }

    .login-link-section a {
        color: #007bff; /* Blue link color */
        font-weight: bold;
        text-decoration: none;
    }

    .login-link-section a:hover {
        text-decoration: underline;
    }
</style>

<?php include 'app/views/shares/header.php'; ?> 

<!-- The main container for the form, using Bootstrap classes for centering -->
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: calc(100vh - 56px);">
    <div class="register-card">
        <!-- User Icon Circle -->
        <div class="user-icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
        </div>

        <h1>Sign up</h1>

        <?php 
        // Display validation errors if any
        if (isset($errors) && !empty($errors)) { 
            echo "<div class='alert alert-danger' role='alert'>";
            echo "<ul style='list-style: none; padding: 0; margin: 0;'>"; 
            foreach ($errors as $err) { 
                echo "<li style='margin-bottom: 5px;'>" . htmlspecialchars($err) . "</li>"; // Sanitize output
            } 
            echo "</ul>"; 
            echo "</div>";
        }

        // Display success message if any
        if (isset($success) && !empty($success)) {
            echo "<div class='alert alert-success' role='alert'>";
            echo htmlspecialchars($success);
            echo "</div>";
        }
        ?> 
        
        <form class="user" action="/webbanhang/account/save" method="post"> 
            <!-- Username field -->
            <div class="form-group form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <input type="text" class="form-control form-control-user" 
                       id="username" name="username" placeholder="Username" 
                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
            </div> 
            
            <!-- Fullname field -->
            <div class="form-group form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
                </svg>
                <input type="text" class="form-control form-control-user" 
                       id="fullname" name="fullname" placeholder="Full Name"
                       value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
            </div> 

            <!-- Email field -->
            <div class="form-group form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                </svg>
                <input type="email" class="form-control form-control-user" 
                       id="email" name="email" placeholder="Email Address"
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>
            
            <!-- Password field -->
            <div class="form-group form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H10V3a2 2 0 0 0-2-2"/>
                </svg>
                <input type="password" class="form-control form-control-user" 
                       id="password" name="password" placeholder="Password" required> 
            </div> 
            
            <!-- Confirm Password field -->
            <div class="form-group form-group-with-icon"> 
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 0-2 2v4H5a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H10V3a2 2 0 0 0-2-2"/>
                </svg>
                <input type="password" class="form-control form-control-user" 
                       id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required> 
            </div> 
            
            <button type="submit" class="btn btn-primary btn-icon-split p-3"> 
                Register
            </button> 
        </form> 
        <div class="login-link-section">
            Already a member? <a href="/webbanhang/account/login">Sign In</a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>