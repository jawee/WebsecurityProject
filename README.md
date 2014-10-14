Project in Websecurity

Database structure
Users
```
+---------------+--------------+------+-----+---------+----------------+
| Field         | Type         | Null | Key | Default | Extra          |
+---------------+--------------+------+-----+---------+----------------+
| id            | int(11)      | NO   | PRI | NULL    | auto_increment |
| username      | varchar(255) | YES  |     | NULL    |                |
| password      | varchar(255) | YES  |     | NULL    |                |
| streetAddress | varchar(255) | YES  |     | NULL    |                |
| zipcode       | varchar(255) | YES  |     | NULL    |                |
| city          | varchar(255) | YES  |     | NULL    |                |
| country       | varchar(255) | YES  |     | NULL    |                |
+---------------+--------------+------+-----+---------+----------------+
```

Products
```
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| productname | varchar(255) | YES  |     | NULL    |                |
| image       | varchar(255) | YES  |     | NULL    |                |
| description | text         | YES  |     | NULL    |                |
| price       | int(11)      | YES  |     | NULL    |                |
| stock       | int(11)      | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
```

LoginAttempts
```
+----------+---------+------+-----+---------+-------+
| Field    | Type    | Null | Key | Default | Extra |
+----------+---------+------+-----+---------+-------+
| userId   | int(11) | NO   | PRI | NULL    |       |
| attempts | int(11) | NO   |     | NULL    |       |
+----------+---------+------+-----+---------+-------+
````

How to use:

Copy file config/database.default.php to config/database.php. Edit and add database information.

Import database.sql into your database.

Done.