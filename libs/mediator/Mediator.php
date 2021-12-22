<?php

interface Mediator{
    function sendMessage($msg,$user);
    function addUser($user);
}


?>