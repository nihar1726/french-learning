<?php
// config/database.php

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset = 'utf8mb4';

    private $conn;
    private $stmt;
    private $error;

    public function __construct() {
        // Load environment variables (assuming you're using .env file)
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->db_name = getenv('DB_NAME') ?: 'french_learning_db';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASS') ?: '';
        
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            error_log("Database Connection Error: " . $this->error);
            
            // Don't show detailed error in production
            if (getenv('APP_ENV') === 'production') {
                die("Database connection error. Please contact administrator.");
            } else {
                die("Connection failed: " . $this->error);
            }
        }
    }

    public function query($sql) {
        $this->stmt = $this->conn->prepare($sql);
        return $this; // Returns the Database object for method chaining
    }

    public function bind($param, $value, $type = null) {
    // Automatically detects parameter type
    if (is_null($type)) {
        switch (true) {
            case is_int($value): $type = PDO::PARAM_INT; break;
            case is_bool($value): $type = PDO::PARAM_BOOL; break;
            case is_null($value): $type = PDO::PARAM_NULL; break;
            default: $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
    return $this; // Returns the Database object for method chaining
    }

    public function execute() {
    try {
        return $this->stmt->execute();
    } catch(PDOException $e) {
        error_log("Query Execution Error: " . $e->getMessage());
        return false;
    }
}

    public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll();
}

public function single() {
    $this->execute();
    return $this->stmt->fetch();
}

public function rowCount() {
    return $this->stmt->rowCount();
}

}

