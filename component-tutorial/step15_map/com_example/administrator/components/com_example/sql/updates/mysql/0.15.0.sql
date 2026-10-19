ALTER TABLE `#__example_landmarks` 
ADD COLUMN `location` TEXT NOT NULL;
UPDATE `#__example_landmarks` 
SET `location` = '{"lat":"48.858222","long":"2.2945"}'
WHERE `title` = 'The Eiffel Tower';
UPDATE `#__example_landmarks` 
SET `location` = '{"lat":"55.240833","long":"-6.511667"}'
WHERE `title` = 'The Giant\'s Causeway';