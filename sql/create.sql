
drop table if exists tb_choose;
drop table if exists tb_course;
drop table if exists tb_resource;
drop table if exists tb_student;
drop table if exists tb_teacher;
drop table if exists tb_user;

CREATE TABLE tb_user
(
    user_id varchar(20) PRIMARY KEY NOT NULL,
    username varchar(20) NOT NULL,
    password varchar(20) NOT NULL,
    user_type varchar(10) NOT NULL,
    link_id varchar(20)
);

CREATE TABLE tb_student
(
    student_id varchar(20) PRIMARY KEY NOT NULL,
    student_name varchar(20) NOT NULL,
    student_sex varchar(1) NOT NULL,
    student_birthday date NOT NULL
);

CREATE TABLE tb_teacher
(
    teacher_id varchar(20) PRIMARY KEY NOT NULL,
    teacher_name varchar(20) NOT NULL,
    teacher_sex varchar(1) NOT NULL,
    teacher_birthday date NOT NULL
);

CREATE TABLE tb_course
(
    course_id varchar(20) PRIMARY KEY NOT NULL,
    course_name varchar(20) NOT NULL,
    course_intro TEXT,
    course_time VARCHAR(30),
    teacher_id varchar(20) NOT NULL,
    CONSTRAINT tb_course_tb_teacher_teacher_id_fk FOREIGN KEY (teacher_id) REFERENCES tb_teacher (teacher_id)
);

CREATE TABLE tb_choose
(
    student_id varchar(20) NOT NULL,
    course_id varchar(20) NOT NULL,
    test_name varchar(30),
    test_score float NOT NULL,
    CONSTRAINT tb_choose_tb_student_student_id_fk FOREIGN KEY (student_id) REFERENCES tb_student (student_id),
    CONSTRAINT tb_choose_tb_course_course_id_fk FOREIGN KEY (course_id) REFERENCES tb_course (course_id)
);

CREATE TABLE tb_resource
(
    resource_id varchar(20) PRIMARY KEY NOT NULL,
    resource_name varchar(30) NOT NULL,
    resource_path TEXT NOT NULL,
    course_id varchar(20) NOT NULL,
    CONSTRAINT tb_resource_tb_course_course_id_fk FOREIGN KEY (course_id) REFERENCES tb_course (course_id)
);