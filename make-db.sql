DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
 id INTEGER PRIMARY KEY AUTO_INCREMENT,
 first_name VARCHAR(60) NOT NULL,
 last_name VARCHAR(60) NOT NULL,
 email VARCHAR(60) NOT NULL,
 password VARCHAR(128) NOT NULL,
 description VARCHAR(200),
 user_level VARCHAR(60),
 created_at DATETIME,
 updated_at DATETIME
);

CREATE TABLE messages (
 id INTEGER PRIMARY KEY AUTO_INCREMENT,
 user_id INTEGER NOT NULL,
 by_user INTEGER NOT NULL,
 message VARCHAR(200) NOT NULL,
 created_at DATETIME,
 CONSTRAINT messages_userfk FOREIGN KEY messages(user_id) REFERENCES users(id),
 CONSTRAINT messages_byfk FOREIGN KEY messages(by_user) REFERENCES users(id)
);

CREATE TABLE comments (
 id INTEGER PRIMARY KEY AUTO_INCREMENT,
 user_id INTEGER NOT NULL,
 message_id INTEGER NOT NULL,
 comment VARCHAR(200) NOT NULL,
 created_at DATETIME,
 CONSTRAINT users_fk FOREIGN KEY comments(user_id) REFERENCES users(id),
 CONSTRAINT messages_fk FOREIGN KEY comments(message_id) REFERENCES messages(id)
);
 