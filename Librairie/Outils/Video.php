<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Video
 *
 * @author galbanie
 */
class Video {
    public $video_file, $duration, $bitrate, $video_format, $audio_format,
    $video_size, $video_fps, $audio_freq, $audio_bitrate,
    $encoding_vformat, $encoding_aformat, $encoding_vcodec, $encoding_acodec,
    $encoding_vsize, $encoding_duration, $encoding_afreq, $encoding_target,
    $encoding_packet_size, $encoding_aspect, $encoding_ac, $encoding_bitrate,
    $encoding_abitrate, $encoding_fps, $encoding_time_position, $encoding_nosound;
    private $video_id;
    
    /*
    * function : __construct
    * @description : Constructor
    * @param : $video
    */
    public function __construct($video){
        $this->video_file = $video;
        $this->video_id = md5($video);
        //On récupère les infos de la vidéo
        exec("ffmpeg -i ".$this->video_file." &> ".$this->video_id.".info");
        $this->get_video_info();
    }
    
    /*
    * function : __destruct
    * @description : Destructor
    * @param :
    */
    public function __destruct(){
        if( is_file($this->video_id.".info") ) unlink($this->video_id.".info");
    }
    
    /*
    * function : getextension
    * @description : return the extension of any file
    * @param : $file - name of the file (video.avi)
    */
    public function getextension($file){
        return substr($file,strrpos($file,'.')+1);
    }
    
    /*
    * function : get_video_info
    * @description : Extract all the video information with ffmpeg
    */
    private function get_video_info(){
        $handle = fopen($this->video_id.".info","r");
        if($handle){
            while (!feof($handle)) {
                $buffer = fgets($handle, 4096);
                $Line=explode(" ",$buffer);
                //print_r($Line);
                //print("\n");
                switch($Line[2]){
                    case 'Duration:':
                        $this->duration = $Line[3];
                        $this->bitrate = $Line[7];
                    case 'Stream':
                        if($Line[4]=="Video:"){
                            $this->video_format = $Line[5];
                            $this->video_size = $Line[7];
                            $this->video_fps = $Line[8];
                        }elseif($Line[4]=="Audio:"){
                            $this->audio_format = $Line[5];
                            $this->audio_freq = $Line[6];
                            $this->audio_bitrate= $Line[9];
                        }
                }
            }
            fclose($handle);
            return true;
        }
        return false;
    }
    
    /*
    * function : set_encoding_vformat()
    * @description : Set the format for video encoding
    * @param : $format (the format of the output video)
    */
    public function set_encoding_vformat($format){
        $this->encoding_vformat = $format;
    }
    /*
    * function : set_encoding_aformat()
    * @description : Set the format for audio encoding
    * @param : $format (the format of the output audio)
    */
    public function set_encoding_aformat($format){
        $this->encoding_aformat = $format;
    }
    /*
    * function : set_encoding_vcodec()
    * @description : Set the codec for video encoding, be carefull with the codec name
    * @param : $codec (the codec of the output video)
    */
    public function set_encoding_vcodec($codec){
        $this->encoding_vcodec = $codec;
    }
    /*
    * function : set_encoding_acodec()
    * @description : Set the codec for audio encoding, be carefull with the codec name
    * @param : $codec (the codec of the output audio)
    */
    public function set_encoding_acodec($codec){
        $this->encoding_acodec = $codec;
    }
    /*
    * function : set_encoding_vsize()
    * @description : Set the size of the output video
    * @param : $width (width of the output video)
    * @param : $height (height of the output video)
    */
    public function set_encoding_vsize($size){
        $this->encoding_vsize = $size;
    }
    /*
    * function : set_encoding_duration()
    * @description : Set the size of the output video
    * @param : $duration (duration of the output like 00:00:10)
    */
    public function set_encoding_duration($duration){
        $this->encoding_duration = $duration;
    }
    /*
    * function : set_encoding_afreq()
    * @description : Set the audio frequence of the output video
    * @param : $freq (audio frequence of the output like 00:00:10)
    */
    public function set_encoding_afreq($freq){
        $this->encoding_afreq = $freq;
    }
    /*
    * function : set_encoding_target()
    * @description : Specify target file type
    * @param : $target (Specified target file type)
    */
    public function set_encoding_target($target){
        $this->encoding_target = $target;
    }
    /*
    * function : set_encoding_packet_size()
    * @description : Set packet size in bits.
    * @param : $weight (Size)
    */
    public function set_encoding_packet_size($weight){
        $this->encoding_packet_size = $weight;
    }
    /*
    * function : set_encoding_aspect()
    * @description : Set aspect ratio (4:3, 16:9 or 1.3333, 1.7777).
    * @param : $ratio (Ratio of the generated video)
    */
    public function set_encoding_aspect($ratio){
        $this->encoding_aspect = $ratio;
    }
    /*
    * function : set_encoding_ac()
    * @description : Set the number of audio channels
    * @param : $nb (Number of channels)
    */
    public function set_encoding_ac($nb){
        $this->encoding_ac = $nb;
    }
    /*
    * function : set_encoding_bitrate()
    * @description : Set the video bitrate in bit/s
    * @param : $bitrate
    */
    public function set_encoding_bitrate($bitrate){
        $this->encoding_bitrate = $bitrate;
    }
    /*
    * function : set_encoding_abitrate()
    * @description : Set the audio bitrate in bit/s
    * @param : $abitrate
    */
    public function set_encoding_abitrate($abitrate){
        $this->encoding_abitrate = $abitrate;
    }
    /*
    * function : set_encoding_fps()
    * @description : Set frame rate
    * @param : $fps
    */
    public function set_encoding_fps($fps){
        $this->encoding_fps = $fps;
    }
    /*
    * function : set_encoding_time_position()
    * @description : time position in seconds. hh:mm:ss[.xxx] syntax is also supported.
    * @param : $position
    */
    public function set_encoding_time_position($position){
        $this->encoding_time_position = $position;
    }
    /*
    * function : set_encoding_nosound()
    * @description : time position in seconds. hh:mm:ss[.xxx] syntax is also supported.
    * @param : $position
    */
    public function set_encoding_nosound(){
        if($this->encoding_nosound)$this->encoding_nosound=false;
        else $this->encoding_nosound=true;
    }
    /*
    * function : encode()
    * @description : Encode video with defined params
    * @param : $file_name (name of the file created.)
    */
    public function encode($file_name){
        $command = "ffmpeg -y -i ".$this->video_file;
        if($this->encoding_vformat) $command.=" -f ".$this->encoding_vformat;
        if($this->encoding_vcodec) $command.=" -vcodec ".$this->encoding_vcodec;
        if($this->encoding_acodec) $command.=" -acodec ".$this->encoding_acodec;
        if($this->encoding_vsize) $command.=" -s ".$this->encoding_vsize;
        if($this->encoding_duration) $command.=" -t ".$this->encoding_duration;
        if($this->encoding_fps) $command.=" -r ".$this->encoding_fps;
        if($this->encoding_bitrate) $command.=" -b ".$this->encoding_bitrate;
        if($this->encoding_nosound) $command.=" -an ";
        if($this->encoding_abitrate) $command.=" -ab ".$this->encoding_abitrate;
        if($this->encoding_afreq) $command.=" -ar ".$this->encoding_afreq;
        if($this->encoding_ac) $command.=" -ac ".$this->encoding_ac;
        if($this->encoding_target) $command.=" -target ".$this->encoding_target;
        if($this->encoding_packet_size) $command.=" -ps ".$this->encoding_packet_size;
        if($this->encoding_aspect) $command.=" -aspect ".$this->encoding_aspect;
        if($this->encoding_time_position) $command.=" -ss ".$this->encoding_time_position;
        $command.=" $file_name";
        print("commande executée : $command");
        shell_exec($command);
    }
    /*
    * function : get_image()
    * @description : Get an image for a specific frame of a video
    * @param : $frame (00:00:10.0002)
    * @param : $image_name (name of this image)
    * @param : $size
    */
    public function get_image($frame,$image_name,$size){
        $this->encoding_vformat = "mjpeg";
        $this->encoding_duration = "001";
        $this->encoding_time_position = $frame;
        $this->encoding_vsize = $size;
        //We build the image
        $this->encode($image_name);
    }
}

?>
