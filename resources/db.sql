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

CREATE TABLE likes(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE
);

CREATE TABLE friends(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    friend_id INT NOT NULL
);

INSERT INTO user(name, nickname, email, password, gender, avatar, role, created_at, updated_at)
VALUES ('David Pizarro', 'Dave', 'david@davo.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', '2017-12-31', '2017-12-31'),
       ('Jesusin of terror', 'Jesusito', 'jes@us.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', '2018-12-31', '2018-12-31'),
       ('Miqui Bee', 'Miquibeequi', 'miquibiki@mike.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2019-12-31', '2019-12-31'),
       ('Wilson Mandela', 'DaniWils', 'wilson@robocop.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2020-12-31', '2020-12-31');

INSERT INTO post(user_id, content, image, created_at, updated_at)
VALUES (1, 'Post lorem ipsum content 1', 'https://images.unsplash.com/photo-1671725779253-0a5a067cfac4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2017-12-31', '2019-12-31'),
       (2, 'Post lorem ipsum content 2', 'https://images.unsplash.com/photo-1674230257775-f9c2297e7bf7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2018-12-31', '2019-12-31'),
       (3, 'Post lorem ipsum content 3', 'https://images.unsplash.com/photo-1601148524545-7909080c2edd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2019-12-31', '2019-12-31'),
       (4, 'Post lorem ipsum content 4', 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80', '2020-12-31', '2019-12-31');

INSERT INTO comment(user_id, post_id, content, created_at)
VALUES (4, 1, 'Comment DaniWilsMachine', '2019-08-05'),
       (3, 2, 'Comment MikibeeMachine', '2019-09-12'),
       (2, 3, 'Comment JesusitoMachine', '2019-10-16'),
       (1, 4, 'Comment DaveMachine', '2019-11-19'),
       (1, 3, 'Comment newComment', '2019-12-25');

INSERT INTO likes(user_id, post_id)
VALUES (1, 4),
       (2, 3),
       (3, 2),
       (4, 1),
       (3, 1),
       (2, 1),
       (1, 1);

INSERT INTO friends(user_id, friend_id)
VALUES (1, 2),
       (1, 3),
       (1, 4),
       (2, 1),
       (2, 3),
       (3, 4);