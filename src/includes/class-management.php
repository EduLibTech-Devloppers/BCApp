<?php
class Management {
    private $default_token_lifetime = 15; // Durée de vie par défaut du token en minutes
    private $default_borrow_time = []; // Durée d'emprunt par type de livre
    private $api_settings = []; // Paramètres des API utilisées
    private $email_settings = []; // Paramètres d'envoi d'emails

    public function __construct() {
        // Initialisation des paramètres par défaut
        $this->default_borrow_time = [
            'BD' => 14,
            'Roman' => 21,
            'Manga' => 10,
            // Ajouter d'autres types de livres si nécessaire
        ];
        $this->api_settings = [
            'default' => 'Google Books',
            'available' => [
                'Open Library API',
                'Goodreads API',
                'WorldCat API',
                'Book Depository API',
                'MetasBooks'
            ]
        ];
        $this->email_settings = [
            'smtp' => [
                'host' => '',
                'port' => '',
                'username' => '',
                'password' => '',
                'encryption' => 'tls'
            ]
        ];
    }

    public function setTokenLifetime($minutes) {
        $this->default_token_lifetime = $minutes;
    }

    public function setBorrowTime($type, $days) {
        $this->default_borrow_time[$type] = $days;
    }

    public function setApiSettings($api) {
        if (in_array($api, $this->api_settings['available'])) {
            $this->api_settings['default'] = $api;
        }
    }

    public function setEmailSettings($host, $port, $username, $password, $encryption) {
        $this->email_settings['smtp'] = [
            'host' => $host,
            'port' => $port,
            'username' => $username,
            'password' => $password,
            'encryption' => $encryption
        ];
    }

    public function getSettings() {
        return [
            'token_lifetime' => $this->default_token_lifetime,
            'borrow_time' => $this->default_borrow_time,
            'api_settings' => $this->api_settings,
            'email_settings' => $this->email_settings
        ];
    }
}
?>