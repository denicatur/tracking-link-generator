CREATE DATABASE tracking_db;

USE tracking_db;

CREATE TABLE links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    original_url TEXT NOT NULL,
    tracking_code VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE tracking_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_code VARCHAR(50) NOT NULL,
    ip VARCHAR(50) NOT NULL,
    user_agent TEXT NOT NULL,
    time DATETIME NOT NULL,
    location TEXT NOT NULL
);