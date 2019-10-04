<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 04/10/2019
 * Time: 09:49
 */

namespace App\Controller;


use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AvatarController extends AbstractController
{
    /**
     * @var SvgAvatarFactory
     */
    private $svgAvatarFactory;
    /**
     * @var FileSystemHelper
     */
    private $fileSystemHelper;

    public function __construct(SvgAvatarFactory $svgAvatarFactory,FileSystemHelper $fileSystemHelper)
    {
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
    }
    /**
     * @Route("/avatar",name="avatar.get")
     */
    public function getAvatar($uploadDir){
        $svg = $this->svgAvatarFactory->getAvatar(2,5);
        $filename=sha1(uniqid(rand(),true)).'.svg';
        $filepath=$uploadDir.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$filename;
        $this->fileSystemHelper->write($filepath,$svg);
        return $this->render('avatar.html.twig',['filename'=>$filename]);
    }
}
