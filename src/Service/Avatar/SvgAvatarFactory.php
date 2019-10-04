<?php

namespace App\Service\Avatar;
use App\Service\Tools\ColorTools;

class SvgAvatarFactory{

    const AVATAR_DIR = 'avatars';
    private $template;
    public function __construct($template)
    {
        $this->template=$template;
    }

    public function getAvatar(int $nbColors,int $size){
        
        $colors=ColorTools::getRandomColors($nbColors);
        $matrix=new AvatarMatrix();
        $matrix->setSize($size);
        $matrix->setColors($colors);

        $svgAvatarRenderer=new SvgAvatarRenderer($this->template);
        $svg=$svgAvatarRenderer->render($matrix);
        return $svg;
    }
}