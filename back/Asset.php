<?php

    class Asset
    {
        /*
         *
        */
        
        public function loadImage($image, $alt = "", $class = "")
        {
            $img = '';
            if(file_exists("./assets/images/".$image))
            {
                $img = "<img alt='".$alt."' src='./assets/images/".$image."' class='".$class."'>";
            }
            
            #
            echo $img;
        }
        
        /*
         *
        */
        public function loadStyles($styles = [])
        {
            foreach($styles as $style)
            {
                echo "<link rel='stylesheet' href='./assets/css/".$style.".css'>";
            }
        }
        
        /*
         *
        */
        public function loadScripts($scripts = [])
        {
            foreach($scripts as $script)
            {
                echo "<script src='./assets/js/".$script."'></script>";
            }
        }
    }