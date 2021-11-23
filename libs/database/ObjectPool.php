<?php

class ObjectPool{

    private $locked;
    private $unlocked;
    private $lockedId;
    private $unlockedId;

    function __construct(){
        $this->locked = array();
        $this->lockedId=0;
        $this->unlocked = array();
        $this->unlockedId=0;
    }

    function checkout(){
        if($this->unlockedId>0){
            $dbobject = $this->unlocked[0];
            unset($this->unlocked[0]);
            $this->unlocked=array_values($this->unlocked);
            $this->unlockedId-=1;
        }else{
            $dbobject = $this->create();
            $this->locked[$this->lockedId]=$dbobject;
            $this->lockedId+=1;
        }
        return $dbobject;
    }

    function checkin($dbobject){
        $this->unlocked[$this->unlockedId]=$dbobject;
        $this->unlockedId+=1;
        foreach($this->locked as $ind=>$obj){
            if($dbobject===$obj){
                unset($this->locked[$ind]);
                $this->locked=array_values($this->locked);
                $this->lockedId-=1;
                break;
            }
        }
    
    }


}


?>