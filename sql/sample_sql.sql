CREATE TABLE certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    institution VARCHAR(100) NOT NULL,
    date_obtained DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional index for search
CREATE INDEX idx_title ON certifications(title);
