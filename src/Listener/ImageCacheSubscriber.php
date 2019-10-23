<?php
namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifeCycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;


class ImageCacheSubscriber implements EventSubscriber {

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper) {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents() {
        return [
            'preRemove',
            'preUpdate'
        ];
    }
    
    public function preRemove(LifeCycleEventArgs $args) {

        $entity = $args->getEntity();

        if(!$entity instanceof Picture) {
            return;
        }
        $this->cacheManger->remove($this->uploaderHelper->asset($entity, 'imageFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        if(!$entity instanceof Picture) {
            return;
        }
        if($entity->getImageFile() instanceof UploadedFile) {
            $this->cacheManger->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }

    }
}