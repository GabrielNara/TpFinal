<?php

class HomeController
{
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function list()
    {
        if (!isset($_SESSION['usuario'])) {
            $this->renderer->render('home');
        } else {
            header('Location: lobby/list');
            exit();
        }
    }
}