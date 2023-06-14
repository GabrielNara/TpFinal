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

    public function revisionPreguntas()
    {
        $preguntas = $this->editorModel->obtenerPreguntas();

        $contexto = array(
            'preguntas' => $preguntas
        );

        $this->renderer->render("revisionPreguntas", $contexto);
    }

    public function revisarPregunta()
    {
        $idPregunta = $_GET["id"];

        $preguntaObtenida = $this->editorModel->obtenerPregunta($idPregunta);

        $datos = array(
            'pregunta' => $preguntaObtenida
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
        $this->editorModel->eliminarPregunta($idPregunta);
        $this->revisionPreguntas();
    }

}


