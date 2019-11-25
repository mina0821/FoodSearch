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