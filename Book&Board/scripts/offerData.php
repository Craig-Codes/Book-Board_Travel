<?php
// Array of best offer objects, consumed by multiple views allowing content to be dymanically generated
// this approach allows data to be edited once, in this file, then automatically updated across the application
$bestOffers = [
    (object) [
        'id' => 1,
        'location' => 'Maldives',
        'starRating' => '★★★★★',
        'dates' => '2nd - 12th August 2024 (10 Days)',
        'description' => 'This incredible 5 star once in a lifetime experience is not to be missed! Relax in luxury with your very own private pool, or experience all the islands have to offer from scuba diving to watching giant sea turtles hatch on the beautiful unspoilt beaches. Perfect for honeymoons!',
        'images' => ['../resources/maldives1.webp', '../resources/maldives2.webp', '../resources/maldives3.webp'],
        'price' => '£4000pp',
        'activities' => ['Scuba Diving', 'Turtle Watching', 'Luxury Spa'],
        'facilities' => ['Private Pool', 'Beachfront Villas', 'All-inclusive Dining']
    ],
    (object) [
        'id' => 2,
        'location' => 'Tokyo - Japan',
        'starRating' => '★★★',
        'dates' => '1st - 14th September 2024 (14 Days)',
        'description' => 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the city\'s dazzling skyline and serene gardens.',
        'images' => ['../resources/tokyo1.webp', '../resources/tokyo2.webp', '../resources/tokyo3.webp'],
        'price' => '£3000pp',
        'activities' => ['Sightseeing', 'Shopping', 'Cultural Tours'],
        'facilities' => ['Luxury Hotels', 'Fine Dining', 'Spa Services']
    ],
    (object) [
        'id' => 3,
        'location' => 'Monaco',
        'starRating' => '★★★★',
        'dates' => '15th - 18th September 2024 (4 Days)',
        'description' => 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.',
        'images' => ['../resources/monaco1.webp', '../resources/monaco2.webp', '../resources/monaco3.webp'],
        'price' => '£500pp',
        'activities' => ['Casino Visits', 'Sightseeing', 'Luxury Shopping'],
        'facilities' => ['High-end Hotels', 'Gourmet Restaurants', 'Spa and Wellness Centers']
    ],
];

// Array of all offers
$allOffers = [
    (object) [
        'id' => 1,
        'location' => 'Maldives',
        'starRating' => '★★★★★',
        'dates' => '2nd - 12th August 2024 (10 Days)',
        'description' => 'This incredible 5 star once in a lifetime experience is not to be missed! Relax in luxury with your very own private pool, or experience all the islands have to offer from scuba diving to watching giant sea turtles hatch on the beautiful unspoilt beaches. Perfect for honeymoons!',
        'images' => ['../resources/maldives1.webp', '../resources/maldives2.webp', '../resources/maldives3.webp'],
        'price' => '£4000pp',
        'activities' => ['Scuba Diving', 'Turtle Watching', 'Luxury Spa'],
        'facilities' => ['Private Pool', 'Beachfront Villas', 'All-inclusive Dining']
    ],
    (object) [
        'id' => 2,
        'location' => 'Tokyo - Japan',
        'starRating' => '★★★',
        'dates' => '1st - 14th September 2024 (14 Days)',
        'description' => 'Experience the pinnacle of luxury in Tokyo, where cutting-edge innovation meets timeless tradition. Indulge in world-class dining, opulent accommodations, and exclusive shopping experiences, all set against the backdrop of the city\'s dazzling skyline and serene gardens.',
        'images' => ['../resources/tokyo1.webp', '../resources/tokyo2.webp', '../resources/tokyo3.webp'],
        'price' => '£3000pp',
        'activities' => ['Sightseeing', 'Shopping', 'Cultural Tours'],
        'facilities' => ['Luxury Hotels', 'Fine Dining', 'Spa Services']
    ],
    (object) [
        'id' => 3,
        'location' => 'Monaco',
        'starRating' => '★★★★',
        'dates' => '15th - 18th September 2024 (4 Days)',
        'description' => 'Discover Monaco, renowned for its stunning cultural landmarks, luxurious casinos, and breathtaking vistas of the iconic French Riviera. Steeped in history, this elegant city gracefully combines timeless charm with modern sophistication, all set to the faint hum of race cars.',
        'images' => ['../resources/monaco1.webp', '../resources/monaco2.webp', '../resources/monaco3.webp'],
        'price' => '£500pp',
        'activities' => ['Casino Visits', 'Sightseeing', 'Luxury Shopping'],
        'facilities' => ['High-end Hotels', 'Gourmet Restaurants', 'Spa and Wellness Centers']
    ],
    (object) [
        'id' => 4,
        'location' => 'Paris - France',
        'starRating' => '★★★★',
        'dates' => '5th - 15th October 2024 (10 Days)',
        'description' => 'Experience the romance and charm of Paris. Visit iconic landmarks like the Eiffel Tower and the Louvre, and indulge in exquisite French cuisine and luxury shopping.',
        'images' => ['../resources/paris1.webp', '../resources/paris2.webp', '../resources/paris3.webp'],
        'price' => '£3500pp',
        'activities' => ['Sightseeing', 'Museum Tours', 'Fine Dining'],
        'facilities' => ['Luxury Hotels', 'Boutique Shops', 'Gourmet Restaurants']
    ],
    (object) [
        'id' => 5,
        'location' => 'Sydney - Australia',
        'starRating' => '★★★★★',
        'dates' => '10th - 20th November 2024 (10 Days)',
        'description' => 'Explore the vibrant city of Sydney, from the iconic Opera House to the stunning beaches of Bondi. Enjoy world-class dining, shopping, and cultural experiences.',
        'images' => ['../resources/sydney1.webp', '../resources/sydney2.webp', '../resources/sydney3.webp'],
        'price' => '£4500pp',
        'activities' => ['Sightseeing', 'Beach Activities', 'Cultural Tours'],
        'facilities' => ['Luxury Hotels', 'Fine Dining', 'Beach Access']
    ],
    (object) [
        'id' => 6,
        'location' => 'New York - USA',
        'starRating' => '★★★★',
        'dates' => '20th - 30th December 2024 (10 Days)',
        'description' => 'Discover the excitement of New York City, from Broadway shows to Central Park. Experience the city that never sleeps with endless entertainment, dining, and shopping options.',
        'images' => ['../resources/newyork1.webp', '../resources/newyork2.webp', '../resources/newyork3.webp'],
        'price' => '£4000pp',
        'activities' => ['Broadway Shows', 'Shopping', 'Sightseeing'],
        'facilities' => ['Luxury Hotels', 'Fine Dining', 'City Tours']
    ],
    (object) [
        'id' => 7,
        'location' => 'Rome - Italy',
        'starRating' => '★★★★',
        'dates' => '5th - 15th January 2025 (10 Days)',
        'description' => 'Immerse yourself in the history and culture of Rome. Visit ancient landmarks like the Colosseum and the Vatican, and enjoy authentic Italian cuisine and hospitality.',
        'images' => ['../resources/rome1.webp', '../resources/rome2.webp', '../resources/rome3.webp'],
        'price' => '£3200pp',
        'activities' => ['Sightseeing', 'Cultural Tours', 'Food Tasting'],
        'facilities' => ['Boutique Hotels', 'Authentic Restaurants', 'Guided Tours']
    ],
    (object) [
        'id' => 8,
        'location' => 'Santorini - Greece',
        'starRating' => '★★★★★',
        'dates' => '1st - 10th February 2025 (10 Days)',
        'description' => 'Relax in the stunning island of Santorini with its breathtaking sunsets and beautiful beaches. Enjoy luxurious accommodations and the best of Greek cuisine and culture.',
        'images' => ['../resources/santorini1.webp', '../resources/santorini2.webp', '../resources/santorini3.webp'],
        'price' => '£3700pp',
        'activities' => ['Sightseeing', 'Beach Activities', 'Cultural Tours'],
        'facilities' => ['Luxury Hotels', 'Beachfront Villas', 'Fine Dining']
    ],
    (object) [
        'id' => 11,
        'location' => 'Dubai - UAE',
        'starRating' => '★★★★★',
        'dates' => '10th - 20th May 2025 (10 Days)',
        'description' => 'Discover the opulence and modernity of Dubai. From the Burj Khalifa to luxury shopping malls and desert safaris, experience the best of this dynamic city.',
        'images' => ['../resources/dubai1.webp', '../resources/dubai2.webp', '../resources/dubai3.webp'],
        'price' => '£5000pp',
        'activities' => ['Sightseeing', 'Desert Safaris', 'Shopping'],
        'facilities' => ['Luxury Hotels', 'Fine Dining', 'Spa Services']
    ],
    (object) [
        'id' => 12,
        'location' => 'Phuket - Thailand',
        'starRating' => '★★★★',
        'dates' => '5th - 15th June 2025 (10 Days)',
        'description' => 'Relax in the tropical paradise of Phuket. Enjoy pristine beaches, vibrant nightlife, and delicious Thai cuisine in this beautiful island destination.',
        'images' => ['../resources/phuket1.webp', '../resources/phuket2.webp', '../resources/phuket3.webp'],
        'price' => '£2800pp',
        'activities' => ['Beach Activities', 'Nightlife', 'Cultural Tours'],
        'facilities' => ['Beachfront Villas', 'Fine Dining', 'Spa Services']
    ]
];