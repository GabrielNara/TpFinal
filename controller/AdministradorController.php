<?php


class AdministradorController
{
    private $renderer;

    private $administradorModel;


    public function __construct($renderer, $administradorModel)
    {
        $this->renderer = $renderer;
        $this->administradorModel = $administradorModel;

    }

    public function redireccionamiento() {
        $usuario = $_SESSION['usuario'];
        $rol = $this->administradorModel->getRol($usuario["id"]);

        if ($rol[0]['idRol'] == 3 || $rol[0]['idRol'] == 2 ) {

            header('Location: /tpfinal/lobby/list');
            exit();
        }
    }

    public function estadisticas(){

        $this->redireccionamiento();

        $this->renderer->render("estadisticas");


    }

/*
    public function cantJugadores()
    {
        $this->redireccionamiento();



        $cantidadJugadores = $this->administradorModel->obtenerCantidadJugadores();
        $jugadores = $cantidadJugadores[0]['cantidad'];

        $contexto = array(
            'jugadores' => $jugadores
        );

        $this->renderer->render("cantidadJugadores", $contexto);
    }
 */
    public function cantJugadores($filtro = 'todos')
    {
        $this->redireccionamiento();

        $filtroPeriodo = '';

        switch ($filtro) {
            case 'dia':
                $filtroPeriodo = 'DATE(u.fecha_registro) = CURDATE()';
                break;
            case 'semana':
                $filtroPeriodo = 'WEEK(u.fecha_registro) = WEEK(CURDATE())';
                break;
            case 'mes':
                $filtroPeriodo = 'MONTH(u.fecha_registro) = MONTH(CURDATE())';
                break;
            case 'anio':
                $filtroPeriodo = 'YEAR(u.fecha_registro) = YEAR(CURDATE())';
                break;
            default:
                // Filtro "todos" (sin restricciones)
                break;
        }

        $cantidadJugadores = $this->administradorModel->obtenerCantidadJugadores($filtroPeriodo);

        $contexto = array(
            'jugadores' => $cantidadJugadores
        );

        $this->renderer->render("cantidadJugadores", $contexto);
    }





}