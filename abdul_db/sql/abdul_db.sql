CREATE DATABASE abdul_db;

USE abdul_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    register_number VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teacher', 'student') NOT NULL
);

CREATE TABLE study_materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100),
    course VARCHAR(50),
    year INT,
    pdf_url VARCHAR(255)
);


CREATE TABLE question_papers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    pdf_url TEXT NOT NULL
);


INSERT INTO users (username, register_number, password, role) VALUES
('admin_user', 'A12345', 'adminpassword', 'admin'),
('teacher_user', 'T12345', 'teacherpassword', 'teacher'),
('student_user1', 'S12345', 'studentpassword', 'student'),
('student_user2', 'S12346', 'studentpassword', 'student');
