CREATE TABLE profile (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  title VARCHAR(100) NOT NULL,
  bio TEXT,
  email VARCHAR(100),
  phone VARCHAR(20),
  profile_image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional indexes for performance
CREATE INDEX idx_profile_name ON profile(full_name);



INSERT INTO profile (full_name, title, bio, email, phone, profile_image)
VALUES ('John Doe', 'Full Stack Developer', 'Passionate about web development.', 'john@example.com', '123-456-7890', 'assets/img/profile.jpg');
