<?php

class passwordValidator
{
    private $minLength;
    private $requireUppercase;
    private $requireNumber;
    private $requireSpecialChar;

    public function __construct($minLength = 8, $requireUppercase = true, $requireNumber = true, $requireSpecialChar = true)
    {
        $this->minLength = $minLength;
        $this->requireUppercase = $requireUppercase;
        $this->requireNumber = $requireNumber;
        $this->requireSpecialChar = $requireSpecialChar;
    }

    public function validate($password)
    {
        $errors = [];

        // Prüfen der Mindestlänge
        if (strlen($password) < $this->minLength) {
            $errors[] = "Das Passwort muss mindestens {$this->minLength} Zeichen lang sein.";
        }

        // Prüfen auf Großbuchstaben
        if ($this->requireUppercase && !preg_match('/[A-Z]/', $password)) {
            $errors[] = "Das Passwort muss mindestens einen Großbuchstaben enthalten.";
        }

        // Prüfen auf Zahlen
        if ($this->requireNumber && !preg_match('/[0-9]/', $password)) {
            $errors[] = "Das Passwort muss mindestens eine Zahl enthalten.";
        }

        // Prüfen auf Sonderzeichen
        if ($this->requireSpecialChar && !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $errors[] = "Das Passwort muss mindestens ein Sonderzeichen enthalten.";
        }

        // Rückgabe der Ergebnisse
        if (empty($errors)) {
            return ["success" => true, "message" => "Das Passwort ist gültig."];
        } else {
            return ["success" => false, "errors" => $errors];
        }
    }
}