<?php
// index.php
$page_title = "Welcome to French Learning";
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Bonjour! Learn French Today</h1>
        <p>Master the language of love, culture, and opportunity with our interactive lessons and engaging exercises</p>
        <div class="hero-buttons">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="<?php echo SITE_URL; ?>/pages/lessons.php" class="btn-hero btn-primary">
                    <i class="fas fa-play-circle"></i> Continue Learning
                </a>
                <a href="<?php echo SITE_URL; ?>/pages/progress.php" class="btn-hero btn-secondary">
                    <i class="fas fa-chart-line"></i> View Progress
                </a>
            <?php else: ?>
                <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn-hero btn-primary">
                    <i class="fas fa-rocket"></i> Start Learning Free
                </a>
                <a href="<?php echo SITE_URL; ?>/pages/lessons.php" class="btn-hero btn-secondary">
                    <i class="fas fa-eye"></i> Browse Lessons
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <h2 class="section-title">Why Learn French With Us?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>Structured Lessons</h3>
            <p>From beginner to advanced, our comprehensive curriculum follows the CEFR framework (A1-C2)</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-language"></i>
            </div>
            <h3>Rich Vocabulary</h3>
            <p>Learn thousands of words with context, examples, and pronunciation guides</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-spell-check"></i>
            </div>
            <h3>Grammar Mastery</h3>
            <p>Clear explanations of French grammar rules with plenty of practice exercises</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-brain"></i>
            </div>
            <h3>Interactive Quizzes</h3>
            <p>Test your knowledge and track improvement with engaging quizzes and challenges</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Progress Tracking</h3>
            <p>Monitor your learning journey and celebrate milestones along the way</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <h3>Learn Anywhere</h3>
            <p>Fully responsive design - study on desktop, tablet, or mobile device</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stats-grid">
        <div class="stat-item">
            <h3>500+</h3>
            <p>Lessons Available</p>
        </div>
        <div class="stat-item">
            <h3>5000+</h3>
            <p>Vocabulary Words</p>
        </div>
        <div class="stat-item">
            <h3>1000+</h3>
            <p>Practice Exercises</p>
        </div>
        <div class="stat-item">
            <h3>100%</h3>
            <p>Free to Use</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta">
    <h2>Ready to Start Your French Journey?</h2>
    <p>Join thousands of learners mastering French. Create your free account today and unlock your potential!</p>
    <?php if(!isset($_SESSION['user_id'])): ?>
        <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn-hero btn-primary">
            <i class="fas fa-user-plus"></i> Create Free Account
        </a>
    <?php else: ?>
        <a href="<?php echo SITE_URL; ?>/pages/lessons.php" class="btn-hero btn-primary">
            <i class="fas fa-book-open"></i> Start Your Next Lesson
        </a>
    <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>