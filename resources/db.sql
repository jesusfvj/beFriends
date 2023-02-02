-- Database creation
DROP DATABASE IF EXISTS be_friends;
CREATE DATABASE IF NOT EXISTS be_friends;
USE be_friends;

-- Creation of the tables

-- User
CREATE TABLE user(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    avatar VARCHAR(200),
    role VARCHAR(25) NOT NULL,
    created_at DATE,
    updated_at DATE
);

CREATE TABLE post(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(50) NOT NULL,
    content VARCHAR(50) NOT NULL,
    image VARCHAR(200) NOT NULL,
    likes INT NOT NULL,
    created_at DATE,
    updated_at DATE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Recipes
CREATE TABLE comment(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    content VARCHAR(50) UNIQUE NOT NULL,
    created_at DATE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE
);

INSERT INTO user(name, nickname, email, password, gender, avatar, role, created_at, updated_at)
VALUES ('David Pizarro', 'Dave', 'david@davo.com', 'password', 'male', 'avatar.png', 'admin', '2019-12-31', '2019-12-31'),
       ('Jesusin of terror', 'Jesusito', 'jes@us.com', 'password', 'male', 'avatar.png', 'admin', '2019-12-31', '2019-12-31'),
       ('Miqui Bee', 'Miquibeequi', 'miquibiki@mike.com', 'password', 'male', 'avatar.png', 'user', '2019-12-31', '2019-12-31'),
       ('Wilson Mandela', 'Arbitruxo', 'wilson@robocop.com', 'password', 'male', 'avatar.png', 'user', '2019-12-31', '2019-12-31');

INSERT INTO post(user_id, title, content, image, likes, created_at, updated_at)
VALUES (1, 'Post title 1', 'Post lorem ipsum content', 'image.jpg', 0, '2019-12-31', '2019-12-31'),
       (2, 'Post title 2', 'Post lorem ipsum content', 'image.jpg', 0, '2019-12-31', '2019-12-31'),
       (3, 'Post title 3', 'Post lorem ipsum content', 'image.jpg', 0, '2019-12-31', '2019-12-31'),
       (4, 'Post title 4', 'Post lorem ipsum content', 'image.jpg', 0, '2019-12-31', '2019-12-31');

INSERT INTO comment(user_id, post_id, content, created_at)
VALUES (4, 1, 'Comment ArbitruxoMachine', '2019-12-31'),
       (3, 2, 'Comment MikibeeMachine', '2019-12-31'),
       (2, 3, 'Comment JesusitoMachine', '2019-12-31'),
       (1, 4, 'Comment DaveMachine', '2019-12-31');