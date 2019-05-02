INSERT INTO film values (22, 'toto', '2015-04-03 00:00:00', 150, 'super film');

SELECT nom
FROM film;

SELECT DISTINCT email
FROM user;

DELETE FROM film
WHERE id = 22;

UPDATE film
set nom = 'blabla'
where id = 1;

SELECT *
FROM film
ORDER BY nom ASC;

SELECT *
FROM film
WHERE date BETWEEN '2018-01-01' AND '2019-01-01';

SELECT *
FROM user
WHERE email LIKE '%gmail%';

ALTER TABLE user
    ADD pseudonyme varchar(255);

SELECT *
FROM film
WHERE floor(DATEDIFF(NOW(), date) / 365) >= 2 AND nom like '%I';

SELECT nom, SUM(duree)
FROM film
GROUP BY nom
HAVING SUM(duree) > 50;

SELECT *
FROM (
         SELECT nom, duree
         FROM film
         WHERE duree > 100
     ) as sub
WHERE sub.nom = 'blabla';

SELECT *
FROM film
         LEFT JOIN horaire ho on film.id = ho.film_id
         LEFT JOIN salle s on ho.salle_id = s.id;

SELECT *
FROM salle
         RIGHT JOIN horaire ho on salle.id = ho.salle_id;

SELECT *
FROM film
         FULL JOIN horaire ho on film.id = ho.film_id
         FULL JOIN salle s on ho.salle_id = s.id;
