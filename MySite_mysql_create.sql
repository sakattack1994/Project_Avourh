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
	`LevelOfStudies` varchar(100) NOT NULL,
	`OfficialWebsite` varchar(100),
	`EclassLink` varchar(100),
	`EudoxusLink` varchar(100),
	`EctsΔ` int NOT NULL,
	`EctsΑ` int NOT NULL,
	`EctsΕ` int NOT NULL,
	`Sector` varchar(100) NOT NULL,
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
	`StudyScheduleID` varchar(50) NOT NULL  ,
	PRIMARY KEY (`ProfessorID`,`LessonID`,`StudyScheduleID`)
);

CREATE TABLE `Professor_Lessons_LastYears` (
	`ProfessorID` varchar(10) NOT NULL  ,
	`LessonID` varchar(10) NOT NULL  ,
	`StudyScheduleID` varchar(50) NOT NULL  ,
	PRIMARY KEY (`ProfessorID`,`LessonID`,`StudyScheduleID`)
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

CREATE TABLE `Study_Schedule` (
	`id` varchar(100) NOT NULL  ,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
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

ALTER TABLE `Professor_Lessons_ThisYear` ADD CONSTRAINT `Professor_Lessons_ThisYear_fk2` FOREIGN KEY (`StudyScheduleID`) REFERENCES `study_schedule`(`id`);

ALTER TABLE `Professor_Lessons_LastYears` ADD CONSTRAINT `Professor_Lessons_LastYears_fk0` FOREIGN KEY (`ProfessorID`) REFERENCES `Professors`(`ProfessorID`);

ALTER TABLE `Professor_Lessons_LastYears` ADD CONSTRAINT `Professor_Lessons_LastYears_fk1` FOREIGN KEY (`LessonID`) REFERENCES `Lessons`(`LessonID`);

ALTER TABLE `Professor_Lessons_LastYears` ADD CONSTRAINT `Professor_Lessons_LastYears_fk2` FOREIGN KEY (`StudyScheduleID`) REFERENCES `study_schedule`(`id`);

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

INSERT INTO study_schedule VALUES ('1','Study guide 2016-2017');

INSERT INTO lessons VALUES ('ECE_Y101','ΔΙΑΦΟΡΙΚΟΣ ΛΟΓΙΣΜΟΣ ΚΑΙ ΜΑΘΗΜΑΤΙΚΗ ΑΝΑΛΥΣΗ','ΜΑΘΗΜΑΤΙΚΑ','ΔΙΔΑΣΚΑΛΙΑ',1,'Postgraduate','LESSON_LINK','ECLASS_LINK','EVDO3OS_LINK',4,2,0,'ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ','ΓΡΑΠΤΗ','ΩΡΕΣ','ΣΤΑΤΙΣΤΙΚΑ','ΥΛΗ');

INSERT INTO lessons VALUES ('ECE_Y102','ΦΥΣΙΚΗ 1','ΦΥΣΙΚΗ','ΔΙΔΑΣΚΑΛΙΑ',1,'Postgraduate','LESSON_LINK','ECLASS_LINK','EVDO3OS_LINK',3,1,2,'ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ','ΓΡΑΠΤΗ','ΩΡΕΣ','ΣΤΑΤΙΣΤΙΚΑ','ΥΛΗ');

INSERT INTO lessons VALUES ('ECE_Y103N','ΕΙΣΑΓΩΓΗ ΣΤΟΥΣ ΥΠΟΛΟΓΙΣΤΕΣ','ΠΡΟΓΡΑΜΜΑΤΙΣΜΟΣ','ΔΙΔΑΣΚΑΛΙΑ',1,'Postgraduate','LESSON_LINK','ECLASS_LINK','EVDO3OS_LINK',4,1,2,'ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ','ΓΡΑΠΤΗ','ΩΡΕΣ','ΣΤΑΤΙΣΤΙΚΑ','ΥΛΗ');

INSERT INTO lessons VALUES ('ECE_Y103L','ΕΙΣΑΓΩΓΗ ΣΤΟΥΣ ΥΠΟΛΟΓΙΣΤΕΣ','ΠΡΟΓΡΑΜΜΑΤΙΣΜΟΣ','ΕΡΓΑΣΤΗΡΙΟ',1,'Postgraduate','LESSON_LINK','ECLASS_LINK','EVDO3OS_LINK',4,1,2,'ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ','ΓΡΑΠΤΗ','ΩΡΕΣ','ΣΤΑΤΙΣΤΙΚΑ','ΥΛΗ');

INSERT INTO lessons VALUES ('ECE_Y102Ε','ΦΥΣΙΚΗ 1','ΠΡΟΓΡΑΜΜΑΤΙΣΜΟΣ','ΕΡΓΑΣΤΗΡΙΟ',1,'Postgraduate','LESSON_LINK','ECLASS_LINK','EVDO3OS_LINK',4,1,2,'ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ','ΓΡΑΠΤΗ','ΩΡΕΣ','ΣΤΑΤΙΣΤΙΚΑ','ΥΛΗ');

INSERT INTO members VALUES ('perdios','pw','Ευσταθιος','Περδιος');

INSERT INTO members VALUES ('kalantonis','pw','Βασιλειος','Καλαντωνης');

INSERT INTO members VALUES ('kounavis','pw','Παναγιωτης','Κουναβης');

INSERT INTO members VALUES ('avourhs','pw','Αβουρης','Νικολαος');

INSERT INTO professors VALUES ('perdios','Ευσταθιος','Περδιος','Καθηγητης','CH','RESUME','ΓΕΝΙΚΟ ΤΜΗΜΑ','+302610997897','+30610997897','eperdios@upatras.gr','Τετάρτη 14-17 Πεμπτη 15-18 ','website','scholar');

INSERT INTO professors VALUES ('kalantonis','Βασιλειος','Καλαντωνης','Καθηγητης','CH','RESUME','ΓΕΝΙΚΟ ΤΜΗΜΑ','+302610996868','+302610996868','kalantonis@upatras.gr','Τετάρτη 14-17 Πεμπτη 15-18 ','website','scholar');

INSERT INTO professors VALUES ('kounavis','Παναγιωτης','Κουναβης','Καθηγητης','CH','RESUME','ΓΕΝΙΚΟ ΤΜΗΜΑ','+302610996868','+302610996868','pkounavis@upatras.gr','Τετάρτη 14-17 Πεμπτη 15-18 ','website','scholar');

INSERT INTO professors VALUES ('avourhs','Αβουρης','Νικολαος','Καθηγητης','CH','RESUME','ΓΕΝΙΚΟ ΤΜΗΜΑ','+302610996868','+302610996868','avouris@upatras.gr','Τετάρτη 14-17 Πεμπτη 15-18 ','website','scholar');

INSERT INTO professor_lessons_thisyear VALUES ('perdios','ECE_Y101','1');

INSERT INTO professor_lessons_thisyear VALUES ('kalantonis','ECE_Y101','1');

INSERT INTO professor_lessons_thisyear VALUES ('kounavis','ECE_Y102','1');

INSERT INTO professor_lessons_thisyear VALUES ('avourhs','ECE_Y103N','1');

INSERT INTO relative_courses VALUES ('ECE_Y101','ECE_Y103N');

INSERT INTO relative_courses VALUES ('ECE_Y101','ECE_Y102');

INSERT INTO books VALUES ('1111','MATHIMATIKA','George R',2016,331,'Savalas','Perigrafh','a');

INSERT INTO books VALUES ('1121','fisiki','George R',2016,331,'Savalas','Perigrafh','a');

INSERT INTO books VALUES ('2111','PCS','George R',2016,331,'Savalas','Perigrafh','a');

INSERT INTO lesson_book VALUES ('ECE_Y101','1111');

INSERT INTO lesson_book VALUES ('ECE_Y102','1121');

INSERT INTO lesson_book VALUES ('ECE_Y103N','2111');

INSERT INTO lessons_labs VALUES ('ECE_Y102','ECE_Y102Ε');

INSERT INTO lessons_labs VALUES ('ECE_Y103N','ECE_Y103L');

