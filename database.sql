-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS french_learning_db;
USE french_learning_db;

-- 1. Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_username (username),
    INDEX idx_email (email)
);

-- 2. Lessons table
CREATE TABLE lessons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    content LONGTEXT NOT NULL,
    level ENUM('A1', 'A2', 'B1', 'B2', 'C1', 'C2') NOT NULL,
    order_number INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_level (level),
    INDEX idx_order (order_number),
    UNIQUE KEY unique_lesson_order (level, order_number)
);

-- 3. Vocabulary table
CREATE TABLE vocabulary (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lesson_id INT NOT NULL,
    french_word VARCHAR(200) NOT NULL,
    english_translation VARCHAR(200) NOT NULL,
    pronunciation VARCHAR(200),
    example_sentence TEXT,
    example_translation TEXT,
    audio_file VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
    INDEX idx_french_word (french_word),
    INDEX idx_lesson_id (lesson_id)
);

-- 4. Grammar topics table
CREATE TABLE grammar_topics (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    explanation LONGTEXT NOT NULL,
    examples TEXT,
    level ENUM('A1', 'A2', 'B1', 'B2', 'C1', 'C2') NOT NULL,
    order_number INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_level (level),
    INDEX idx_order (order_number)
);

-- 5. Exercises table
CREATE TABLE exercises (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lesson_id INT,
    type ENUM('fill-blank', 'matching', 'translation', 'multiple-choice', 'sentence-construction') NOT NULL,
    question TEXT NOT NULL,
    correct_answer TEXT NOT NULL,
    options JSON,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE SET NULL,
    INDEX idx_lesson_id (lesson_id),
    INDEX idx_difficulty (difficulty)
);

-- 6. Quizzes table
CREATE TABLE quizzes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lesson_id INT,
    question TEXT NOT NULL,
    option_a TEXT NOT NULL,
    option_b TEXT NOT NULL,
    option_c TEXT NOT NULL,
    option_d TEXT NOT NULL,
    correct_option ENUM('a', 'b', 'c', 'd') NOT NULL,
    explanation TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE SET NULL,
    INDEX idx_lesson_id (lesson_id)
);

-- 7. User progress table
CREATE TABLE user_progress (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    lesson_id INT NOT NULL,
    completed BOOLEAN DEFAULT 0,
    completed_at TIMESTAMP NULL,
    score DECIMAL(5,2),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
    INDEX idx_user_lesson (user_id, lesson_id),
    INDEX idx_completed_at (completed_at)
);

-- 8. Quiz results table
CREATE TABLE quiz_results (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT NOT NULL,
    total_questions INT NOT NULL,
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    INDEX idx_user_quiz (user_id, quiz_id),
    INDEX idx_attempted_at (attempted_at)
);

-- Optional: Add some sample data for testing
-- INSERT INTO users (username, email, password, full_name) VALUES
-- ('john_doe', 'john@example.com', '$2y$10$YourHashedPasswordHere', 'John Doe'),
-- ('jane_smith', 'jane@example.com', '$2y$10$YourHashedPasswordHere', 'Jane Smith');

-- INSERT INTO lessons (title, description, content, level, order_number) VALUES
-- ('Greetings and Introductions', 'Learn basic French greetings', 'Full lesson content here...', 'A1', 1),
-- ('Present Tense Verbs', 'Master regular -er verbs', 'Full lesson content here...', 'A1', 2);

-- INSERT INTO vocabulary (lesson_id, french_word, english_translation, example_sentence) VALUES
-- (1, 'Bonjour', 'Hello', 'Bonjour, comment ça va?'),
-- (1, 'Merci', 'Thank you', 'Merci beaucoup pour votre aide.');