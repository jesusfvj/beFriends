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
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE post(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content VARCHAR(50) NOT NULL,
    image VARCHAR(200) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Recipes
CREATE TABLE comment(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    content VARCHAR(50) NOT NULL,
    created_at DATETIME,
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
    friend_id INT NOT NULL,
    follow_back VARCHAR(11) NOT NULL,
    follow VARCHAR(6) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

INSERT INTO user(name, nickname, email, password, gender, avatar, role, created_at, updated_at)
VALUES ('David Pizarro', 'Dave', 'david@davo.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', NOW(), NOW()),
       ('Jesusin of terror', 'Jesusito', 'jes@us.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'admin', '2022-12-31 23:59:59', '2022-12-31 23:59:59'),
       ('Miqui Bee', 'Miquibeequi', 'miquibiki@mike.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2021-12-31 23:59:59', '2021-12-31 23:59:59'),
       ('Wilson Mandela', 'DaniWils', 'wilson@robocop.com', 'password', 'Male', 'assets/images/defaultProfileImg.png', 'user', '2020-12-31 23:59:59', '2020-12-31 23:59:59');

INSERT INTO post(user_id, content, image, created_at, updated_at)
VALUES (1, 'Post lorem ipsum content 1', 'https://images.unsplash.com/photo-1671725779253-0a5a067cfac4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', NOW(), NOW()),
       (2, 'Post lorem ipsum content 2', 'https://images.unsplash.com/photo-1674230257775-f9c2297e7bf7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2021-12-31 23:59:59', '2021-12-31 23:59:59'),
       (3, 'Post lorem ipsum content 3', 'https://images.unsplash.com/photo-1601148524545-7909080c2edd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2020-12-31 23:59:59', '2020-12-31 23:59:59'),
       (4, 'Post lorem ipsum content 4', 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80', '2019-12-31 23:59:59', '2019-12-31 23:59:59'),
       (1, 'Post lorem ipsum content 5', 'https://images.unsplash.com/photo-1671725779253-0a5a067cfac4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2018-12-31 23:59:59', '2018-12-31 23:59:59'),
       (2, 'Post lorem ipsum content 6', 'https://images.unsplash.com/photo-1674230257775-f9c2297e7bf7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2017-12-31 23:59:59', '2017-12-31 23:59:59'),
       (3, 'Post lorem ipsum content 7', 'https://images.unsplash.com/photo-1601148524545-7909080c2edd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80', '2016-12-31 23:59:59', '2016-12-31 23:59:59'),
       (4, 'Post lorem ipsum content 8', 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80', '2015-12-31 23:59:59', '2015-12-31 23:59:59');


INSERT INTO comment(user_id, post_id, content, created_at)
VALUES (4, 1, 'Comment DaniWilsMachine', NOW()),
       (3, 2, 'Comment MikibeeMachine', '2022-12-01 23:59:59'),
       (2, 3, 'Comment JesusitoMachine', '2022-12-10 23:59:59'),
       (1, 4, 'Comment DaveMachine', '2022-12-15 23:59:59'),
       (1, 1, 'Yeah!', '2022-12-15 23:59:59'),
       (2, 2, 'Let`s go!', '2022-12-15 23:59:59'),
       (3, 3, 'Come on!', '2022-12-15 23:59:59'),
       (4, 4, 'Wake up!', '2022-12-31 23:59:59');

INSERT INTO likes(user_id, post_id)
VALUES (1, 4),
       (2, 3),
       (3, 2),
       (4, 1),
       (1, 1),
       (2, 2),
       (3, 3),
       (4, 4);

INSERT INTO friends(user_id, friend_id, follow_back, follow)
VALUES (1, 2, "", ""),
       (1, 3, "", ""),
       (1, 4, "", ""),
       (2, 1, "", ""),
       (2, 3, "", ""),
       (3, 4, "", "");