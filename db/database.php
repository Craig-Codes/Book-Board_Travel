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
        $query = "SELECT * FROM offer";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $offers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $offers;
    }


    public static function getLatestOffers()
    {
        self::connect();
        $query = "SELECT * FROM offer ORDER BY id DESC LIMIT 3";
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

}