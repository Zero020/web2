# 데이터 베이스, 테이블 4개 생성
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    profile_image TEXT DEFAULT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (author_id) REFERENCES users(id)
);
CREATE TABLE calendar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    book_title VARCHAR(255) NOT NULL,
    memo TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
#---------------------------------------------------------------------------
#초기데이터

INSERT INTO users (username, password, email, is_admin)
VALUES
('admin', 'admin_hashed_password', 'admin@example.com', TRUE),
('user1', 'user1_hashed_password', 'user1@example.com', FALSE),
('user2', 'user2_hashed_password', 'user2@example.com', FALSE);

INSERT INTO posts (title, content, author_id, view_count)
VALUES
('첫 번째 게시글', '이 게시글은 테스트용입니다.', 1, 10),
('두 번째 게시글', '조회수 필드가 추가되었습니다.', 2, 5),
('세 번째 게시글', '데이터 삽입 테스트 중입니다.', 3, 0);

INSERT INTO comments (post_id, content, author_id)
VALUES
(1, '이 댓글은 첫 번째 테스트 댓글입니다.', 2),
(1, '좋은 게시글입니다.', 3),
(2, '조회수에 대해 더 알고 싶어요!', 1);

INSERT INTO calendar (user_id, date, book_title, memo)
VALUES
(2, '2024-11-14', '데이터베이스 설계', '설계 후 테스트 데이터 작성 중'),
(3, '2024-11-15', '웹 개발 실습', '게시판 기능 테스트'),
(2, '2024-11-16', 'PHP 프로그래밍', 'CRUD 구현 계획 중');
