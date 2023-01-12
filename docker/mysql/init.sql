DROP TABLE IF EXISTS post_comments;
CREATE TABLE post_comments(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(64),
    email VARCHAR(256),
    title VARCHAR(256),
    content TEXT,
    created_at TIMESTAMP DEFAULT NOW()
)