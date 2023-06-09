<?php


class EditorController
{
    private $renderer;

    private $editorModel;


    public function __construct($renderer, $editorModel)
    {
        $this->renderer = $renderer;
        $this->editorModel = $editorModel;
    }

    public function redireccionamiento()
    {
        if (isset($_SESSION['usuario'])) {
            $rol = $this->editorModel->getRol($_SESSION['usuario']["id"]);

            if ($rol[0]['idRol'] == 3) {
                header('Location: /tpfinal/lobby/list');
                exit();
            }
        } else {
            header('Location: /tpfinal/');
            exit();
        }
    }

    public function revisionPreguntas()
    {
        $this->redireccionamiento();

        $preguntas = $this->editorModel->obtenerPreguntas();

        $contexto = array(
            'preguntas' => $preguntas
        );

        $this->renderer->render("revisionPreguntas", $contexto);
    }

    public function revisarPregunta()
    {
        $this->redireccionamiento();

        $idPregunta = $_GET["id"];

        $preguntaObtenida = $this->editorModel->obtenerPregunta($idPregunta);
        $categoriasObtenidas = $this->editorModel->obtenerCategoriasActivas();

        $datos = array(
            'pregunta' => $preguntaObtenida,
            'categorias' => $categoriasObtenidas
        );

        $this->renderer->render('revisarPregunta', $datos);
    }

    public function aprobarPregunta()
    {
        $datos = array(
            'id' => $_POST['id_pregunta'],
            'pregunta' => $_POST['pregunta'],
            'opcionA' => $_POST['opcionA'],
            'opcionB' => $_POST['opcionB'],
            'opcionC' => $_POST['opcionC'],
            'opcionD' => $_POST['opcionD'],
            'categoria' => $_POST['categoria']
        );

        $errores = $this->editorModel->validarPreguntaAprobada($datos);

        $contexto = array(
            'datos' => $datos,
            'errores' => $errores
        );

        if (!empty($errores)) {
            $this->renderer->render("crearPregunta", $contexto);
        } else {
            $this->revisionPreguntas();
        }
    }

    public function rechazarPregunta()
    {
        $idPregunta = $_GET['id'];
        $this->editorModel->suspenderPregunta($idPregunta);
        $this->revisionPreguntas();
    }


    public function aprobarCategoria()
    {
        $this->redireccionamiento();

        $idCategoria = $_POST["id"];

        $categoria = $this->editorModel->aprobarCategoria($idCategoria);

        $datos = array(
            'categoria' => $categoria
        );

        json_encode($datos);
    }

    public function suspenderCategoria()
    {
        $this->redireccionamiento();

        $idCategoria = $_POST["id"];

        $categoria = $this->editorModel->suspenderCategoria($idCategoria);

        $datos = array(
            'categoria' => $categoria
        );

        json_encode($datos);
    }

	public function list()
	{
		header('Location: /tpfinal/lobby/list');
		exit();
	}

    public function revisionCategorias() {
        $this->redireccionamiento();

        $categorias = $this->editorModel->obtenerCategorias();

        $contexto = array(
            'categorias' => $categorias
        );


        $this->renderer->render("revisionCategorias", $contexto);
    }
}
