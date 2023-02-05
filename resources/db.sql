-- Database creation
DROP DATABASE IF EXISTS be_friends;
CREATE DATABASE IF NOT EXISTS be_friends;
USE be_friends;

-- Creation of the tables

-- User
CREATE TABLE user(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    nickname VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    avatar VARCHAR(200),
    role VARCHAR(25) NOT NULL,
    created_at DATE,
    updated_at DATE
);

CREATE TABLE post(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
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
    content VARCHAR(50) NOT NULL,
    created_at DATE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE
);

INSERT INTO user(name, nickname, email, password, gender, avatar, role, created_at, updated_at)
VALUES ('David Pizarro', 'Dave', 'david@davo.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', '2017-12-31', '2017-12-31'),
       ('Jesusin of terror', 'Jesusito', 'jes@us.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', '2018-12-31', '2018-12-31'),
       ('Miqui Bee', 'Miquibeequi', 'miquibiki@mike.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2019-12-31', '2019-12-31'),
       ('Wilson Mandela', 'DaniWils', 'wilson@robocop.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2020-12-31', '2020-12-31');

INSERT INTO post(user_id, content, image, likes, created_at, updated_at)
VALUES (1, 'Post lorem ipsum content 1', 'image.jpg', 0, '2017-12-31', '2019-12-31'),
       (2, 'Post lorem ipsum content 2', 'image.jpg', 0, '2018-12-31', '2019-12-31'),
       (3, 'Post lorem ipsum content 3', 'image.jpg', 0, '2019-12-31', '2019-12-31'),
       (4, 'Post lorem ipsum content 4', 'image.jpg', 0, '2020-12-31', '2019-12-31');

INSERT INTO comment(user_id, post_id, content, created_at)
VALUES (4, 1, 'Comment DaniWilsMachine', '2019-08-05'),
       (3, 2, 'Comment MikibeeMachine', '2019-09-12'),
       (2, 3, 'Comment JesusitoMachine', '2019-10-16'),
       (1, 4, 'Comment DaveMachine', '2019-11-19'),
       (1, 3, 'Comment newComment', '2019-12-25');