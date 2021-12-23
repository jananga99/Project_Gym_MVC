<?php
class Navbar{

    private $navbarWithoutOptions;

    function __construct($menu){
        $n = NavbarFlyweightImp::getInstance();
        $this->navbarWithoutOptions = $n->getNavBar();        
        $this->navbar = $this->navbarWithoutOptions['beforeMenuPart'];
        foreach($menu as $m=>$a){
            $this->navbar.="<a href=".$a."  class='nav-item nav-link '>".$m."</a>";
        }
        $this->navbar.= $this->navbarWithoutOptions['afterMenuPart'];
    }    

    function get(){
        return $this->navbar;
    }



}



?>