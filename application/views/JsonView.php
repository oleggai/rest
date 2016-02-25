<?php
namespace app\views;

use app\base\View;
use app\base\Response;

class JsonView extends View {
    /**
     * @param $response Response
     * @return bool
     */
    public function render($response) {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($response);
        return true;
    }
}