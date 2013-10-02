<?php

/**
 *
 * @author galbanie
 */
interface Observer {
    public function update(Observable $subject, $arg = null);
}

?>
