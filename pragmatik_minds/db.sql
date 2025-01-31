-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') NOT NULL
);

-- Insert Sample Users
INSERT INTO users (username, password, role) VALUES
('admin', SHA1('admin123'), 'admin'),
('editor', SHA1('editor123'), 'editor');