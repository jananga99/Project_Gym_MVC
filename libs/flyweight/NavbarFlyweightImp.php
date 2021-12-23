<?php

class NavbarFlyweightImp extends NavbarFlyweight{

    private $navbar;
    private static $instance=0;

    private function __construct(){
        $this->navbar = array();
        $this->navbar['beforeMenuPart'] = "<nav class='navbar navbar-expand-md navbar-dark' style='background-color:#053657;'>
                                <div class='container-fluid'>
                                    <a href='#' class='navbar-brand'>VirtualGYM</a>
                                    <button type='button' class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbarCollapse'>
                                    <span class='navbar-toggler-icon'></span>
                                    </button>
                                    <div class='collapse navbar-collapse' id='navbarCollapse'>
                                        <div class='navbar-nav ms-auto'>";
        $this->navbar['afterMenuPart'] =          "</div>
                                    </div>
                                </nav>";
    }

    function getNavBar(){
        return $this->navbar;
    }

    function setNavBar($n){
        $this->navbar = $n;
    }

    function getInstance(){
        if(self::$instance==0)
            self::$instance = new NavbarFlyweightImp();
        return self::$instance;
    }


}



?>