/* MariaDB 10 + */
create database USER_INFO_DB;
use USER_INFO_DB;
set global sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

create table USER
(
  USER_ID int primary key AUTO_INCREMENT,
  USER_NAME varchar(25) not null,
  USER_PASS varchar(25) not null,
  IS_ADMIN boolean not null default FALSE,
  RECENT_IP varchar(15)
);

create table IP_HISTORY
(
  USER_ID int references USER(USER_ID),
  LOGGED_IP varchar(15) not null,
  LOGGIN_DATE datetime not null default NOW()
);

create view STORED_IP as select u.USER_NAME, h.LOGGED_IP, h.LOGGIN_DATE from IP_HISTORY h inner join USER u on h.USER_ID = u.USER_ID;

DELIMITER $$ ;

create procedure addUser (in NAME varchar(25), in PASS varchar(25), in ADMIN boolean)
begin
  insert into USER (USER_NAME, USER_PASS, IS_ADMIN) values (NAME, PASS, ADMIN);
end
$$

create procedure logIP (in ID int, in IP varchar(15))
begin
  update USER set RECENT_IP = IP where USER_ID = ID;
  insert into IP_HISTORY (USER_ID, LOGGED_IP) values (ID, IP);
end
$$

DELIMITER ; $$
