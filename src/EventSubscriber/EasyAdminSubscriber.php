<?php

namespace App\EventSubscriber;

use App\Entity\Blogpost;
use App\Entity\Paint;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use DateTime;

    class EasyAdminSubscriber implements EventSubscriberInterface{
        
        private $slugger;
        private $security;

        public function __construct(SluggerInterface $slugger, Security $security)
        {
            $this->slugger = $slugger;
            $this->security = $security;
        }

        public static function getSubscribedEvents(){
            return [
                BeforeEntityPersistedEvent::class=>['setDateAndUser'],
            ];
        }

        public function setDateAndUser(BeforeEntityPersistedEvent $event){

            $entity = $event->getEntityInstance();

            if(($entity instanceof Blogpost)){
                $now = new DateTime('now');
                $entity->setDate($now);
    
                $user = $this->security->getUser();
                $entity->setUser($user);
            }

            if(($entity instanceof Paint)){
                $now = new DateTime('now');
                $entity->setDateOfCompletion($now);
    
                $user = $this->security->getUser();
                $entity->setUser($user);
            }            
            return;
        }
    }


?>