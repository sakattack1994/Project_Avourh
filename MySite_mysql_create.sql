CREATE TABLE `Students` (
	`StudentID` varchar(10) NOT NULL  ,
	`FirstName` varchar(20) NOT NULL,
	`LastName` varchar(20) NOT NULL,
	`Photo` longblob NOT NULL,
	`Telephone` varchar(50) NOT NULL,
	`Address` varchar(100) NOT NULL,
	`Email` varchar(30) NOT NULL,
	`LevelOfStudies` int NOT NULL,
	`Semester` int NOT NULL,
	PRIMARY KEY (`StudentID`)
);

CREATE TABLE `Lessons` (
	`LessonID` varchar(10) NOT NULL  ,
	`Title` varchar(50) NOT NULL,
	`Description` varchar(1000) NOT NULL,
	`Type` varchar(100) NOT NULL,
	`Semester` int NOT NULL,
	`LevelOfStudies` int NOT NULL,
	`OfficialWebsite` varchar(100),
	`EclassLink` varchar(100),
	`EudoxusLink` varchar(100),
	`Ects` int NOT NULL,
	`Sector` varchar(20) NOT NULL,
	`SystemOfExamination` varchar(200) NOT NULL,
	`TeachingHoursAndPlace` varchar(100),
	`StatisticsOfEvaluations` varchar(200) NOT NULL,
	`Curriculum` varchar(300) NOT NULL,
	PRIMARY KEY (`LessonID`)
);

CREATE TABLE `Members` (
	`ID` varchar(10) NOT NULL  ,
	`Password` varchar(100) NOT NULL,
	`FirstName` varchar(20) NOT NULL,
	`LastName` varchar(20) NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Secretariat` (
	`SecretariatID` varchar(10) NOT NULL  ,
	`FirstName` varchar(20) NOT NULL,
	`LastName` varchar(20) NOT NULL,
	`Photo` longblob NOT NULL,
	`Telephone` varchar(100) NOT NULL,
	`Fax` varchar(100) NOT NULL,
	`Email` varchar(100) NOT NULL,
	PRIMARY KEY (`SecretariatID`)
);

CREATE TABLE `Professors` (
	`ProfessorID` varchar(10) NOT NULL  ,
	`FirstName` varchar(20) NOT NULL  ,
	`LastName` varchar(20) NOT NULL,
	`Role` varchar(100) NOT NULL,
	`Photo` longblob NOT NULL,
	`Resume` varchar(100) NOT NULL,
	`Sector` varchar(100),
	`Telephone` varchar(50) NOT NULL,
	`Fax` varchar(100),
	`Email` varchar(100) NOT NULL,
	`ΗoursForStudents` varchar(100) NOT NULL,
	`Website` varchar(100) NOT NULL,
	`GoogleScholar` varchar(100),
	PRIMARY KEY (`ProfessorID`)
);

CREATE TABLE `Books` (
	`ISBN` varchar(100) NOT NULL  ,
	`Title` varchar(100) NOT NULL,
	`Author` varchar(100) NOT NULL,
	`YearΟfPublishing` int NOT NULL,
	`PublicationNumber` int NOT NULL,
	`Publisher` varchar(100) NOT NULL,
	`Description` varchar(1000) NOT NULL,
	`Cover` longblob,
	PRIMARY KEY (`ISBN`)
);

CREATE TABLE `Students_Lessons_enroll` (
	`StudentID` varchar(10) NOT NULL  ,
	`LessonID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`StudentID`,`LessonID`)
);

CREATE TABLE `Lesson_Book` (
	`LessonID` varchar(10) NOT NULL  ,
	`ISBN` varchar(100) NOT NULL  ,
	PRIMARY KEY (`LessonID`,`ISBN`)
);

CREATE TABLE `ScientificPublications` (
	`PublicationID` varchar(100) NOT NULL  ,
	`Title` varchar(100) NOT NULL,
	`YearOfPublish` DATE NOT NULL,
	PRIMARY KEY (`PublicationID`)
);

CREATE TABLE `Professors_Publications` (
	`ProfessorID` varchar(10) NOT NULL  ,
	`PublicationID` varchar(100) NOT NULL  ,
	PRIMARY KEY (`ProfessorID`,`PublicationID`)
);

CREATE TABLE `Professor_Lessons_ThisYear` (
	`ProfessorID` varchar(10) NOT NULL  ,
	`LessonID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`ProfessorID`,`LessonID`)
);

CREATE TABLE `Professor_Lessons_LastYears` (
	`ProfessorID` varchar(10) NOT NULL  ,
	`LessonID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`ProfessorID`,`LessonID`)
);

CREATE TABLE `Comments` (
	`CommentID` varchar(100) NOT NULL  ,
	`CommentText` varchar(100000) NOT NULL,
	PRIMARY KEY (`CommentID`)
);

CREATE TABLE `Lesson_Comments` (
	`LessonID` varchar(10) NOT NULL  ,
	`CommentID` varchar(100) NOT NULL  ,
	`StudentID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`LessonID`,`CommentID`,`StudentID`)
);

CREATE TABLE `Week_Schedule` (
	`LessonID` varchar(10) NOT NULL,
	`Days` varchar(100) NOT NULL,
	`Hours` varchar(100) NOT NULL,
	`PlaceOfTeaching` varchar(100) NOT NULL
);

CREATE TABLE `Academic_Calendar` (
	`Semester` varchar(100) NOT NULL,
	`Start` DATE NOT NULL,
	`End` DATE NOT NULL,
	`Season` varchar(100) NOT NULL,
	`TypeOfHoliday` varchar(100) NOT NULL
);

CREATE TABLE `Announcements` (
	`ID` varchar(100) NOT NULL  ,
	`Header` varchar(100) NOT NULL,
	`Content` varchar(10000000) NOT NULL,
	`Category` varchar(100) NOT NULL,
	`date` DATETIME NOT NULL,
	PRIMARY KEY (`ID`)
);

CREATE TABLE `Attachments` (
	`ID` varchar(100) NOT NULL,
	`dir` varchar(100) NOT NULL ,
	PRIMARY KEY (`dir`)
);

CREATE TABLE `Relative_Courses` (
	`LessonID` varchar(10) NOT NULL  ,
	`RelativeLessonID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`LessonID`,`RelativeLessonID`)
);

CREATE TABLE `Lessons_Labs` (
	`LessonID` varchar(10) NOT NULL  ,
	`LabID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`LessonID`,`LabID`)
);

CREATE TABLE `Passed_Lessons` (
	`StudentID` varchar(10) NOT NULL  ,
	`LessonID` varchar(10) NOT NULL  ,
	PRIMARY KEY (`StudentID`,`LessonID`)
);

CREATE TABLE `Study_Guide` (
	`url` varchar(100) NOT NULL,
	`id` varchar(100) NOT NULL  ,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Study_Guide_Lessons` (
	`LessonID` varchar(10) NOT NULL  ,
	`StudyGuideID` varchar(100) NOT NULL  ,
	PRIMARY KEY (`LessonID`,`StudyGuideID`)
);

ALTER TABLE `Students` ADD CONSTRAINT `Students_fk0` FOREIGN KEY (`StudentID`) REFERENCES `Members`(`ID`);

ALTER TABLE `Secretariat` ADD CONSTRAINT `Secretariat_fk0` FOREIGN KEY (`SecretariatID`) REFERENCES `Members`(`ID`);

ALTER TABLE `Professors` ADD CONSTRAINT `Professors_fk0` FOREIGN KEY (`ProfessorID`) REFERENCES `Members`(`ID`);

ALTER TABLE `Students_Lessons_enroll` ADD CONSTRAINT `Students_Lessons_enroll_fk0` FOREIGN KEY (`StudentID`) REFERENCES `Students`(`StudentID`);

ALTER TABLE `Students_Lessons_enroll` ADD CONSTRAINT `Students_Lessons_enroll_fk1` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lesson_Book` ADD CONSTRAINT `Lesson_Book_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lesson_Book` ADD CONSTRAINT `Lesson_Book_fk1` FOREIGN KEY (`ISBN`) REFERENCES `Books`(`ISBN`);

ALTER TABLE `Professors_Publications` ADD CONSTRAINT `Professors_Publications_fk0` FOREIGN KEY (`ProfessorID`) REFERENCES `Professors`(`ProfessorID`);

ALTER TABLE `Professors_Publications` ADD CONSTRAINT `Professors_Publications_fk1` FOREIGN KEY (`PublicationID`) REFERENCES `ScientificPublications`(`PublicationID`);

ALTER TABLE `Professor_Lessons_ThisYear` ADD CONSTRAINT `Professor_Lessons_ThisYear_fk0` FOREIGN KEY (`ProfessorID`) REFERENCES `Professors`(`ProfessorID`);

ALTER TABLE `Professor_Lessons_ThisYear` ADD CONSTRAINT `Professor_Lessons_ThisYear_fk1` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Professor_Lessons_LastYears` ADD CONSTRAINT `Professor_Lessons_LastYears_fk0` FOREIGN KEY (`ProfessorID`) REFERENCES `Professors`(`ProfessorID`);

ALTER TABLE `Professor_Lessons_LastYears` ADD CONSTRAINT `Professor_Lessons_LastYears_fk1` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lesson_Comments` ADD CONSTRAINT `Lesson_Comments_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lesson_Comments` ADD CONSTRAINT `Lesson_Comments_fk1` FOREIGN KEY (`CommentID`) REFERENCES `Comments`(`CommentID`);

ALTER TABLE `Lesson_Comments` ADD CONSTRAINT `Lesson_Comments_fk2` FOREIGN KEY (`StudentID`) REFERENCES `Students`(`StudentID`);

ALTER TABLE `Week_Schedule` ADD CONSTRAINT `Week_Schedule_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);


ALTER TABLE `Attachments` ADD CONSTRAINT `Attachments_fk0` FOREIGN KEY (`ID`) REFERENCES `announcements`(`ID`);

ALTER TABLE `Relative_Courses` ADD CONSTRAINT `Relative_Courses_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Relative_Courses` ADD CONSTRAINT `Relative_Courses_fk1` FOREIGN KEY (`RelativeLessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lessons_Labs` ADD CONSTRAINT `Lessons_Labs_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Lessons_Labs` ADD CONSTRAINT `Lessons_Labs_fk1` FOREIGN KEY (`LabID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Passed_Lessons` ADD CONSTRAINT `Passed_Lessons_fk0` FOREIGN KEY (`StudentID`) REFERENCES `Students`(`StudentID`);

ALTER TABLE `Passed_Lessons` ADD CONSTRAINT `Passed_Lessons_fk1` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Study_Guide_Lessons` ADD CONSTRAINT `Study_Guide_Lessons_fk0` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Study_Guide_Lessons` ADD CONSTRAINT `Study_Guide_Lessons_fk1` FOREIGN KEY (`StudyGuideID`) REFERENCES `Study_Guide`(`id`);

INSERT INTO study_guide
VALUES ('/myDepartment/myresources/study_guide/study_guide_2016-2017.pdf','study_guide_2016-2017','study_guide_2016-2017');

INSERT INTO study_guide
VALUES ('/myDepartment/myresources/study_guide/study_guide_2015-2016.pdf','study_guide_2015-2016','study_guide_2015-2016');

INSERT INTO study_guide
VALUES ('/myDepartment/myresources/study_guide/study_guide_2014-2015.pdf','study_guide_2014-2015','study_guide_2014-2015');

INSERT INTO announcements
VALUES ('id3','titlos','periexomeno','skata',CURRENT_TIMESTAMP);

INSERT INTO attachments
VALUES ('id3','/myDepartment/myresources/attachments/announcements/c005_project_2015_2016.pdf');

INSERT INTO attachments
VALUES ('id3','/myDepartment/myresources/attachments/announcements/Εγγραφές_2016_2017_μετεγγραφές.doc');
