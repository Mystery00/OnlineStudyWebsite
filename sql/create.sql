
drop table if exists tb_choose;
drop table if exists tb_course;
drop table if exists tb_resource;
drop table if exists tb_student;
drop table if exists tb_teacher;
drop table if exists tb_user;

CREATE SCHEMA `db_online_study_website` DEFAULT CHARACTER SET utf8 ;


CREATE TABLE `db_online_study_website`.`tb_user` (
  `user_id` VARCHAR(20) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `user_type` VARCHAR(10) NOT NULL,
  `link_id` VARCHAR(20) NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE `db_online_study_website`.`tb_student` (
  `student_id` VARCHAR(20) NOT NULL,
  `student_name` VARCHAR(20) NOT NULL,
  `student_sex` VARCHAR(1) NOT NULL,
  `student_birthday` DATE NOT NULL,
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE `db_online_study_website`.`tb_teacher` (
  `teacher_id` VARCHAR(20) NOT NULL,
  `teacher_name` VARCHAR(20) NOT NULL,
  `teacher_sex` VARCHAR(1) NOT NULL,
  `teacher_birthday` DATE NOT NULL,
  PRIMARY KEY (`teacher_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE `db_online_study_website`.`tb_course` (
  `course_id` VARCHAR(20) NOT NULL,
  `course_name` VARCHAR(20) NOT NULL,
  `course_intro` TEXT NULL,
  `course_time` VARCHAR(30) NULL,
  `teacher_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`course_id`),
  INDEX `teacher_id_idx` (`teacher_id` ASC),
  CONSTRAINT `FK_course_teacher`
    FOREIGN KEY (`teacher_id`)
    REFERENCES `db_online_study_website`.`tb_teacher` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE `db_online_study_website`.`tb_choose` (
  `student_id` VARCHAR(20) NOT NULL,
  `course_id` VARCHAR(20) NOT NULL,
  `test_name` VARCHAR(30) NULL,
  `test_score` FLOAT NULL,
  INDEX `FK_choose_student_idx` (`student_id` ASC),
  INDEX `FK_choose_course_idx` (`course_id` ASC),
  CONSTRAINT `FK_choose_student`
    FOREIGN KEY (`student_id`)
    REFERENCES `db_online_study_website`.`tb_student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_choose_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_online_study_website`.`tb_course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE `db_online_study_website`.`tb_resource` (
  `resource_id` VARCHAR(20) NOT NULL,
  `resource_name` VARCHAR(45) NOT NULL,
  `resource_path` TEXT NOT NULL,
  `course_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`resource_id`),
  INDEX `FK_resource_course_idx` (`course_id` ASC),
  CONSTRAINT `FK_resource_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_online_study_website`.`tb_course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
