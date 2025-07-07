<?php

namespace Controllers;

use Classes\SessionHelper;

class BaseController{
    public function __construct() {
        SessionHelper::start();
    }
}
