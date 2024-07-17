<!-- This file is used to connect to and query the database -->
<!-- Ensure safe from SQL injection etc -->

<!-- connect function (try / catch) -->
<?php

class Database
{
    private static $pdo = null;
    private static $host = 'db';
    private static $db = 'book_and_board';
    private static $user = 'root';
    private static $pass = 'rootpassword';
    private static $charset = 'utf8mb4'; // utf8mb4 required to correctly store star emojis in database
    private static $dsn;
    private static $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    private static function connect()
    {
        // If we dont already have a connection
        if (self::$pdo === null) {
            self::$dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            try {
                self::$pdo = new PDO(self::$dsn, self::$user, self::$pass, self::$options);
                self::$pdo->exec("SET NAMES 'utf8mb4'");
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
    }

    public static function getAllOffers()
    {
        self::connect();

        // Fetch all offers
        $query = "SELECT * FROM offer";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $offers = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Fetch images for each offer
        if ($offers) {
            foreach ($offers as &$offer) {
                $imageQuery = "SELECT image_path FROM offer_images WHERE offer_id = :offerId LIMIT 1";
                $imageStatement = self::$pdo->prepare($imageQuery);
                $imageStatement->bindParam(':offerId', $offer['id'], PDO::PARAM_INT);
                $imageStatement->execute();
                $images = $imageStatement->fetchAll(PDO::FETCH_COLUMN);

                // Add images to the offer array
                $offer['images'] = $images;
            }
        }
        return $offers;
    }



    public static function getLatestOffers()
    {
        self::connect();
        //  We want the last 3 inserted offers which have a unique location
        $query = "SELECT o.* FROM offer o INNER JOIN (SELECT location, MAX(id) as max_id FROM offer GROUP BY location) 
             latest ON o.location = latest.location AND o.id = latest.max_id ORDER BY o.id DESC LIMIT 3;";
        # Select all columns from the 'offer' table as 'o'
# Create an INNER JOIN with a subquery -
# The subquery selects the maximum id for each unique location from the offer table.
# The subquery results are grouped by location as 'latest'.
# Join the tables - ON o.location = latest.location AND o.id = latest.max_id: 
# Join the original 'offer' table with the subquery results where the 'location' matches and the 'id' is the maximum id for that location.
# Order the results by id then Limit the results to 3

        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $offers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $offers;
    }

    public static function getOffer($offerId)
    {
        self::connect();
        $query = "SELECT * FROM offer WHERE id = :offerId";
        $statement = self::$pdo->prepare($query);
        $statement->bindParam(':offerId', $offerId, PDO::PARAM_INT);
        $statement->execute();
        $offer = $statement->fetch(PDO::FETCH_OBJ);

        // If offer exists, fetch the associated images, activities, and facilities
        if ($offer) {
            $imageQuery = "SELECT image_path FROM offer_images WHERE offer_id = :offerId";
            $imageStatement = self::$pdo->prepare($imageQuery);
            $imageStatement->bindParam(':offerId', $offerId, PDO::PARAM_INT);
            $imageStatement->execute();
            $images = $imageStatement->fetchAll(PDO::FETCH_COLUMN);

            // Add images to the offer object
            $offer->images = $images;

            $activitiesQuery = "SELECT activity FROM offer_activities WHERE offer_id = :offerId";
            $activityStatement = self::$pdo->prepare($activitiesQuery);
            $activityStatement->bindParam(':offerId', $offerId, PDO::PARAM_INT);
            $activityStatement->execute();
            $activities = $activityStatement->fetchAll(PDO::FETCH_COLUMN);

            // Add activities to the offer object
            $offer->activities = $activities;

            $facilitiesQuery = "SELECT facility FROM offer_facilities WHERE offer_id = :offerId";
            $facilitiesStatement = self::$pdo->prepare($facilitiesQuery);
            $facilitiesStatement->bindParam(':offerId', $offerId, PDO::PARAM_INT);
            $facilitiesStatement->execute();
            $facilities = $facilitiesStatement->fetchAll(PDO::FETCH_COLUMN);

            // Add facilities to the offer object
            $offer->facilities = $facilities;
        }
        return $offer;
    }

    public static function getLocations()
    {
        self::connect();
        $query = "SELECT * FROM location ORDER BY id DESC";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $locations = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $locations;
    }

    // Search for offers, passing in a generated query string, and list of parameters
    public static function searchOffers($query, $params = [])
    {
        self::connect();
        $statement = self::$pdo->prepare($query);
        $statement->execute($params);
        $offers = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($offers) {
            foreach ($offers as &$offer) {
                $imageQuery = "SELECT image_path FROM offer_images WHERE offer_id = :offerId LIMIT 1";
                $imageStatement = self::$pdo->prepare($imageQuery);
                $imageStatement->bindParam(':offerId', $offer['id'], PDO::PARAM_INT);
                $imageStatement->execute();
                $images = $imageStatement->fetchAll(PDO::FETCH_COLUMN);

                // Add images to the offer array
                $offer['images'] = $images;
            }
        }
        return $offers;
    }

    public static function getUserPassword($username)
    {
        self::connect();
        // Fetch user hashed password based on username
        $query = "SELECT hashed_password FROM user WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and return the hashed password
        if ($result) {
            return $result['hashed_password'];
        } else {
            return null; // User not found
        }
    }

    public static function checkUser($username)
    {
        self::connect();
        // Fetch user hashed password based on username
        $query = "SELECT username FROM user WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return true; // If a user exists return true
        } else {
            return false; // User not found
        }
    }

    public static function insertUser($username, $password, $email)
    {
        self::connect();
        // password_hash is a built in PHP function which securely hashes and salts a password, ensuring it is unique
        // The salt is included as part of the hash, with the algorithm being one way unless the salt is known
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement
        $query = "INSERT INTO user (username, hashed_password, email) VALUES (:username, :hashed_password, :email)";
        $statement = self::$pdo->prepare($query);

        // Bind parameters
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':hashed_password', $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        // Execute the statement
        if ($statement->execute()) {
            return true; // User inserted successfully
        } else {
            return false; // Insertion failed
        }
    }
}