INSERT INTO `users` (`name`, `email`, `phoneNumber`, `dob`, `password`,`documentID`) VALUES
("mostafa", "mostafa@outlook.com", '+96124516', '2024-12-18', '12345678910', ''),
("ehab", "ehab@outlook.com", '+1234567654', '2022-12-18', '12345678910', ''),
("mohammad", "mohammad@outlook.com", '+96124516', '2024-12-18', '12345678910', '');

INSERT INTO `transactions` (`userId`,`amount`, `description`) VALUES
(1, 500, "deposit"),
(1, -500, "withdraw"),
(1, 500, "deposit");

