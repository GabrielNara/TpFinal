<?php
include_once('./model/PartidaModel.php');
include_once('./model/UsuarioModel.php');
include_once('./model/RolModel.php');

class RankingController
{
    private $renderer;
    private $rolModel;
    private $partidaModel;
    private $usuarioModel;

    public function __construct($renderer, $rolModel, $partidaModel, $usuarioModel)
    {
        $this->renderer = $renderer;
        $this->rolModel = $rolModel;
        $this->partidaModel = $partidaModel;
        $this->usuarioModel = $usuarioModel;
    }

    public function list()
    {
        $listaDeRanking = array();

        $jugadores = $this->rolModel->obtenerUsuariosJugadores();


        foreach ($jugadores as $item) {

            if (isset($item['idUsuario'])) {
                $puntaje = $this->partidaModel->obtenerPuntajeTotalDeUnJugador($item['idUsuario']);

                $usuario = $this->usuarioModel->getUsuarioPorId($item['idUsuario']);
                $nombreApellido = $usuario[0]["nombre"] . " " . $usuario[0]["apellido"];
                $datosJugador = array(
                    "nombreApellido" => $nombreApellido,
                    "puntaje" => $puntaje[0]["puntajeTotal"]
                );
                $listaDeRanking[] = $datosJugador;

            }
        }
        usort($listaDeRanking, function ($a, $b) {
            return $b["puntaje"] - $a["puntaje"];
        });
        $posicion = 1;
        foreach ($listaDeRanking as &$jugador) {
            $jugador["posicion"] = $posicion;
            $posicion++;
        }
        $datos = array(
            'jugadores' => $listaDeRanking
        );

        $this->renderer->render("ranking", $datos);
    }
}