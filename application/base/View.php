<?php
namespace app\base;

abstract class View {
    abstract public function render($response);
}