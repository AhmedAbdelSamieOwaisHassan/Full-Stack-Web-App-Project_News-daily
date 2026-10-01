CREATE TABLE users(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(64) NOT NULL,
    phone VARCHAR(15),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id)

);

CREATE TABLE posts(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    badge VARCHAR(100) NOT NULL DEFAULT 'General',
    `image` VARCHAR(255),
    body TEXT NOT NULL,
    user_id INTEGER UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id) on update CASCADE on DELETE cascade
);

INSERT INTO users(name,email,password,phone)
VALUES('lastName','ahmed@yahoo.com','$dke','01069359815');

INSERT INTO  posts(title,user_id,`image`,body)
VALUES
('test post one',1,'1.png','AI startups push new tools to streamline everyday work
Teams are using automation to reduce admin work and speed up customer service.')
('test post one',1,'2.png','AI startups push new tools to streamline everyday work
Teams are using automation to reduce admin work and speed up customer service.')
('test post one',1,'3.png','AI startups push new tools to streamline everyday work
Teams are using automation to reduce admin work and speed up customer service.')