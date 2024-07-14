-- This script is run by the docker database container when it is built, providing the tables
-- and seed data each time we spin up the containers. This allows efficient testing of the system

-- We want to start the transaction of creating the tables and adding the seed data to database in docker container
START TRANSACTION; 

-- Create the user table, storing hashed passwords and salt rather than plaintext
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL
);

-- Create the location table
CREATE TABLE location (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    county VARCHAR(255) NOT NULL,
    postcode VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    week_hours VARCHAR(50) NOT NULL,
    weekend_hours VARCHAR(50) NOT NULL,
    image_path VARCHAR(255) NOT NULL
);

-- Create the offer table, indexing rows used for searching (for speed benefits)
CREATE TABLE offer (
    id INT PRIMARY KEY,
    location VARCHAR(100) NOT NULL,
    star_rating VARCHAR(20) NOT NULL,
    dates VARCHAR(100) NOT NULL,
    nights INT,
    description TEXT NOT NULL,
    price INT NOT NULL,
    travel_time INT NOT NULL,
    travel_stops INT NOT NULL,
    INDEX (location),
    INDEX (price),
    INDEX (travel_time),
    INDEX (travel_stops)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Create off_images table, linking offers to there multiple image paths on the server
CREATE TABLE offer_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

-- Create off_activities table, linking offers to there multiple activities
CREATE TABLE offer_activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    activity VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

-- Create off_facilities table, linking offers to there multiple facilities
CREATE TABLE offer_facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    facility VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

-- Create booking table, used as a join table to connect users and offers 
CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    offer_id INT,
    num_people INT NOT NULL,
    total_cost DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (offer_id) REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- SEED data
INSERT INTO location (title, street, city, county, postcode, phone, email, week_hours, weekend_hours, image_path) VALUES
('Head Office', '1 King Street', 'London', 'Greater London', 'W1B 2EL', '020 7153 9000', 'hq@b&b-travel.co.uk', '9-5', 'Closed', '../resources/hq.webp'),
('Edinburgh', '1 Princes Street', 'Edinburgh', 'West Lothian', 'EH1 1AB', '0131 242 8200', 'edinburgh@b&b-travel.co.uk', '8-5', 'Saturday 10-4, Closed Sunday', '../resources/edinburgh.webp'),
('Newcastle', '1 Station Road', 'Newcastle upon Tyne', 'Tyne and Wear', 'NE1 7JB', '0191 270 6100', 'newcastle@b&b-travel.co.uk', '9-5', 'Saturday 9-5, Closed Sunday', '../resources/newcastle.webp'),
('Manchester', '23 Stadium Place', 'Manchester', 'Greater Manchester', 'M4 3AJ', '0161 455 1900', 'manchester@b&b-travel.co.uk', '8-5', 'Saturday 8-5, Closed', '../resources/manchester.webp'),
('Oxford', '3 Castle Terrace', 'Oxford', 'Oxforshire', 'OX1 1PE', '01865 240899', 'oxford@b&b-travel.co.uk', '8-5', 'Saturday 8-5, Closed', '../resources/oxford.webp');

INSERT INTO offer (id, location, star_rating, dates, nights, description, price, travel_time, travel_stops) VALUES
-- Paris - France
(1, 'Paris - France', '★★★★', '5th - 15th October 2024', 10, 'Experience the romance and charm of Paris. Visit iconic landmarks like the Eiffel Tower and the Louvre, and indulge in exquisite French cuisine and luxury shopping.', 3500, 80, 0),
(2, 'Paris - France', '★★★★', '1st - 8th November 2024', 7, 'Discover Paris with a week-long getaway. Explore charming cafes, stroll along the Seine, and immerse yourself in the city''s rich history and culture.', 2500, 80, 0),
(3, 'Paris - France', '★★★★', '15th - 22nd December 2024', 7, 'Enjoy a magical winter in Paris. Witness the city''s beautiful holiday decorations, ice skate at outdoor rinks, and enjoy festive markets.', 2700, 80, 0),

-- Sydney - Australia
(4, 'Sydney - Australia', '★★★★★', '10th - 20th November 2024', 10, 'Explore the vibrant city of Sydney. Visit the iconic Opera House and Harbour Bridge, relax on Bondi Beach, and enjoy world-class dining and entertainment.', 4500, 1350, 1),
(5, 'Sydney - Australia', '★★★★★', '5th - 15th January 2025', 10, 'Sydney: Beaches, Opera House, and more. Experience the best of Australian culture and natural beauty in this stunning city.', 4600, 1350, 1),
(6, 'Sydney - Australia', '★★★★★', '1st - 12th February 2025', 11, 'Extended stay in Sydney. Take your time to explore Sydney''s many attractions, from its vibrant nightlife to its peaceful national parks.', 4700, 1350, 1),

-- New York - USA
(7, 'New York - USA', '★★★★', '20th - 30th December 2024', 10, 'Discover the excitement of New York City. Enjoy Broadway shows, visit iconic landmarks like Times Square and Central Park, and explore diverse neighborhoods.', 4000, 480, 0),
(8, 'New York - USA', '★★★★', '1st - 8th March 2025', 7, 'Week-long adventure in New York. Experience the city''s vibrant culture, world-class museums, and endless dining options.', 2900, 480, 0),
(9, 'New York - USA', '★★★★', '10th - 17th April 2025', 7, 'Spring in New York City. Witness the blooming flowers in Central Park, enjoy outdoor activities, and explore the city''s lively atmosphere.', 3000, 480, 0),

-- Rome - Italy
(10, 'Rome - Italy', '★★★★', '5th - 15th January 2025', 10, 'Immerse yourself in the history of Rome. Visit ancient landmarks like the Colosseum and the Vatican, and savor authentic Italian cuisine.', 3200, 150, 0),
(11, 'Rome - Italy', '★★★★', '1st - 8th February 2025', 7, 'A week in historic Rome. Discover the city''s beautiful piazzas, historic sites, and delicious gelato.', 2200, 150, 0),
(12, 'Rome - Italy', '★★★★', '15th - 22nd March 2025', 7, 'Rome: The Eternal City. Explore the rich cultural heritage, art, and history of this timeless city.', 2300, 150, 0),

-- Santorini - Greece
(13, 'Santorini - Greece', '★★★★★', '1st - 10th February 2025', 10, 'Relax in the stunning island of Santorini. Enjoy breathtaking sunsets, beautiful beaches, and luxurious accommodations.', 3700, 235, 0),
(14, 'Santorini - Greece', '★★★★★', '10th - 17th April 2025', 7, 'A week in beautiful Santorini. Explore charming villages, taste local wines, and unwind in the island''s serene atmosphere.', 2800, 235, 0),
(15, 'Santorini - Greece', '★★★★★', '5th - 15th June 2025', 10, 'Experience the summer in Santorini. Swim in crystal-clear waters, enjoy outdoor activities, and soak up the sun.', 3900, 235, 0),

-- Dubai - UAE
(16, 'Dubai - UAE', '★★★★★', '10th - 20th May 2025', 10, 'Discover the opulence of Dubai. From the Burj Khalifa to luxury shopping malls and desert safaris, experience the best of this dynamic city.', 5000, 410, 0),
(17, 'Dubai - UAE', '★★★★★', '1st - 8th July 2025', 7, 'A week in luxurious Dubai. Enjoy top-notch dining, stunning architecture, and unique cultural experiences.', 3800, 410, 0),
(18, 'Dubai - UAE', '★★★★★', '15th - 25th September 2025', 10, 'Extended stay in Dubai. Take in all the sights and experiences that this modern metropolis has to offer.', 5100, 410, 0),

-- Phuket - Thailand
(19, 'Phuket - Thailand', '★★★★', '5th - 15th June 2025', 10, 'Relax in the tropical paradise of Phuket. Enjoy pristine beaches, vibrant nightlife, and delicious Thai cuisine in this beautiful island destination.', 2800, 785, 1),
(20, 'Phuket - Thailand', '★★★★', '1st - 8th August 2025', 7, 'A week in beautiful Phuket. Experience the island''s natural beauty, cultural sites, and warm hospitality.', 2000, 785, 1),
(21, 'Phuket - Thailand', '★★★★', '15th - 25th October 2025', 10, 'Extended stay in Phuket. Enjoy more time to relax and explore the island''s many attractions.', 2900, 785, 1),

-- Maldives
(22, 'Maldives', '★★★★★', '2nd - 12th August 2024', 10, 'This incredible 5 star experience is not to be missed! Relax in luxury with your very own private pool, or experience all the islands have to offer from scuba diving to watching giant sea turtles hatch on the beautiful unspoilt beaches. Perfect for honeymoons!', 4000, 630, 1),
(23, 'Maldives', '★★★★★', '1st - 8th September 2024', 7, 'A week in paradise: Maldives. Enjoy stunning beaches, luxurious overwater bungalows, and unparalleled tranquility.', 3100, 630, 1),
(24, 'Maldives', '★★★★★', '15th - 25th October 2024', 10, 'This incredible 5 star experience is not to be missed! Relax in luxury with your very own private pool, or experience all the islands have to offer from scuba diving to watching giant sea turtles hatch on the beautiful unspoilt beaches. Perfect for honeymoons!', 4200, 630, 1),

-- Tokyo - Japan
(25, 'Tokyo - Japan', '★★★', '1st - 14th September 2024', 14, 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the city''s dazzling skyline and serene gardens.', 3000, 705, 0),
(26, 'Tokyo - Japan', '★★★', '1st - 8th November 2024', 7, 'A week in vibrant Tokyo. Explore bustling streets, visit historic temples, and enjoy the best of Japanese cuisine.', 2200, 705, 0),
(27, 'Tokyo - Japan', '★★★', '10th - 20th December 2024', 10, 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the city''s dazzling skyline and serene gardens.', 3200, 705, 0),

-- Monaco
(28, 'Monaco', '★★★★', '15th - 18th September 2024', 4, 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.', 500, 115, 0),
(29, 'Monaco', '★★★★', '1st - 4th October 2024', 3, 'A short trip to Monaco. Experience the glamour, culture, and scenic beauty of this exclusive destination.', 400, 115, 0),
(30, 'Monaco', '★★★★', '10th - 14th November 2024', 4, 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.', 600, 115, 0);

-- Conversion command to ensure star_rating is correctly encoded - Star ratings are not adding to Database correctly as emojis
UPDATE offer
SET star_rating = CONVERT(CAST(CONVERT(star_rating USING latin1) AS BINARY) USING utf8mb4);


INSERT INTO offer_images (offer_id, image_path) VALUES
-- Paris - France
(1, '../resources/paris1.webp'), (1, '../resources/paris2.webp'), (1, '../resources/paris3.webp'),
(2, '../resources/paris1.webp'), (2, '../resources/paris2.webp'), (2, '../resources/paris3.webp'),
(3, '../resources/paris1.webp'), (3, '../resources/paris2.webp'), (3, '../resources/paris3.webp'),

-- Sydney - Australia
(4, '../resources/sydney1.webp'), (4, '../resources/sydney2.webp'), (4, '../resources/sydney3.webp'),
(5, '../resources/sydney1.webp'), (5, '../resources/sydney2.webp'), (5, '../resources/sydney3.webp'),
(6, '../resources/sydney1.webp'), (6, '../resources/sydney2.webp'), (6, '../resources/sydney3.webp'),

-- New York - USA
(7, '../resources/newyork1.webp'), (7, '../resources/newyork2.webp'), (7, '../resources/newyork3.webp'),
(8, '../resources/newyork1.webp'), (8, '../resources/newyork2.webp'), (8, '../resources/newyork3.webp'),
(9, '../resources/newyork1.webp'), (9, '../resources/newyork2.webp'), (9, '../resources/newyork3.webp'),

-- Rome - Italy
(10, '../resources/rome1.webp'), (10, '../resources/rome2.webp'), (10, '../resources/rome3.webp'),
(11, '../resources/rome1.webp'), (11, '../resources/rome2.webp'), (11, '../resources/rome3.webp'),
(12, '../resources/rome1.webp'), (12, '../resources/rome2.webp'), (12, '../resources/rome3.webp'),

-- Santorini - Greece
(13, '../resources/santorini1.webp'), (13, '../resources/santorini2.webp'), (13, '../resources/santorini3.webp'),
(14, '../resources/santorini1.webp'), (14, '../resources/santorini2.webp'), (14, '../resources/santorini3.webp'),
(15, '../resources/santorini1.webp'), (15, '../resources/santorini2.webp'), (15, '../resources/santorini3.webp'),

-- Dubai - UAE
(16, '../resources/dubai1.webp'), (16, '../resources/dubai2.webp'), (16, '../resources/dubai3.webp'),
(17, '../resources/dubai1.webp'), (17, '../resources/dubai2.webp'), (17, '../resources/dubai3.webp'),
(18, '../resources/dubai1.webp'), (18, '../resources/dubai2.webp'), (18, '../resources/dubai3.webp'),

-- Phuket - Thailand
(19, '../resources/phuket1.webp'), (19, '../resources/phuket2.webp'), (19, '../resources/phuket3.webp'),
(20, '../resources/phuket1.webp'), (20, '../resources/phuket2.webp'), (20, '../resources/phuket3.webp'),
(21, '../resources/phuket1.webp'), (21, '../resources/phuket2.webp'), (21, '../resources/phuket3.webp'),

-- Maldives
(22, '../resources/maldives1.webp'), (22, '../resources/maldives2.webp'), (22, '../resources/maldives3.webp'),
(23, '../resources/maldives1.webp'), (23, '../resources/maldives2.webp'), (23, '../resources/maldives3.webp'),
(24, '../resources/maldives1.webp'), (24, '../resources/maldives2.webp'), (24, '../resources/maldives3.webp'),

-- Tokyo - Japan
(25, '../resources/tokyo1.webp'), (25, '../resources/tokyo2.webp'), (25, '../resources/tokyo3.webp'),
(26, '../resources/tokyo1.webp'), (26, '../resources/tokyo2.webp'), (26, '../resources/tokyo3.webp'),
(27, '../resources/tokyo1.webp'), (27, '../resources/tokyo2.webp'), (27, '../resources/tokyo3.webp'),

-- Monaco
(28, '../resources/monaco1.webp'), (28, '../resources/monaco2.webp'), (28, '../resources/monaco3.webp'),
(29, '../resources/monaco1.webp'), (29, '../resources/monaco2.webp'), (29, '../resources/monaco3.webp'),
(30, '../resources/monaco1.webp'), (30, '../resources/monaco2.webp'), (30, '../resources/monaco3.webp');



INSERT INTO offer_activities (offer_id, activity) VALUES
-- Paris - France
(1, 'Sightseeing'), (1, 'Museum Tours'), (1, 'Fine Dining'),
(2, 'Sightseeing'), (2, 'Museum Tours'), (2, 'Fine Dining'),
(3, 'Sightseeing'), (3, 'Museum Tours'), (3, 'Fine Dining'),

-- Sydney - Australia
(4, 'Sightseeing'), (4, 'Beach Activities'), (4, 'Cultural Tours'),
(5, 'Sightseeing'), (5, 'Beach Activities'), (5, 'Cultural Tours'),
(6, 'Sightseeing'), (6, 'Beach Activities'), (6, 'Cultural Tours'),

-- New York - USA
(7, 'Broadway Shows'), (7, 'Shopping'), (7, 'Sightseeing'),
(8, 'Broadway Shows'), (8, 'Shopping'), (8, 'Sightseeing'),
(9, 'Broadway Shows'), (9, 'Shopping'), (9, 'Sightseeing'),

-- Rome - Italy
(10, 'Sightseeing'), (10, 'Cultural Tours'), (10, 'Food Tasting'),
(11, 'Sightseeing'), (11, 'Cultural Tours'), (11, 'Food Tasting'),
(12, 'Sightseeing'), (12, 'Cultural Tours'), (12, 'Food Tasting'),

-- Santorini - Greece
(13, 'Sightseeing'), (13, 'Beach Activities'), (13, 'Cultural Tours'),
(14, 'Sightseeing'), (14, 'Beach Activities'), (14, 'Cultural Tours'),
(15, 'Sightseeing'), (15, 'Beach Activities'), (15, 'Cultural Tours'),

-- Dubai - UAE
(16, 'Sightseeing'), (16, 'Desert Safaris'), (16, 'Shopping'),
(17, 'Sightseeing'), (17, 'Desert Safaris'), (17, 'Shopping'),
(18, 'Sightseeing'), (18, 'Desert Safaris'), (18, 'Shopping'),

-- Phuket - Thailand
(19, 'Beach Activities'), (19, 'Nightlife'), (19, 'Cultural Tours'),
(20, 'Beach Activities'), (20, 'Nightlife'), (20, 'Cultural Tours'),
(21, 'Beach Activities'), (21, 'Nightlife'), (21, 'Cultural Tours'),

-- Maldives
(22, 'Scuba Diving'), (22, 'Turtle Watching'), (22, 'Luxury Spa'),
(23, 'Scuba Diving'), (23, 'Turtle Watching'), (23, 'Luxury Spa'),
(24, 'Scuba Diving'), (24, 'Turtle Watching'), (24, 'Luxury Spa'),

-- Tokyo - Japan
(25, 'Sightseeing'), (25, 'Shopping'), (25, 'Cultural Tours'),
(26, 'Sightseeing'), (26, 'Shopping'), (26, 'Cultural Tours'),
(27, 'Sightseeing'), (27, 'Shopping'), (27, 'Cultural Tours'),

-- Monaco
(28, 'Casino Visits'), (28, 'Sightseeing'), (28, 'Luxury Shopping'),
(29, 'Casino Visits'), (29, 'Sightseeing'), (29, 'Luxury Shopping'),
(30, 'Casino Visits'), (30, 'Sightseeing'), (30, 'Luxury Shopping');


INSERT INTO offer_facilities (offer_id, facility) VALUES
-- Paris - France
(1, 'Luxury Hotels'), (1, 'Boutique Shops'), (1, 'Gourmet Restaurants'),
(2, 'Luxury Hotels'), (2, 'Boutique Shops'), (2, 'Gourmet Restaurants'),
(3, 'Luxury Hotels'), (3, 'Boutique Shops'), (3, 'Gourmet Restaurants'),

-- Sydney - Australia
(4, 'Luxury Hotels'), (4, 'Fine Dining'), (4, 'Beach Access'),
(5, 'Luxury Hotels'), (5, 'Fine Dining'), (5, 'Beach Access'),
(6, 'Luxury Hotels'), (6, 'Fine Dining'), (6, 'Beach Access'),

-- New York - USA
(7, 'Luxury Hotels'), (7, 'Fine Dining'), (7, 'City Tours'),
(8, 'Luxury Hotels'), (8, 'Fine Dining'), (8, 'City Tours'),
(9, 'Luxury Hotels'), (9, 'Fine Dining'), (9, 'City Tours'),

-- Rome - Italy
(10, 'Boutique Hotels'), (10, 'Authentic Restaurants'), (10, 'Guided Tours'),
(11, 'Boutique Hotels'), (11, 'Authentic Restaurants'), (11, 'Guided Tours'),
(12, 'Boutique Hotels'), (12, 'Authentic Restaurants'), (12, 'Guided Tours'),

-- Santorini - Greece
(13, 'Luxury Hotels'), (13, 'Beachfront Villas'), (13, 'Fine Dining'),
(14, 'Luxury Hotels'), (14, 'Beachfront Villas'), (14, 'Fine Dining'),
(15, 'Luxury Hotels'), (15, 'Beachfront Villas'), (15, 'Fine Dining'),

-- Dubai - UAE
(16, 'Luxury Hotels'), (16, 'Fine Dining'), (16, 'Spa Services'),
(17, 'Luxury Hotels'), (17, 'Fine Dining'), (17, 'Spa Services'),
(18, 'Luxury Hotels'), (18, 'Fine Dining'), (18, 'Spa Services'),

-- Phuket - Thailand
(19, 'Beachfront Villas'), (19, 'Fine Dining'), (19, 'Spa Services'),
(20, 'Beachfront Villas'), (20, 'Fine Dining'), (20, 'Spa Services'),
(21, 'Beachfront Villas'), (21, 'Fine Dining'), (21, 'Spa Services'),

-- Maldives
(22, 'Private Pool'), (22, 'Beachfront Villas'), (22, 'All-inclusive Dining'),
(23, 'Private Pool'), (23, 'Beachfront Villas'), (23, 'All-inclusive Dining'),
(24, 'Private Pool'), (24, 'Beachfront Villas'), (24, 'All-inclusive Dining'),

-- Tokyo - Japan
(25, 'Luxury Hotels'), (25, 'Fine Dining'), (25, 'Spa Services'),
(26, 'Luxury Hotels'), (26, 'Fine Dining'), (26, 'Spa Services'),
(27, 'Luxury Hotels'), (27, 'Fine Dining'), (27, 'Spa Services'),

-- Monaco
(28, 'High-end Hotels'), (28, 'Gourmet Restaurants'), (28, 'Spa and Wellness Centers'),
(29, 'High-end Hotels'), (29, 'Gourmet Restaurants'), (29, 'Spa and Wellness Centers'),
(30, 'High-end Hotels'), (30, 'Gourmet Restaurants'), (30, 'Spa and Wellness Centers');


