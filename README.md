**CentOS 7 LAMP install**
-------------------------
```
yum upgrade -y
yum install nano httpd gcc -y
yum install php php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt php-mbstring php-curl php-xml php-pear php-bcmath php-json php-pdo php-pecl-apcu php-pecl-apcu-devel -y
```
**Update MySQL repo**
```
nano /etc/yum.repos.d/MariaDB.repo
```

**inside MariaDB.repo**
```
[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/10.2/centos7-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1
```

**Install MariaDB from newly added repo**
```
yum install MariaDB-server MariaDB-client httpd -y
```

Start MySQL and Apache
----------------------
```
systemctl start mariadb.service

systemctl enable mariadb.service

systemctl start httpd
```


Update MySQL, Create a database for users and IPs
-------------------------------------------------
```
mysql_upgrade

mysql_secure_installation

mysql -pMyPassWord
```

Paste in to MySQL SSH terminal
------------------------------
```
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

/*Create Turtle Stresser Admin*/
call addUser('admin user', 'password', true);
```

Alow apache user to execute binarys via php
-------------------------------------------
```
chmod -R 777 /var/www/assets/server-attacks

semanage fcontext -a -t httpd_sys_script_exec_t "/var/www/html/assets/server-attacks/(.*)"

restorecon -R -v /var/www/html/assets/server-attacks/
```
