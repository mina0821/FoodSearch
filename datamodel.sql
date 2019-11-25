create table Users(
	username varchar(30) not null,
	password varchar(30) not null,
	gender varchar(10),
	email varchar(30) not null,
	birthday date,
	primary key (username)
);

create table Object(
	name varchar(30) not null,
	rating float(1),
	lat float(2),
	longt float(2),
	primary key (name)
);

create table Review(
	name varchar(30) not null,
	review varchar(225) not null,
	primary key (name),
	foreign key (name) references Object (name) on delete cascade
);

INSERT INTO `object` (`name`, `rating`, `lat`, `longt`) VALUES ('Best Friend Hot Pot', '4.2', '43.59', '-79.59');
INSERT INTO `object` (`name`, `rating`, `lat`, `longt`) VALUES ('Chinese Legend Hot Pot', '1.8', '43.29', '-79.19');
INSERT INTO `object` (`name`, `rating`, `lat`, `longt`) VALUES ('Happy Lamb Hot Pot', '4.7', '43.57', '-79.66');
INSERT INTO `object` (`name`, `rating`, `lat`, `longt`) VALUES ('Kim Tao Hot Pot', '2.7', '43.85', '-79.38');
INSERT INTO `object` (`name`, `rating`, `lat`, `longt`) VALUES ('Morals Hot Pot', '3.9', '43.55', '-79.61');

INSERT INTO `review` (`name`, `review`) VALUES ('Best Friend Hot Pot', 'Nice place to eat.');
INSERT INTO `review` (`name`, `review`) VALUES ('Chinese Legend Hot Pot', 'Good place to eat.');
INSERT INTO `review` (`name`, `review`) VALUES ('Happy Lamb Hot Pot', 'Excellent place to eat.');
INSERT INTO `review` (`name`, `review`) VALUES ('Kim Tao Hot Pot', 'Good food.');
INSERT INTO `review` (`name`, `review`) VALUES ('Morals Hot Pot', 'Nice food.');