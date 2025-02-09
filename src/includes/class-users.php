<?php
class Users {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function addUser($firstName, $lastName, $email) {
        // Générer un ID de connexion
        $connectionId = strtolower(substr($firstName, 0, 1) . '.' . $lastName);
        $password = $this->generateTemporaryPassword();
        
        // Insérer l'utilisateur dans la base de données
        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, connection_id, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $connectionId, password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
        
        // Retourner l'ID de connexion et le mot de passe temporaire
        return ['connection_id' => $connectionId, 'temporary_password' => $password];
    }

    public function deleteUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }

    public function updateUser($userId, $firstName, $lastName, $email) {
        $stmt = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $userId);
        $stmt->execute();
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function generateTemporaryPassword() {
        return bin2hex(random_bytes(4); // Générer un mot de passe temporaire de 8 caractères
    }

    public function sendPasswordEmail($email, $connectionId, $temporaryPassword) {
        // Logique d'envoi d'email avec les informations de connexion
    }
}
?>