SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    county VARCHAR(255) NOT NULL,
    postcode VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    weekHours VARCHAR(50) NOT NULL,
    weekendHours VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL
);

CREATE TABLE offers (
    id INT PRIMARY KEY,
    location VARCHAR(255) NOT NULL,
    starRating VARCHAR(10) NOT NULL,
    dates VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price INT NOT NULL,
    travelTime INT NOT NULL,
    travelStops INT NOT NULL,
    INDEX (location),
    INDEX (price),
    INDEX (travelTime),
    INDEX (travelStops)
);

CREATE TABLE offer_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offers(id)
);

CREATE TABLE offer_activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    activity VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offers(id)
);

CREATE TABLE offer_facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    facility VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offers(id)
);

-- SEED data
INSERT INTO locations (title, street, city, county, postcode, phone, email, weekHours, weekendHours, image) VALUES
('Head Office', '1 King Street', 'London', 'Greater London', 'W1B 2EL', '020 7153 9000', 'hq@b&b-travel.co.uk', '9-5', 'Closed', '../resources/hq.webp'),
('Edinburgh', '1 Princes Street', 'Edinburgh', 'West Lothian', 'EH1 1AB', '0131 242 8200', 'edinburgh@b&b-travel.co.uk', '8-5', 'Saturday 10-4, Closed Sunday', '../resources/edinburgh.webp'),
('Newcastle', '1 Station Road', 'Newcastle upon Tyne', 'Tyne and Wear', 'NE1 7JB', '0191 270 6100', 'newcastle@b&b-travel.co.uk', '9-5', 'Saturday 9-5, Closed Sunday', '../resources/newcastle.webp'),
('Manchester', '23 Stadium Place', 'Manchester', 'Greater Manchester', 'M4 3AJ', '0161 455 1900', 'manchester@b&b-travel.co.uk', '8-5', 'Saturday 8-5, Closed', '../resources/manchester.webp'),
('Oxford', '3 Castle Terrace', 'Oxford', 'Oxforshire', 'OX1 1PE', '01865 240899', 'oxford@b&b-travel.co.uk', '8-5', 'Saturday 8-5, Closed', '../resources/oxford.webp');

INSERT INTO offers (id, location, starRating, dates, description, price, travelTime, travelStops) VALUES
(1, 'Maldives', '★★★★★', '1st - 15th July 2024 (15 Days)', 'The Maldives offers a unique experience like no other destination. Enjoy white sandy beaches, crystal clear waters, and luxurious accommodations.', 4000, 630, 1),
(2, 'Tokyo - Japan', '★★★', '1st - 14th September 2024 (14 Days)', 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the citys dazzling skyline and serene gardens.', 3000, 705, 0),
(3, 'Monaco', '★★★★', '15th - 18th September 2024 (4 Days)', 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.', 500, 115, 0);

INSERT INTO offer_images (offer_id, image) VALUES
(1, '../resources/maldives1.webp'),
(1, '../resources/maldives2.webp'),
(1, '../resources/maldives3.webp'),
(2, '../resources/tokyo1.webp'),
(2, '../resources/tokyo2.webp'),
(2, '../resources/tokyo3.webp'),
(3, '../resources/monaco1.webp'),
(3, '../resources/monaco2.webp'),
(3, '../resources/monaco3.webp');

INSERT INTO offer_activities (offer_id, activity) VALUES
(1, 'Scuba Diving'),
(1, 'Turtle Watching'),
(1, 'Luxury Spa'),
(2, 'Sightseeing'),
(2, 'Shopping'),
(2, 'Cultural Tours'),
(3, 'Casino Visits'),
(3, 'Sightseeing'),
(3, 'Luxury Shopping');

INSERT INTO offer_facilities (offer_id, facility) VALUES
(1, 'Private Pool'),
(1, 'Beachfront Villas'),
(1, 'All-inclusive Dining'),
(2, 'Luxury Hotels'),
(2, 'Fine Dining'),
(2, 'Spa Services'),
(3, 'High-end Hotels'),
(3, 'Gourmet Restaurants'),
(3, 'Spa and Wellness Centers');