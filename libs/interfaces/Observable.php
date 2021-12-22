<?php
interface Observable {
   public function notifyObservers($data);
}
?>