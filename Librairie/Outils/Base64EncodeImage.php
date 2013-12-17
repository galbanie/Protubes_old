<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base64EncodeImage
 *
 * @author galbanie <galbanie at setrukmarcroger@gmail.com>
 */
class Base64EncodeImage {
    
    static function base64_encode_image_path($filename=string,$filetype=string) {
        if ($filename) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
        }
    }
    
    static function base64_encode_image_binary($imgbinary,$type){
        return 'data:' . $type . ';base64,' . base64_encode($imgbinary);
    }
}
