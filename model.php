<?php
/**
 * model.php
 *

 * I Mahtabin Tushi, 000952184, certify that this material is my original work.
 * No other person's work has been used without suitable acknowledgment and I have not made
 * my work available to anyone else.
 *
 * @author Mahtabin Tushi
 * @version 202535.00   
 * @package COMP 10260 Assignment 4
 */

/**
 * DungeonModel class
 *
 * Provides database connectivity and methods to retrieve dungeon rooms and encounters.
 * Encapsulates PDO usage to ensure safe queries and consistent error handling.
 */
class DungeonModel {
    /**
     * @var PDO $pdo The PDO instance used for database connection.
     */
    private $pdo;

    /**
     * Constructor establishes a database connection using PDO.
     *
     * @throws Exception If the database connection fails.
     */
    public function __construct() {
        // Update DSN, username, and password for your environment
        $dsn      = 'mysql:host=localhost;dbname=sa000952184;charset=utf8mb4';
        $username = 'sa000952184';
        $password = 'Sa_20030310';

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Could not connect to the database. Please try again later.");
        }
    }

    /**
     * Fetch a room record by its ID.
     *
     * @param int $roomId The unique identifier of the room.
     * @return array|null An associative array containing room data, or null if not found.
     */
    public function getRoom(int $roomId): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM rooms WHERE room_id = :id');
        $stmt->execute([':id' => $roomId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Fetch an encounter record by its ID.
     *
     * @param int $encounterId The unique identifier of the encounter.
     * @return array|null An associative array containing encounter data, or null if not found.
     */
    public function getEncounter(int $encounterId): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM encounters WHERE id = :id');
        $stmt->execute([':id' => $encounterId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Expose the PDO connection if needed by the controller.
     *
     * @return PDO The active PDO connection object.
     */
    public function getConnection(): PDO {
        return $this->pdo;
    }
}