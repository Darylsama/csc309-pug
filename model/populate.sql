# pug populate script

use mydb

insert into users (username, password, type, lastname, firstname) values ('admin', 'password', 1, 'Li', 'Xiang');
insert into users (username, password, type, lastname, firstname) values ('yang', 'password', 1, 'Sun', 'Yang');
insert into users (username, password, type, lastname, firstname) values ('daryl', 'password', 1, 'Zhou', 'Daryl');


insert into sports (name, description) values ('Archery', 'the art, practice, or skill of propelling arrows with the use of a bow');
insert into sports (name, description) values ('Boxing', 'a combat sport in which two people engage in a contest of strength, reflexes, and endurance by throwing punches at an opponent with the goal of a knockout with gloved hands');
insert into sports (name, description) values ('Cycling', 'the use of bicycles for transport, recreation, or for sport');
insert into sports (name, description) values ('Football', 'played between two teams of eleven with the objective of scoring points by advancing the ball into the opposing team''s end zone by running with it or throwing it to a teammate');
insert into sports (name, description) values ('Golf', ' a precision club and ball sport, in which competing players (or golfers) use many types of clubs to hit balls into a series of holes on a golf course using the fewest number of strokes');
insert into sports (name, description) values ('Ice hockey', 'a team sport played on ice, in which skaters use wooden or composite sticks to shoot a hard rubber puck into their opponent''s net');


insert into user_sports (uid, sid) values ('1', '6');
insert into user_sports (uid, sid) values ('1', '1');
insert into user_sports (uid, sid) values ('1', '3');
insert into user_sports (uid, sid) values ('1', '4');
insert into user_sports (uid, sid) values ('2', '5');
insert into user_sports (uid, sid) values ('2', '3');
insert into user_sports (uid, sid) values ('3', '2');
insert into user_sports (uid, sid) values ('3', '1');



