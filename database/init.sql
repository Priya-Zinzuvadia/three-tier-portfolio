CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

CREATE TABLE IF NOT EXISTS resume_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed the initial row pointing directly to your customized file name string
INSERT INTO resume_data (id, image_url) 
VALUES (1, 'Priya_Zinzuvadia_Resume.pdf')
ON DUPLICATE KEY UPDATE image_url = 'Priya_Zinzuvadia_Resume.pdf';

GRANT ALL PRIVILEGES ON portfolio_db.* TO 'portfolio_user'@'%' IDENTIFIED BY 'portfolio_secure_pass';
FLUSH PRIVILEGES;
