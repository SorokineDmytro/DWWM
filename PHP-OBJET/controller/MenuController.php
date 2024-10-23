<?php
    class MenuController extends MyFct {
        public function __construct() {
            $action = "list";
            $mm = new MenuManager();
        }
    }