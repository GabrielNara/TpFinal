<?php

class PerfilJugadorController {
    private $renderer;

    public function __construct($renderer) {
        $this->renderer = $renderer;
    }

    public function list() {
        $data['usuario'] = $_SESSION['usuario'];
        $this->renderer->render("perfilJugador", $data);
    }
}