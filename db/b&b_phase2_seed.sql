-- We want to start the transaction of creating the tables and adding the seed data to database in docker container
START TRANSACTION; 

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL
);


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

CREATE TABLE offer (
    id INT PRIMARY KEY,
    location VARCHAR(100) NOT NULL,
    star_rating VARCHAR(20) NOT NULL,
    dates VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price INT NOT NULL,
    travel_time INT NOT NULL,
    travel_stops INT NOT NULL,
    INDEX (location),
    INDEX (price),
    INDEX (travel_time),
    INDEX (travel_stops)
);


CREATE TABLE offer_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

CREATE TABLE offer_activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    activity VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

CREATE TABLE offer_facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    offer_id INT,
    facility VARCHAR(255) NOT NULL,
    FOREIGN KEY (offer_id) REFERENCES offer(id)
);

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

INSERT INTO offer (id, location, star_rating, dates, description, price, travel_time, travel_stops) VALUES
(1, 'Paris - France', '★★★★', '5th - 15th October 2024 (10 Days)', 'Experience the romance and charm of Paris. Visit iconic landmarks like the Eiffel Tower and the Louvre, and indulge in exquisite French cuisine and luxury shopping.', 3500, 80, 0),
(2, 'Sydney - Australia', '★★★★★', '10th - 20th November 2024 (10 Days)', 'Explore the vibrant city of Sydney, from the iconic Opera House to the stunning beaches of Bondi. Enjoy world-class dining, shopping, and cultural experiences.', 4500, 1350, 1),
(3, 'New York - USA', '★★★★', '20th - 30th December 2024 (10 Days)', 'Discover the excitement of New York City, from Broadway shows to Central Park. Experience the city that never sleeps with endless entertainment, dining, and shopping options.', 4000, 480, 0),
(4, 'Rome - Italy', '★★★★', '5th - 15th January 2025 (10 Days)', 'Immerse yourself in the history and culture of Rome. Visit ancient landmarks like the Colosseum and the Vatican, and enjoy authentic Italian cuisine and hospitality.', 3200, 150, 0),
(5, 'Santorini - Greece', '★★★★★', '1st - 10th February 2025 (10 Days)', 'Relax in the stunning island of Santorini with its breathtaking sunsets and beautiful beaches. Enjoy luxurious accommodations and the best of Greek cuisine and culture.', 3700, 235, 0),
(6, 'Dubai - UAE', '★★★★★', '10th - 20th May 2025 (10 Days)', 'Discover the opulence and modernity of Dubai. From the Burj Khalifa to luxury shopping malls and desert safaris, experience the best of this dynamic city.', 5000, 410, 0),
(7, 'Phuket - Thailand', '★★★★', '5th - 15th June 2025 (10 Days)', 'Relax in the tropical paradise of Phuket. Enjoy pristine beaches, vibrant nightlife, and delicious Thai cuisine in this beautiful island destination.', 2800, 785, 1),
(8, 'Maldives', '★★★★★', '2nd - 12th August 2024 (10 Days)', 'This incredible 5 star once in a lifetime experience is not to be missed! Relax in luxury with your very own private pool, or experience all the islands have to offer from scuba diving to watching giant sea turtles hatch on the beautiful unspoilt beaches. Perfect for honeymoons!', 4000, 630, 1),
(9, 'Tokyo - Japan', '★★★', '1st - 14th September 2024 (14 Days)', 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the citys dazzling skyline and serene gardens.', 3000, 705, 0),
(10, 'Monaco', '★★★★', '15th - 18th September 2024 (4 Days)', 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.', 500, 115, 0);


INSERT INTO offer_images (offer_id, image_path) VALUES
(1, '../resources/paris1.webp'), (1, '../resources/paris2.webp'), (1, '../resources/paris3.webp'),
(2, '../resources/sydney1.webp'), (2, '../resources/sydney2.webp'), (2, '../resources/sydney3.webp'),
(3, '../resources/newyork1.webp'), (3, '../resources/newyork2.webp'), (3, '../resources/newyork3.webp'),
(4, '../resources/rome1.webp'), (4, '../resources/rome2.webp'), (4, '../resources/rome3.webp'),
(5, '../resources/santorini1.webp'), (5, '../resources/santorini2.webp'), (5, '../resources/santorini3.webp'),
(6, '../resources/dubai1.webp'), (6, '../resources/dubai2.webp'), (6, '../resources/dubai3.webp'),
(7, '../resources/phuket1.webp'), (7, '../resources/phuket2.webp'), (7, '../resources/phuket3.webp'),
(8, '../resources/maldives1.webp'), (8, '../resources/maldives2.webp'), (8, '../resources/maldives3.webp'),
(9, '../resources/tokyo1.webp'), (9, '../resources/tokyo2.webp'), (9, '../resources/tokyo3.webp'),
(10, '../resources/monaco1.webp'), (10, '../resources/monaco2.webp'), (10, '../resources/monaco3.webp');


INSERT INTO offer_activities (offer_id, activity) VALUES
(1, 'Sightseeing'), (1, 'Museum Tours'), (1, 'Fine Dining'),
(2, 'Sightseeing'), (2, 'Beach Activities'), (2, 'Cultural Tours'),
(3, 'Broadway Shows'), (3, 'Shopping'), (3, 'Sightseeing'),
(4, 'Sightseeing'), (4, 'Cultural Tours'), (4, 'Food Tasting'),
(5, 'Sightseeing'), (5, 'Beach Activities'), (5, 'Cultural Tours'),
(6, 'Sightseeing'), (6, 'Desert Safaris'), (6, 'Shopping'),
(7, 'Beach Activities'), (7, 'Nightlife'), (7, 'Cultural Tours'),
(8, 'Scuba Diving'), (8, 'Turtle Watching'), (8, 'Luxury Spa'),
(9, 'Sightseeing'), (9, 'Shopping'), (9, 'Cultural Tours'),
(10, 'Casino Visits'), (10, 'Sightseeing'), (10, 'Luxury Shopping');


INSERT INTO offer_facilities (offer_id, facility) VALUES
(1, 'Luxury Hotels'), (1, 'Boutique Shops'), (1, 'Gourmet Restaurants'),
(2, 'Luxury Hotels'), (2, 'Fine Dining'), (2, 'Beach Access'),
(3, 'Luxury Hotels'), (3, 'Fine Dining'), (3, 'City Tours'),
(4, 'Boutique Hotels'), (4, 'Authentic Restaurants'), (4, 'Guided Tours'),
(5, 'Luxury Hotels'), (5, 'Beachfront Villas'), (5, 'Fine Dining'),
(6, 'Luxury Hotels'), (6, 'Fine Dining'), (6, 'Spa Services'),
(7, 'Beachfront Villas'), (7, 'Fine Dining'), (7, 'Spa Services'),
(8, 'Private Pool'), (8, 'Beachfront Villas'), (8, 'All-inclusive Dining'),
(9, 'Luxury Hotels'), (9, 'Fine Dining'), (9, 'Spa Services'),
(10, 'High-end Hotels'), (10, 'Gourmet Restaurants'), (10, 'Spa and Wellness Centers');

