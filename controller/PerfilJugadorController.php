<?php
include_once('./model/UsuarioModel.php');
include_once('./model/RankingModel.php');
require_once('./phpqrcode/qrlib.php');

class PerfilJugadorController {
    private $renderer;
    private $usuarioModel;
    private $rankingModel;

    public function __construct($renderer, $usuarioModel, $rankingModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
        $this->rankingModel = $rankingModel;
    }

    public function list() {
        $id = $_GET['id'];
        $usuario = $this->usuarioModel->getUsuarioPorId($id);

        $resultado = $this->rankingModel->obtenerElRankingPorIdUsuario($id);


        $url = 'http://localhost/tpFinal/perfilJugador/list?id=' . $id;

// Ruta y nombre del archivo de imagen del código QR (puede ser un archivo PNG, JPG, etc.)
        $archivoImagen = './public/img/qrcode.png';

// Tamaño y nivel de corrección del código QR (0 = bajo, 1 = medio, 2 = alto, 3 = mejor)
        $tamaño = 10;
        $nivelCorreccion = 'L';

// Generar el código QR
        QRcode::png($url, $archivoImagen, $nivelCorreccion, $tamaño);

// Mostrar la imagen del código QR
        $datos = array(
            'ranking' => $resultado[0],
            'usuario' => $usuario[0],
            'qr' => '.'.$archivoImagen
        );
        $this->renderer->render("perfilJugador", $datos);
    }
}