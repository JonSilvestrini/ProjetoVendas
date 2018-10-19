<?php

class Template{
    //var que receberá o arquivo template
    protected $file;
    //array que receberá os valores para mostrar no template
    protected  $values = array();

    //metodo construtor que recebe o arquvio template
    public function __construct($file){
        $this->file = $file;
    }

    //metodo que recebe a chave e os valores para o template
    public function set($key, $value){
        $this->values[$key] = $value;
    }

    //metodo para mostrar o conteúdo  do array values no template selecionado 
    public function show() {
        //teste se existe o template selecionado
        if (!file_exists($this->file)) {
            return "Erro ao carregar o template ($this->file).<br />";
        }
        //pega o conteúdo do template
        $output = file_get_contents($this->file);

        //loop que varre o array e substitui as chaves do template pelos valores do array
        foreach ($this->values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }
        // retorna a saida já com os valores para ser exibido
        return $output;
    }
}
