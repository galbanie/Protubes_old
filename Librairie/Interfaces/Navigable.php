<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author galbanie
 */
interface Navigable {
    public function next();
    public function previous();
    public function first();
    public function last();
    public function hasNext();
    public function hasPrevious();
}

?>
