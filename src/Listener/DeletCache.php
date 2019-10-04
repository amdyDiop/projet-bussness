<?php
namespace  App\Listener;
use App\Entity\Property;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class DeletCache implements  EventSubscriber
{
    /**
     * @var CacheManager
     */
    private $cacheManager;
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager , UploaderHelper $uploaderHelper)
    {

        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }
    /**
     *
     * @return string[]
     */
    public  function getSubscribedEvents(){
        return [
            'preRemove',
            'remove'
        ];
    }
    public function preRemove(LifecycleEventArgs $args ){
        $entity = $args->getEntity();
        if(!$entity instanceof Property)
        {
            return;
        }
        $this->cacheManager->remove($this->uploaderHelper->asset($entity ,'imageFile'));

    }


    public function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Property)
        {
            return;
        }
        if($entity->getImageFile() instanceof UploadedFile){
        $this->cacheManager->remove($this->uploaderHelper->asset($entity ,'imageFile'));
        }
    }


}
