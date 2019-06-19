# Vendon_uzd

INFO:
Simple PHP quiz. Form is a little bit responsive, but not ideal.

* mysql_dump_19.06.2019.sql - MySQL database dump with test data
* index.php - homepage
* questions.php - get questions from DB and show with possible answers (Random answer ordering)
* check.php - show final result
* /class/db.php - DB class for connectind to DB and creating main tables
* /class/questions.php - class for showing data about questions and answers
* /assets/css/main.css - main css style
* /assets/js/check.js - JS form submit checks functions
* /assets/js/quest.js - JS progress function. 

Used: 
HTML,CSS,PHP,MySQL and JavaScript

INSTALL:
* copy all files to root web folder
* Import MySQL dump
* Change DB connection in /class/db.php


ADDING QUESTIONS & ANSWERS:

create new name for quiz in questionnaire (active - mean quiz is active)
* INSERT INTO `questionnaire`(`name`, `active`) VALUES ('Test',1);

Create new questions (name_id - quiz id)
* INSERT INTO `questions`(`name_id`, `questions`, `order`) VALUES (1,'1+1',1);
* INSERT INTO `questions`(`name_id`, `questions`, `order`) VALUES (1,'2+1',2);
* INSERT INTO `questions`(`name_id`, `questions`, `order`) VALUES (1,'5+5',3);

Create answers (q_id = question ID , correct = means correct answer)

* INSERT INTO `answers`(`q_id`, `answer`, `correct`) VALUES (1,'3',0);
* INSERT INTO `answers`(`q_id`, `answer`, `correct`) VALUES (1,'2',1);
* INSERT INTO `answers`(`q_id`, `answer`, `correct`) VALUES (1,'1',0);

USED ENVIRONMENT (UsbWebServer V 8.5):
* Apache 2.4.6
* PHP 5.6.32
* MySQL 5.6.34

TESTED ON: 
* Chrome 75.0.3770.90 x64
* Mozilla Firefox 66.0.5 x64
* Microsoft Edge 44.17763 x64
* Chrome on android 8 75.0.3770.89
