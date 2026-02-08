<?php
// includes/footer.php
?>

<footer>
    <div class="footer-container">
        <div class="footer-content">
            <!-- About Section -->
            <div class="footer-section footer-about">
                <h3>About FrançaisHub</h3>
                <p>
                    Your gateway to mastering the beautiful French language. We offer comprehensive lessons, 
                    interactive exercises, and engaging quizzes to help you achieve fluency.
                </p>
                <div class="social-links">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="footer-section footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>/index.php"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pages/lessons.php"><i class="fas fa-graduation-cap"></i>Lessons</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pages/vocabulary.php"><i class="fas fa-language"></i>Vocabulary</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pages/grammar.php"><i class="fas fa-spell-check"></i>Grammar</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pages/quiz.php"><i class="fas fa-brain"></i>Quizzes</a></li>
                </ul>
            </div>
            
            <!-- Learning Resources -->
            <div class="footer-section footer-links">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-book"></i>Study Guides</a></li>
                    <li><a href="#"><i class="fas fa-headphones"></i>Pronunciation Guide</a></li>
                    <li><a href="#"><i class="fas fa-comments"></i>Community Forum</a></li>
                    <li><a href="#"><i class="fas fa-question-circle"></i>FAQ</a></li>
                    <li><a href="#"><i class="fas fa-file-alt"></i>Blog</a></li>
                </ul>
            </div>
            
            <!-- Contact & Newsletter -->
            <div class="footer-section footer-contact">
                <h3>Stay Connected</h3>
                <p><i class="fas fa-envelope"></i>contact@françaishub.com</p>
                <p><i class="fas fa-phone"></i>+33 1 23 45 67 89</p>
                <p><i class="fas fa-map-marker-alt"></i>Paris, France</p>
                
                <form class="newsletter-form" onsubmit="return false;">
                    <input type="email" placeholder="Subscribe to newsletter" required>
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>
                Made with <span style="color: var(--french-red);">❤️</span> for French learners worldwide 
                <span class="french-flag">🇫🇷</span>
            </p>
            <p>
                &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved. | 
                <a href="#">Privacy Policy</a> | 
                <a href="#">Terms of Service</a>
            </p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">
                <em>"La langue française est une femme. Et cette femme est si belle..." - Victor Hugo</em>
            </p>
        </div>
    </div>
</footer>

<!-- JavaScript files -->
<script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>

</body>
</html>