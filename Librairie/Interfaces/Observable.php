<?php

/**
 *
 * @author galbanie
 */
interface Observable {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notifyObservers();
    public function notify(Observer $observer, $arg = null);
}

?>
