-- Add album 'Fight On' by artist 'Spirit of Troy'
SELECT * FROM albums;

-- Look up Spirit of Troy in artists table to get the primary key
SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Add 'Spirit of Troy'
INSERT INTO artists (name)
VALUES ('Spirit of Troy');

-- Finally can add 'Fight On' album
INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);

-- Double check 'Fight On' album was actually added
SELECT * FROM albums
ORDER BY album_id DESC;

-- Update track 'All My Love' composed by E Schrody and L. Dimant to be 
-- part of the 'Fight On' album and composed by Tommy Trojann
-- Be careful here.. there could be multiple tracks named 'All My Love'
UPDATE tracks
SET composer = 'Tommy Trojan'
WHERE name = 'All My Love';

-- When you search, there actually are two tracks named 'All My Love'
SELECT * FROM tracks
WHERE name LIKE 'All My Love';

-- So use primary key to specify exactly one track to update
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
WHERE track_id = 3316;

-- Delete the album Fight On
-- Good idea is to use SELECT to look for the record we want to delete
SELECT * FROM albums
WHERE album_id = 351;

SELECT * FROM albums
ORDER BY album_id desc;

-- Delete the 'Fight On' album
DELETE FROM albums
WHERE album_id = 348;

-- If you try to delete a record that another record is referencing, by default
-- you will get an error. In this case, 'All my Love' track record is referencing 
-- album_id 348
-- Two ways to overcome this error
-- 1) Delete the All MY love track as well
DELETE FROM tracks
WHERE track_id = 3316;

-- 2) Update the track to have a NULL album_id
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;

-- Create a view that displays all albums and their artists names
-- only show album id, title, and artist name

CREATE OR REPLACE VIEW album_artists AS
SELECT album_id, title, name, artists.artist_id
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;
    
-- "Call" the view
SELECT * FROM album_artists;

SELECT * FROM album_artists
WHERE name LIKE 'AC/DC';


-- AGGREGATE Functions
SELECT COUNT(*), COUNT(composer)
FROM tracks;

SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds), SUM(milliseconds)
FROM tracks;

-- More specific: How long is an album?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 1;

SELECT * FROM tracks;

-- Get the shortest track overall
SELECT MIN(milliseconds)
FROM tracks;

-- Find shortest track for EACH album
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;

SELECT * FROM tracks;

-- For each artists, show artists and number of their albums
SELECT * FROM albums;

SELECT artist_id, COUNT(*)
FROM albums
GROUP BY artist_id;

-- Show more info about the artists
SELECT albums.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON artists.artist_id = albums.artist_id
GROUP BY artist_id;
