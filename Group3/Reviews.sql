CREATE TABLE Reviews
(
reviewID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
userID int,
albumID int,
rating int,
description text,
createdOn timestamp,
)