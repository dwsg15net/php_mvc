<?php

class Controller {

    function get_include_contents($filename, $Model, &$template) {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }

    function View($Model){

        // pega o nome da função que chamou o método
        $nameView = debug_backtrace()[1]['function'];
        // pega o nome da classe que chamou o método
        $nameFolder = str_replace("Controller", "", get_class($this));

        $template = "";

        // pega o conteudo da página
        $content_view = $this->get_include_contents("views" . DIRECTORY_SEPARATOR . $nameFolder . DIRECTORY_SEPARATOR . $nameView . ".php", $Model, $template);

        // se existir template configurador ele será renderizado
        // se não será retornado apenas o conteúdo
        if(empty($template))
        {
            echo $content_view;
        }
        else
        {
            $this->RenderTemplate($template, $content_view);
        }
    }

    // renderiza o template
    function RenderTemplate($template, $content_view){
        include("views" . DIRECTORY_SEPARATOR . $template);
    }
}
?>