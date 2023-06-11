<?php

class RankingModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerPuntajeTotalDeUnJugador($idJugador)
    {
        $query = "SELECT SUM(puntaje) as puntajeTotal FROM `partidas` WHERE idUsuario = $idJugador";
        return $this->database->query($query);
    }

    public function obtenerMayorPuntaje($idJugador)
    {
        $query = "SELECT MAX(puntaje) as puntajeTotal FROM `partidas` WHERE idUsuario = $idJugador";
        return $this->database->query($query);
    }

    public function obtenerHistorial($idJugador)
    {
        $query = "SELECT fecha, puntaje FROM `partidas` WHERE idUsuario = $idJugador ORDER BY fecha desc";
        return $this->database->query($query);
    }

    public function obtenerElRanking()
    {
        $query = "SELECT u.id, u.nombre, u.apellido, SUM(p.puntaje) AS puntajeTotal, COUNT(*) AS cantidadPartidas,
                    (SELECT COUNT(*) FROM (SELECT SUM(puntaje) AS total_puntaje
                    FROM usuarios u
                    INNER JOIN partidas p ON u.id = p.idUsuario
                    GROUP BY u.id) AS puntajes
                    WHERE puntajes.total_puntaje >= SUM(p.puntaje)) AS posicion
                    FROM usuarios u
                    INNER JOIN partidas p ON u.id = p.idUsuario
                    GROUP BY u.id
                    ORDER BY puntajeTotal DESC;";
        return $this->database->query($query);
    }

    public function obtenerElRankingPorIdUsuario($idUsuario)
    {
        $ranking = $this->obtenerElRanking();

        $resultado = array_values(array_filter($ranking, function ($item) use ($idUsuario) {
            return $item["id"] == $idUsuario;
        }));

        return $resultado;
    }
}