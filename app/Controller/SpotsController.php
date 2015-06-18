<?php
App::uses("ApiController", "Controller");
class SpotsController extends ApiController {
    public $name = "Spots";
    public $uses = array("Spot");
    public $layout = null;

}
