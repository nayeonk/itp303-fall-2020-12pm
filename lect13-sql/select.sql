-- SELECT selects which columns to show
-- * means all columns
-- FROM specifies which table 
SELECT * 
FROM tracks;

SELECT track_id, name, composer
FROM tracks;

-- Display tracks that cost more than $0.99
-- Sort them from shortest to longest (in length)
-- WHERE allows us to filter data
-- ORDER BY allows us to SORT by a specific column
SELECT * 
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks that have a composer.
-- Only show the track's id, name, composer, and price
SELECT track_id, name, composer, unit_price
FROM tracks
WHERE composer IS NOT NULL;


-- Display tracks that have 'you' or 'day' in their titles
SELECT * 
FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';

-- Display tracks composed by 'U2' that have 'you' or 'day' in their titles
SELECT * 
FROM tracks
-- Order of operations -- AND takes precedence
WHERE name LIKE '%you%' OR name LIKE '%day%' AND composer LIKE '%u2%'; 

-- So use parenthese to group precedence
SELECT * 
FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day%') AND composer LIKE '%u2%';



SELECT * 
FROM tracks
WHERE genre_id = 1;


-- Display all albums and artists corresponding to each album
-- Only show the album title and artist name
SELECT albums.title AS album_title, artists.name AS artist_name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;
    
-- Display all Jazz tracks
-- Only show track name, genre name, album title, artist name, 
SELECT tracks.name AS track_name, genres.name AS genre_name, 
albums.title AS album_name, artists.name AS artist_name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;

SELECT * FROM genres;









