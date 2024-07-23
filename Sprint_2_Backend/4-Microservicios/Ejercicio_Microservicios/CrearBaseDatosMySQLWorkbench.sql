use tienda_online;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(20),
    password VARCHAR(20)
);
INSERT INTO usuarios (user, password) VALUES ('user1', 'password1');
INSERT INTO usuarios (user, password) VALUES ('user2', 'password2');