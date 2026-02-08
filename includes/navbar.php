<?php
// includes/navbar.php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Top Bar -->
<div class="top-bar">
    <i class="fas fa-star"></i>
    Bienvenue! Learn French with interactive lessons and quizzes
    <i class="fas fa-star"></i>
</div>

<!-- Main Navigation -->
<nav>
    <div class="nav-container">
        <a href="<?php echo SITE_URL; ?>/index.php" class="logo">
            <i class="fas fa-book-open logo-icon"></i>
            <span class="logo-text">Français<span>Hub</span></span>
        </a>
        
        <button class="mobile-toggle" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="<?php echo SITE_URL; ?>/index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>Home
            </a></li>
            <li><a href="<?php echo SITE_URL; ?>/pages/lessons.php" class="<?php echo $current_page == 'lessons.php' ? 'active' : ''; ?>">
                <i class="fas fa-graduation-cap"></i>Lessons
            </a></li>
            <li><a href="<?php echo SITE_URL; ?>/pages/vocabulary.php" class="<?php echo $current_page == 'vocabulary.php' ? 'active' : ''; ?>">
                <i class="fas fa-language"></i>Vocabulary
            </a></li>
            <li><a href="<?php echo SITE_URL; ?>/pages/grammar.php" class="<?php echo $current_page == 'grammar.php' ? 'active' : ''; ?>">
                <i class="fas fa-spell-check"></i>Grammar
            </a></li>
            <li><a href="<?php echo SITE_URL; ?>/pages/quiz.php" class="<?php echo $current_page == 'quiz.php' ? 'active' : ''; ?>">
                <i class="fas fa-brain"></i>Quiz
            </a></li>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo SITE_URL; ?>/pages/progress.php" class="<?php echo $current_page == 'progress.php' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i>Progress
                </a></li>
                <li class="user-menu">
                    <span class="user-welcome">
                        <i class="fas fa-user-circle"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </li>
                <li><a href="<?php echo SITE_URL; ?>/auth/logout.php" class="btn-login" style="padding: 0.5rem 1rem;">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a></li>
            <?php else: ?>
                <li class="auth-buttons">
                    <a href="<?php echo SITE_URL; ?>/auth/login.php" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-signup">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const navLinks = document.getElementById('navLinks');
        navLinks.classList.toggle('active');
    }
</script>