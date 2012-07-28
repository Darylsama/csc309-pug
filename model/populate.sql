# pug populate script

use mydb

#real users
insert into users (username, password, type, lastname, firstname) values ('admin', 'password', 2, 'Li', 'Xiang');
insert into users (username, password, type, lastname, firstname) values ('yang', 'password', 2, 'Sun', 'Yang');
insert into users (username, password, type, lastname, firstname) values ('daryl', 'password', 2, 'Zhou', 'Daryl');

#dummy users
insert into users (username, password, type, firstname, lastname) values ('Proin', 'eu', 1, 'Xandra', 'Diaz');
insert into users (username, password, type, firstname, lastname) values ('auctor', 'Nunc', 1, 'Gisela', 'Dawson');
insert into users (username, password, type, firstname, lastname) values ('sed', 'diam', 1, 'Reuben', 'Bryant');
insert into users (username, password, type, firstname, lastname) values ('eget', 'sapien', 1, 'Courtney', 'Watkins');
insert into users (username, password, type, firstname, lastname) values ('varius', 'nec', 1, 'Hiroko', 'Stanley');
insert into users (username, password, type, firstname, lastname) values ('facilisis', 'magnis', 1, 'Odysseus', 'Joyner');
insert into users (username, password, type, firstname, lastname) values ('enim', 'lacus', 1, 'Rahim', 'Guthrie');
insert into users (username, password, type, firstname, lastname) values ('egestas', 'et', 1, 'Jane', 'Turner');
insert into users (username, password, type, firstname, lastname) values ('tincidunt', 'orci', 1, 'Whilemina', 'Robertson');
insert into users (username, password, type, firstname, lastname) values ('velit', 'per', 1, 'Graiden', 'Barrett');
insert into users (username, password, type, firstname, lastname) values ('felis', 'et', 1, 'Hector', 'Whitehead');
insert into users (username, password, type, firstname, lastname) values ('porttitor', 'at', 1, 'Aimee', 'Patrick');
insert into users (username, password, type, firstname, lastname) values ('Donec', 'Donec', 1, 'Ori', 'Newton');
insert into users (username, password, type, firstname, lastname) values ('pellentesque', 'non', 1, 'Theodore', 'Marks');


#a legid listing of sports
insert into sports (name, description) values ('Archery', 'the art, practice, or skill of propelling arrows with the use of a bow');
insert into sports (name, description) values ('Boxing', 'a combat sport in which two people engage in a contest of strength, reflexes, and endurance by throwing punches at an opponent with the goal of a knockout with gloved hands');
insert into sports (name, description) values ('Cycling', 'the use of bicycles for transport, recreation, or for sport');
insert into sports (name, description) values ('Football', 'played between two teams of eleven with the objective of scoring points by advancing the ball into the opposing team''s end zone by running with it or throwing it to a teammate');
insert into sports (name, description) values ('Golf', ' a precision club and ball sport, in which competing players (or golfers) use many types of clubs to hit balls into a series of holes on a golf course using the fewest number of strokes');
insert into sports (name, description) values ('Ice hockey', 'a team sport played on ice, in which skaters use wooden or composite sticks to shoot a hard rubber puck into their opponent''s net');


#a list of preset user - sports relationship
insert into user_sports (uid, sid) values (1, 1);
insert into user_sports (uid, sid) values (1, 3);
insert into user_sports (uid, sid) values (1, 3);
insert into user_sports (uid, sid) values (1, 4);
insert into user_sports (uid, sid) values (1, 5);
insert into user_sports (uid, sid) values (1, 6);
insert into user_sports (uid, sid) values (2, 1);
insert into user_sports (uid, sid) values (2, 4);
insert into user_sports (uid, sid) values (3, 1);
insert into user_sports (uid, sid) values (3, 4);
insert into user_sports (uid, sid) values (3, 6);
insert into user_sports (uid, sid) values (4, 2);
insert into user_sports (uid, sid) values (4, 4);
insert into user_sports (uid, sid) values (4, 5);
insert into user_sports (uid, sid) values (5, 1);
insert into user_sports (uid, sid) values (5, 3);
insert into user_sports (uid, sid) values (5, 4);
insert into user_sports (uid, sid) values (5, 5);
insert into user_sports (uid, sid) values (6, 3);
insert into user_sports (uid, sid) values (6, 4);
insert into user_sports (uid, sid) values (6, 5);
insert into user_sports (uid, sid) values (6, 6);
insert into user_sports (uid, sid) values (7, 1);
insert into user_sports (uid, sid) values (8, 2);
insert into user_sports (uid, sid) values (8, 6);
insert into user_sports (uid, sid) values (9, 1);
insert into user_sports (uid, sid) values (9, 2);
insert into user_sports (uid, sid) values (9, 4);
insert into user_sports (uid, sid) values (9, 5);
insert into user_sports (uid, sid) values (10, 1);
insert into user_sports (uid, sid) values (10, 3);
insert into user_sports (uid, sid) values (10, 4);
insert into user_sports (uid, sid) values (10, 5);
insert into user_sports (uid, sid) values (11, 1);
insert into user_sports (uid, sid) values (11, 2);
insert into user_sports (uid, sid) values (12, 4);
insert into user_sports (uid, sid) values (12, 6);
insert into user_sports (uid, sid) values (13, 1);
insert into user_sports (uid, sid) values (13, 4);
insert into user_sports (uid, sid) values (13, 5);
insert into user_sports (uid, sid) values (13, 6);
insert into user_sports (uid, sid) values (14, 3);
insert into user_sports (uid, sid) values (14, 5);
insert into user_sports (uid, sid) values (15, 1);
insert into user_sports (uid, sid) values (15, 2);
insert into user_sports (uid, sid) values (15, 5);
insert into user_sports (uid, sid) values (15, 6);
insert into user_sports (uid, sid) values (16, 2);
insert into user_sports (uid, sid) values (16, 5);
insert into user_sports (uid, sid) values (17, 1);
insert into user_sports (uid, sid) values (17, 2);
insert into user_sports (uid, sid) values (17, 3);
insert into user_sports (uid, sid) values (17, 5);



#a list of games that will be created
#noted that the sports is selected by random, so those organizers don't necessary know those sportss
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Nibh Enim Gravida Tournament', 6, NULL, '2012-12-02', 5, 'Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('In Dolor Tournament', 6, NULL, '2012-11-30', 6, 'feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat.');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Magna Cras Elimination', 8, NULL, '2013-05-05', 6, 'Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi.');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Dictum Magna Ut Tournament', 5, NULL, '2013-01-04', 3, 'In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Nec Ante Match', 7, NULL, '2013-01-17', 1, 'vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at fringilla purus mauris a nunc. In at pede. Cras vulputate velit');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Phasellus Ornare Fusce Championship', 9, NULL, '2013-06-21', 1, 'id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum');
insert into games (name, organizer, start_time, creation, sport, `desc`) values ('Cras Vulputate Elimination', 9, NULL, '2013-04-04', 5, 'Suspendisse tristique neque venenatis lacus. Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum');


# a number of users has already expressed their interest in some of the pickup gaems 
insert into matches (uid, gid, selected) values (10, 1, 0);
insert into matches (uid, gid, selected) values (10, 2, 1);
insert into matches (uid, gid, selected) values (10, 6, 1);
insert into matches (uid, gid, selected) values (10, 7, 0);
insert into matches (uid, gid, selected) values (11, 5, 1);
insert into matches (uid, gid, selected) values (12, 3, 1);
insert into matches (uid, gid, selected) values (12, 4, 1);
insert into matches (uid, gid, selected) values (13, 2, 0);
insert into matches (uid, gid, selected) values (13, 5, 1);
insert into matches (uid, gid, selected) values (13, 6, 0);
insert into matches (uid, gid, selected) values (15, 2, 1);
insert into matches (uid, gid, selected) values (15, 3, 1);
insert into matches (uid, gid, selected) values (15, 4, 0);
insert into matches (uid, gid, selected) values (15, 5, 1);
insert into matches (uid, gid, selected) values (15, 7, 0);
insert into matches (uid, gid, selected) values (16, 2, 1);
insert into matches (uid, gid, selected) values (16, 7, 1);
insert into matches (uid, gid, selected) values (17, 5, 1);
insert into matches (uid, gid, selected) values (17, 6, 1);
insert into matches (uid, gid, selected) values (17, 7, 1);
insert into matches (uid, gid, selected) values (4, 2, 1);
insert into matches (uid, gid, selected) values (5, 2, 0);
insert into matches (uid, gid, selected) values (5, 5, 0);
insert into matches (uid, gid, selected) values (5, 6, 0);
insert into matches (uid, gid, selected) values (5, 7, 0);
insert into matches (uid, gid, selected) values (6, 4, 0);
insert into matches (uid, gid, selected) values (6, 7, 0);
insert into matches (uid, gid, selected) values (7, 6, 1);
insert into matches (uid, gid, selected) values (8, 3, 1);
insert into matches (uid, gid, selected) values (9, 2, 0);
insert into matches (uid, gid, selected) values (9, 5, 0);


#friendship for players in common game

/*

derive friendship based on joined matches and selected players:

- first subquery creates friendships between selected players
- second and third subquery creates friendships between organizers and selected players
- no duplicate friendships are inserted

select distinct uid1, uid2 
from
(select p.uid as uid1, q.uid as uid2 from matches p inner join matches q where p.gid = q.gid and p.uid != q.uid and p.selected = 1 and q.selected = 1
union
select games.organizer as uid1, matches.uid as uid2 from matches inner join games on matches.gid = games.gid where matches.selected = true
union
select matches.uid as uid1, games.organizer as uid2 from matches inner join games on matches.gid = games.gid where matches.selected = true) as p
order by uid1, uid2

*/


insert into friendship (uid1, uid2) values (4, 6);
insert into friendship (uid1, uid2) values (4, 10);
insert into friendship (uid1, uid2) values (4, 15);
insert into friendship (uid1, uid2) values (4, 16);
insert into friendship (uid1, uid2) values (6, 4);
insert into friendship (uid1, uid2) values (6, 8);
insert into friendship (uid1, uid2) values (6, 10);
insert into friendship (uid1, uid2) values (6, 12);
insert into friendship (uid1, uid2) values (6, 15);
insert into friendship (uid1, uid2) values (6, 16);
insert into friendship (uid1, uid2) values (7, 9);
insert into friendship (uid1, uid2) values (7, 10);
insert into friendship (uid1, uid2) values (7, 11);
insert into friendship (uid1, uid2) values (7, 13);
insert into friendship (uid1, uid2) values (7, 15);
insert into friendship (uid1, uid2) values (7, 17);
insert into friendship (uid1, uid2) values (8, 6);
insert into friendship (uid1, uid2) values (8, 12);
insert into friendship (uid1, uid2) values (8, 15);
insert into friendship (uid1, uid2) values (9, 7);
insert into friendship (uid1, uid2) values (9, 10);
insert into friendship (uid1, uid2) values (9, 16);
insert into friendship (uid1, uid2) values (9, 17);
insert into friendship (uid1, uid2) values (10, 4);
insert into friendship (uid1, uid2) values (10, 6);
insert into friendship (uid1, uid2) values (10, 7);
insert into friendship (uid1, uid2) values (10, 9);
insert into friendship (uid1, uid2) values (10, 15);
insert into friendship (uid1, uid2) values (10, 16);
insert into friendship (uid1, uid2) values (10, 17);
insert into friendship (uid1, uid2) values (11, 7);
insert into friendship (uid1, uid2) values (11, 13);
insert into friendship (uid1, uid2) values (11, 15);
insert into friendship (uid1, uid2) values (11, 17);
insert into friendship (uid1, uid2) values (12, 6);
insert into friendship (uid1, uid2) values (12, 8);
insert into friendship (uid1, uid2) values (12, 15);
insert into friendship (uid1, uid2) values (13, 7);
insert into friendship (uid1, uid2) values (13, 11);
insert into friendship (uid1, uid2) values (13, 15);
insert into friendship (uid1, uid2) values (13, 17);
insert into friendship (uid1, uid2) values (15, 4);
insert into friendship (uid1, uid2) values (15, 6);
insert into friendship (uid1, uid2) values (15, 7);
insert into friendship (uid1, uid2) values (15, 8);
insert into friendship (uid1, uid2) values (15, 10);
insert into friendship (uid1, uid2) values (15, 11);
insert into friendship (uid1, uid2) values (15, 12);
insert into friendship (uid1, uid2) values (15, 13);
insert into friendship (uid1, uid2) values (15, 16);
insert into friendship (uid1, uid2) values (15, 17);
insert into friendship (uid1, uid2) values (16, 4);
insert into friendship (uid1, uid2) values (16, 6);
insert into friendship (uid1, uid2) values (16, 9);
insert into friendship (uid1, uid2) values (16, 10);
insert into friendship (uid1, uid2) values (16, 15);
insert into friendship (uid1, uid2) values (16, 17);
insert into friendship (uid1, uid2) values (17, 7);
insert into friendship (uid1, uid2) values (17, 9);
insert into friendship (uid1, uid2) values (17, 10);
insert into friendship (uid1, uid2) values (17, 11);
insert into friendship (uid1, uid2) values (17, 13);
insert into friendship (uid1, uid2) values (17, 15);
insert into friendship (uid1, uid2) values (17, 16);
