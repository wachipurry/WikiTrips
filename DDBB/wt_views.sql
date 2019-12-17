/* VISTAS */

CREATE VIEW trips_featured AS SELECT
	id_trip AS trip_id,
	title AS trip_name,
    summary AS trip_resum,
	img_url_thumb AS trip_thumb,
	avg(rate) AS trip_rate
	FROM trips
	JOIN media USING (id_trip)
	JOIN ratings USING (id_trip)
    WHERE id_trip IN (
        SELECT id_trip FROM trips WHERE id_status = 3)
    GROUP BY id_trip

CREATE VIEW trips_published AS SELECT
	id_trip AS trip_id,
	title AS trip_name,
    summary AS trip_resum,
    alias AS trip_author
	img_url_thumb AS trip_thumb,
	avg(rate) AS trip_rate
	FROM trips
    JOIN user_details USING (id_user)
	JOIN media USING (id_trip)
	JOIN ratings USING (id_trip)
    WHERE id_trip IN (
        SELECT id_trip FROM trips WHERE id_status = 3)
    GROUP BY id_trip

CREATE VIEW trips_category AS SELECT
trip_id, trip_name, trip_resum, trip_author, trip_thumb, trip_rate, cat_name AS trip_category
FROM trips_published
INNER JOIN trips_cat ON trips_cat.id_trip = trips_published.trip_id
JOIN categories USING (id_cat)

CREATE VIEW trip_details AS SELECT
id_trip AS trip_id,
title AS trip_name,
description AS trip_text,
alias AS trip_author,
publish_date AS trip_date,
geo AS trip_location,
img_url_high AS trip_img,
img_alt AS trip_alt
FROM trips
JOIN user_details USING (id_user)
JOIN media USING (id_trip)
ORDER BY trip_id DESC


CREATE VIEW trip_categories AS
    SELECT id_trip AS trip_id, cat_name AS category FROM categories
    JOIN trips_cat USING (id_cat);