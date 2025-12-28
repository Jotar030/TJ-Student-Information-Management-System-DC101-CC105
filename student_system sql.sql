USE student_system;

DROP TABLE IF EXISTS students;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NULL,
    last_name VARCHAR(50) NOT NULL,
    student_number VARCHAR(15) NOT NULL UNIQUE,
    mobile_number VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    course VARCHAR(50) NOT NULL,
    section VARCHAR(5) NOT NULL,
    year_level VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



