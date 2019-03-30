CREATE SCHEMA `quiz`;
USE `quiz`;

CREATE TABLE `answers` (
	`id` INT(10) UNSIGNED NOT NULL,
	`text` VARCHAR(180) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='Entity to hold answers to questions Entity'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `questions` (
	`id` INT(10) UNSIGNED NOT NULL PRIMARY KEY,
	`text` TEXT CHARACTER SET utf8 NULL,
	`correct_answer_id` INT(10) UNSIGNED NULL DEFAULT NULL
)
COMMENT='Entity representing a quiz question, has a foreing key to an answer id that represents the associated correct answer tot this quiz question'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `answers_questions` (
    `answer_id` INT(10) UNSIGNED NOT NULL,
    `question_id` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`answer_id`, `question_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

# ADD CONSTRAINTS SO MYSQL CAN NAG ABOUT THINGS THAT REFERENCE OTHER STUFF
ALTER TABLE `questions` ADD CONSTRAINT
`fk_correct_answer_id_question_id` FOREIGN KEY (`correct_answer_id`) REFERENCES `answers`(`id`);

ALTER TABLE `answers_questions` ADD CONSTRAINT
`fk_answers_questions_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers`(`id`);

ALTER TABLE `answers_questions` ADD CONSTRAINT
`fk_answers_questions_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`);

# CREATE INDEXES ON FOREIGN KEY COLUMN AND JOIN TABLE TO SPEED THINGS UP A BIT
CREATE INDEX `idx_fk_correct_answer_question_id` ON `questions`(`correct_answer_id`);
CREATE INDEX `idx_fk_answers_questions` ON `answers_questions`(`answer_id`,`question_id`);

#REDACTIESOMMEN 14
# vraag 1
INSERT INTO `answers` (`id`,`text`) 
VALUES 
(1, '105 minuten'),
(2, '65 minuten'), 
(3, '95 minuten'), 
(4, '55 minuten'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (1, 'Het tv-programma \'Pig Panter\' duurt van 17.40 tot 18.45 uur. Hoeveel minuten zijn dat?', 2); 

INSERT INTO `answers_questions` (`answer_id`,`question_id`)
VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

# vraag 2
INSERT INTO `answers` (`id`,`text`) 
VALUES  
(5, '27'),
(6, '18'), 
(7, '3'), 
(8, '36'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (2, 'De groep van meester Bartjes bestaat uit 1/3 deel jongens. Er zijn 9 jongens. Hoeveel meisjes zitten er in de groep?', 6); 

INSERT INTO `answers_questions` (`answer_id`, `question_id`)
VALUES
(5, 2),
(6, 2),
(7, 2),
(8, 2);

# vraag 3
INSERT INTO `answers` (`id`,`text`) 
VALUES  
(9, '6.39'),
(10, '6.53'), 
(11, '7.07'), 
(12, '7.11'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (3, 'De klok loopt 14 minuten achter. Hij wijst 7 minuten voor 7 uur aan. Hoe laat is het dan eigenlijk', 11); 

INSERT INTO `answers_questions` (`answer_id`, `question_id`)
VALUES
(9, 3),
(10, 3),
(11, 3),
(12, 3);

# vraag 4
INSERT INTO `answers` (`id`,`text`) 
VALUES  
(13, '€45,39'),
(14, '€30,60'), 
(15, '€ 7,65'), 
(16, '€ 5,10'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (4, 'Zes jongens sparen postzegels. Ze kopen ieder voor € 45,90 aan postzegels. Later wordt de totale waarde verdeeld onder 9 jongens. Hoeveel krijgt ieder?', 14); 

INSERT INTO `answers_questions` (`answer_id`, `question_id`)
VALUES
(13, 4),
(14, 4),
(15, 4),
(16, 4);

# vraag 5
INSERT INTO `answers` (`id`,`text`) 
VALUES  
(17, '168'),
(18, '126'), 
(19, '42'), 
(20, '840'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (5, 'Vijftig procent van 84 appels heet rotte plekken. Hoeveel appels zijn er helemaal gaaf?', 19); 

INSERT INTO `answers_questions` (`answer_id`, `question_id`)
VALUES
(17, 5),
(18, 5),
(19, 5),
(20, 5);

# vraag 6
INSERT INTO `answers` (`id`,`text`) 
VALUES  
(21, '13 1/2 uur'),
(22, '9 1/2 uur'), 
(23, '10 1/2 uur'), 
(24, '7'); 

INSERT INTO `questions` (`id`,`text`, `correct_answer_id`) 
VALUES (6, 'Sjoerd gaat om 21.15 uur naar bed. Om 21.30 valt hij in slaap. Hij wordt morgen om 8.00 uur wakker. Hoe lang heeft hij geslapen', 23); 

INSERT INTO `answers_questions` (`answer_id`, `question_id`)
VALUES
(21, 6),
(22, 6),
(23, 6),
(24, 6);



