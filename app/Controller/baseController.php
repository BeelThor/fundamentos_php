<?php
namespace app\Controller;
use Laminas\Diactoros\Response\HtmlResponse;
class baseController{
    protected $templateEngine;
    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
    }
    public function renderHTML($fileName, $data = []){
        return new HtmlResponse($this->templateEngine->render($fileName,$data));

    }
}