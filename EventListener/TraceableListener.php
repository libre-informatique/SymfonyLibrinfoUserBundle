<?php

namespace Librinfo\UserBundle\EventListener;

use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserInterface;
use Blast\BaseEntitiesBundle\EventListener\Traits\ClassChecker;

class TraceableListener implements LoggerAwareInterface, EventSubscriber
{
    use ClassChecker;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var string
     */
    private $userClass;

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'loadClassMetadata',
            'prePersist',
            'preUpdate'
        ];
    }

    /**
     * define Traceable mapping at runtime
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();

        $reflectionClass = $metadata->getReflectionClass();

        if (!$reflectionClass || !$this->hasTrait($reflectionClass, 'Librinfo\UserBundle\Entity\Traits\Traceable'))
            return; // return if current entity doesn't use Traceable trait

        // Check if parents already have the Traceable trait
        foreach ($metadata->parentClasses as $parent)
            if ($this->classAnalyzer->hasTrait($parent, 'Librinfo\UserBundle\Entity\Traits\Traceable'))
                return;

        $this->logger->debug("[TraceableListener] Entering TraceableListener for « loadClassMetadata » event");
        $this->logger->debug("[TraceableListener] Using « " . $this->userClass . " » as User class");

        // setting default mapping configuration for Traceable

        // createdBy
        $metadata->mapManyToOne([
            'targetEntity' => $this->userClass,
            'fieldName'    => 'createdBy',
            'joinColumn'   => [
                'name'                 => 'createdBy_id',
                'referencedColumnName' => 'id',
                'onDelete'             => 'SET NULL',
                'nullable'             => true
            ]
        ]);

        // updatedBy
        $metadata->mapManyToOne([
            'targetEntity' => $this->userClass,
            'fieldName'    => 'updatedBy',
            'joinColumn'   => [
                'name'                 => 'updatedBy_id',
                'referencedColumnName' => 'id',
                'onDelete'             => 'SET NULL',
                'nullable'             => true
            ]
        ]);

        $this->logger->debug("[TraceableListener] Added Traceable mapping metadata to Entity", ['class' => $metadata->getName()]);
    }

    /**
     * sets Traceable dateTime and user information when persisting entity
     *
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getObject();

        if (!$this->hasTrait($entity, 'Librinfo\UserBundle\Entity\Traits\Traceable'))
            return;

        $this->logger->debug("[TraceableListener] Entering TraceableListener for « prePersist » event");
        $user = $this->tokenStorage->getToken() ? $this->tokenStorage->getToken()->getUser() : NULL;
        $now = new DateTime('NOW');

        if ($user instanceof UserInterface) {
            $entity->setCreatedBy($user);
            $entity->setUpdatedBy($user);
        }
        $entity->setCreatedAt($now);
        $entity->setUpdatedAt($now);
    }

    /**
     * sets Traceable dateTime and user information when updating entity
     *
     * @param LifecycleEventArgs $eventArgs
     */
    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getObject();

        if (!$this->hasTrait($entity, 'Blast\BaseEntitiesBundle\Entity\Traits\Traceable'))
            return;

        $this->logger->debug("[TraceableListener] Entering TraceableListener for « preUpdate » event");

        $user = $this->tokenStorage->getToken() ? $this->tokenStorage->getToken()->getUser() : NULL;
        $now = new DateTime('NOW');

        $entity->setUpdatedBy($user instanceof UserInterface ? $user : NULL);
        $entity->setUpdatedAt($now);
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * setTokenStorage
     *
     * @param TokenStorage $tokenStorage
     */
    public function setTokenStorage(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param string $userClass
     */
    public function setUserClass($userClass)
    {
        $this->userClass = $userClass;
    }
}
