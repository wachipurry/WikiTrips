/* VISTAS */

CREATE VIEW featured_trips_0 AS SELECT DISTINCT
    id_trip AS trip_id,
    title AS trip_name,
    summary AS trip_resum,
    img_url_thumb AS trip_thumb
    FROM trips JOIN media USING (id_trip)
    ORDER BY trip_id DESC;

CREATE VIEW featured_trips_1 AS SELECT
	id_trip AS trip_id,
	title AS trip_name,
	img_url_thumb AS trip_thumb,
	avg(rate) AS trip_rate
	FROM trips
	JOIN media USING (id_trip)
	JOIN ratings USING (id_trip)
	GROUP BY id_trip
    ORDER BY trip_rate DESC;

/* IGUAL PERO SOLO MUESTROS LOS PUBLICOS */

CREATE VIEW featured_trips_2 AS SELECT
    id_trip AS trip_id,
	title AS trip_name,
	img_url_thumb AS trip_thumb,
	avg(rate) AS trip_rate
	FROM trips
	JOIN media USING (id_trip)
	JOIN ratings USING (id_trip)
    WHERE id_trip IN (
        SELECT id_trip FROM trips WHERE id_status = 3)
    GROUP BY id_trip
    ORDER BY trip_rate DESC;

CREATE VIEW featured_trips_3 AS SELECT DISTINCT
    id_trip AS trip_id,
    title AS trip_name,
    summary AS trip_resum,
    img_url_thumb AS trip_thumb
    FROM trips JOIN media USING (id_trip)
        WHERE id_trip IN (
        SELECT id_trip FROM trips WHERE id_status = 3)
    ORDER BY trip_id DESC;



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