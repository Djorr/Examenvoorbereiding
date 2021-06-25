-- ====== Re-create database ======
DROP DATABASE IF EXISTS examenvoorbereiding;
CREATE DATABASE examenvoorbereiding;
USE examenvoorbereiding;

-- ====== Table structure ======
CREATE TABLE user_types (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) UNIQUE NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,

	PRIMARY KEY(id),
	INDEX(created_at)
);

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	type_id INT NOT NULL,
	username VARCHAR(255) UNIQUE NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(60) NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,

	PRIMARY KEY(id),
	INDEX(username),
	INDEX(created_at),
	FOREIGN KEY(type_id) REFERENCES user_types(id)
);

CREATE TABLE departments (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	post_code VARCHAR(6) NOT NULL,
	city VARCHAR(255) NOT NULL,
	street VARCHAR(255) NOT NULL,
	number INT UNSIGNED NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,

	PRIMARY KEY (id),
	UNIQUE(name),
	UNIQUE(post_code, city, street, number),
	INDEX(created_at)
);

CREATE TABLE hours (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	department_id INT NOT NULL,
	starts_at DATETIME NOT NULL,
	ends_at DATETIME NOT NULL,
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP(),

	PRIMARY KEY (id),
	INDEX (starts_at),
	INDEX (ends_at),
	INDEX (created_at),
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

CREATE TABLE department_user (
	department_id INT NOT NULL,
	user_id INT NOT NULL,

	UNIQUE(department_id, user_id),
	FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ====== Default values ======
INSERT INTO user_types (name)
VALUES
	('Admin'),
	('Gebruiker');

INSERT INTO departments (name, post_code, city, street, number)
VALUES
	('West', '1000RB', 'Hamsterdam', 'Barbaralaan', 8),
	('Zuidoost', '1100RN', 'Hamsterdam', 'Ravenkooi', 14);

-- ====== Alterations ======
ALTER TABLE department_user
	ADD CONSTRAINT UNIQUE (department_id, user_id);

ALTER TABLE hours
	ADD CONSTRAINT hours_starts_before_end CHECK (starts_at < ends_at);