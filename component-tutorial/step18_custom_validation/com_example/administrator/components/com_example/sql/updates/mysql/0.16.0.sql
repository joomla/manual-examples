ALTER TABLE `#__example_landmarks` 
ADD COLUMN `params` TEXT NOT NULL;
UPDATE `#__example_landmarks` 
SET `params` = '{}';