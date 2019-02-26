CREATE TABLE blog.upic
(
  upic_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  path varchar(255) NOT NULL
);

CREATE TABLE users
(
  user_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  login varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  sign varchar(255),
  upic_id int(11),
  CONSTRAINT user_pic FOREIGN KEY (upic_id) REFERENCES upic (upic_id)
);

CREATE TABLE roles
(
  role_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  role_name int(11) NOT NULL
);

CREATE TABLE users_roles
(
  user_id int(11) NOT NULL,
  role_id int(11) NOT NULL,
  CONSTRAINT `PRIMARY` PRIMARY KEY (user_id, role_id),
  CONSTRAINT users_roles_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id),
  CONSTRAINT users_roles_ibfk_2 FOREIGN KEY (role_id) REFERENCES roles (role_id)
);

CREATE TABLE categories
(
  category_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  category_name varchar(255) NOT NULL
);

CREATE TABLE posts
(
  post_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  category_id int(11) NOT NULL,
  data varchar(255) NOT NULL,
  post_name varchar(255) NOT NULL,
  post_desc mediumtext NOT NULL,
  CONSTRAINT posts_users_user_id_fk FOREIGN KEY (user_id) REFERENCES users (user_id),
  CONSTRAINT posts_categories_category_id_fk FOREIGN KEY (category_id) REFERENCES categories (category_id)
);

CREATE TABLE comments
(
  comment_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  comment_desc tinytext NOT NULL,
  tags varchar(255) NOT NULL,
  post_id int(11) NOT NULL,
  CONSTRAINT comments_users_user_id_fk FOREIGN KEY (user_id) REFERENCES users (user_id),
  CONSTRAINT comments_posts_post_id_fk FOREIGN KEY (post_id) REFERENCES posts (post_id)
);