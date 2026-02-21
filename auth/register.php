<?php
// auth/register.php
require_once '../config/config.php';
require_once '../config/database.php';

// If user is already logged in, redirect to homepage
if (isset($_SESSION['user_id'])) {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

$page_title = "Sign Up";
$errors = [];
$success = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validation
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if username or email already exists
    if (empty($errors)) {
        $db = new Database();
        
        // Check username
        $db->query("SELECT id FROM usersNew WHERE username = :username");
        $db->bind(':username', $username);
        if ($db->single()) {
            $errors[] = "Username already taken";
        }
        
        // Check email
        $db->query("SELECT id FROM usersNew WHERE email = :email");
        $db->bind(':email', $email);
        if ($db->single()) {
            $errors[] = "Email already registered";
        }
    }
    
    // If no errors, create the user
    if (empty($errors)) {
        $db = new Database();
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $db->query("INSERT INTO usersNew (username, email, password, created_at) 
                    VALUES (:username, :email, :password, NOW())");
        $db->bind(':username', $username);
        $db->bind(':email', $email);
        $db->bind(':password', $hashed_password);
        
        if ($db->execute()) {
            $success = true;
            // Clear form fields on success
            $username = $email = '';
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
    }
}

require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Créer un Compte</h1>
            <p>Join thousands of French learners today!</p>
        </div>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <strong>Success!</strong> Your account has been created. 
                <a href="<?php echo SITE_URL; ?>/auth/login.php">Click here to login</a>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">
                    <i class="fas fa-user"></i> Username
                </label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-control" 
                    placeholder="Choose a username"
                    value="<?php echo htmlspecialchars($username ?? ''); ?>"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="your.email@example.com"
                    value="<?php echo htmlspecialchars($email ?? ''); ?>"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="At least 6 characters"
                    required
                >
                <div class="password-strength">
                    <small>Password must be at least 6 characters long</small>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">
                    <i class="fas fa-lock"></i> Confirm Password
                </label>
                <input 
                    type="password" 
                    id="confirm_password" 
                    name="confirm_password" 
                    class="form-control" 
                    placeholder="Re-enter your password"
                    required
                >
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>
        
        <div class="auth-footer">
            Already have an account? 
            <a href="<?php echo SITE_URL; ?>/auth/login.php">
                <i class="fas fa-sign-in-alt"></i> Login here
            </a>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>