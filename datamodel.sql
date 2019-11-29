create table Users(
	username varchar(30) not null,
	password varchar(455) not null,
	email varchar(50) not null,
	birthday date,
	primary key (username)
);

create table Object(
	name varchar(100) not null,
	lat float(2),
	longt float(2),
	primary key (name)
);

create table Review(
	name varchar(30) not null,
	rating float(1) not null,
	review varchar(225) not null,
	foreign key (name) references Object (name) on delete cascade
);

INSERT INTO `Object` (`name`, `lat`, `longt`) VALUES ('Best Friend Hot Pot', '43.59', '-79.59');
INSERT INTO `Object` (`name`, `lat`, `longt`) VALUES ('Chinese Legend Hot Pot', '43.65', '-79.39');
INSERT INTO `Object` (`name`, `lat`, `longt`) VALUES ('Happy Lamb Hot Pot', '43.57', '-79.66');
INSERT INTO `Object` (`name`, `lat`, `longt`) VALUES ('Kim Tao Hot Pot', '43.85', '-79.38');
INSERT INTO `Object` (`name`, `lat`, `longt`) VALUES ('Morals Hot Pot', '43.55', '-79.61');

INSERT INTO `Review` (`name`, `rating`, `review`) VALUES ('Best Friend Hot Pot', '4.2', 'Nice place to eat.');
INSERT INTO `Review` (`name`, `rating`, `review`) VALUES ('Chinese Legend Hot Pot', '1.8', 'Good place to eat.');
INSERT INTO `Review` (`name`, `rating`, `review`) VALUES ('Happy Lamb Hot Pot', '4.7', 'Excellent place to eat.');
INSERT INTO `Review` (`name`, `rating`, `review`) VALUES ('Kim Tao Hot Pot', '2.7', 'Good food.');
INSERT INTO `Review` (`name`, `rating`, `review`) VALUES ('Morals Hot Pot', '3.9', 'Nice food.');