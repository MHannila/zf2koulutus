USE `mydb` ;

INSERT INTO
`user` (id, username, email, displayName, password, state)
VALUES
(1, 'Admin', 'admin@library.fi', null, '$2y$14$hf/mEIH97sxfbyTMrEg5.Of8TlfLDM4nGYkRkKwjnpL.FVAf1HL/i', 1),
(2, 'Marko', 'mh@zf2koulutus.fi', null, '$2y$14$hf/mEIH97sxfbyTMrEg5.Of8TlfLDM4nGYkRkKwjnpL.FVAf1HL/i', 1);

INSERT INTO
`role` (id, roleId, isDefault, parent_id)
VALUES
(1, 'admin', 0, null),
(2, 'user', 0, null),
(3, 'guest', 0, null),
(4, 'VIP user', 0, 2);

INSERT INTO
`user_link_role` (user_id, role_id)
VALUES
(1, 1),
(2, 4);

INSERT INTO
`book` (id, title, isbn, author, user_id)
VALUES
(1, 'Lord of the Rings', '9780544003415', 'J.R.R. Tolkien', 2),
(2, 'The Hobbit or There and Back Again', '0618002219', 'J.R.R. Tolkien', null),
(3, 'Song of Fire and Ice', '978055357304', 'George R.R. Martin', null);
