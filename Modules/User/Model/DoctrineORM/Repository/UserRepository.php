<?php

namespace Modules\User\Model\DoctrineORM\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class UserRepository extends EntityRepository
{

    /**
     * @var string
     */
    protected $_entityName = 'Modules\User\Model\DoctrineORM\Entity\User';

    /**
     * @var EntityManager
     */
    protected $_em;

    public function __construct(EntityManager $em)
    {
        $this->_em = $em;
    }

    public function findItems($options = array())
    {
        $options['count']          = isset($options['count']) ? $options['count'] : false;
        $options['paginator']      = isset($options['paginator']) ? $options['paginator'] : false;
        $options['page']           = isset($options['page']) ? $options['page'] : 1;
        $options['items_per_page'] = isset($options['items_per_page']) ? $options['items_per_page'] : 10;
        $options['order']          = isset($options['order']) ? $options['order'] : 'email';
        $options['offset']         = isset($options['offset']) ? $options['offset'] : 0;
        $options['limit']          = isset($options['limit']) ? $options['limit'] : 0;

        $builder = $this->createQueryBuilder('t');
        $builder->select('t');

//        if (isset($options['filter_email'])) {
//            $builder->andWhere('t.email LIKE :email')->setParameter('email', '%' . $options['filter_email'] . '%');
//        }
//
//        if (isset($options['role_id'])) {
//            $builder->andWhere('t.roleId = :role_id')->setParameter('role_id', $options['role_id']);
//        }
//
//        if (isset($options['status_id'])) {
//            $builder->andWhere('t.statusId = :status_id')->setParameter('status_id', $options['status_id']);
//        }

        if ($options['order'] == 'email') {
            $builder->orderBy('t.email', 'ASC');
        } else {
            $builder->orderBy($options['order']);
        }

        if ($options['offset'])
            $builder->setFirstResult((int) $options['offset']);
        if ($options['limit'])
            $builder->setMaxResults((int) $options['limit']);

        $query = $builder->getQuery();

        if ((bool) $options['count']) {
            return $builder->select('count(t.id)')->getQuery()->getSingleScalarResult();
        }

        if ($options['paginator']) {
            $doctrinePaginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);
            $doctrineAdapter   = new \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator($doctrinePaginator);
//            $paginator         = new \Zend\Paginator\Paginator($doctrineAdapter);
            $paginator         = new \LaravelDoctrine\ORM\Pagination;
            $paginator->setCurrentPageNumber($options['page']);
            $paginator->setItemCountPerPage($options['items_per_page']);
            return $paginator;
        }

        return $query->execute();
    }

    public function saveItem($item)
    {
//        $isNew = $this->getEntityManager()->getUnitOfWork()->getEntityState($item) === \Doctrine\ORM\UnitOfWork::STATE_NEW;

        $this->_em->persist($item);
        $this->_em->flush($item);

//        if ($isNew)
//            $this->getEventManager()->trigger('absuser.model.user.create', $this, array('item' => $item));
//        else
//            $this->getEventManager()->trigger('absuser.model.user.update', $this, array('item' => $item));

        return $item;
    }

    public function createItem()
    {
        $itemClass = $this->getEntityName();

        return new $itemClass;
    }

    public function deleteItem($item)
    {
        $this->_em->remove($item);
        $this->_em->flush();
    }

    public function findItemById($id)
    {
        return $this->_em->findOneBy(array('id' => $id));
    }

    public function findItemsByUserId($id)
    {
        $builder = $this->createQueryBuilder('t');
        $builder->select('t');
        $builder->where('t.userId = :id')->setParameter('id', $id);

        $query = $builder->getQuery();
        return $query->execute();
    }

    /**
     * Confirm a user.
     *
     * @param string $confirmationCode
     * @return Modules\User\Model\DoctrineORM\Entity\User
     */
    public function confirm($confirmationCode)
    {
        $item = $this->_em->getRepository($this->_entityName)->findOneBy([
            'confirmationCode' => $confirmationCode,
        ]);
        $item->setConfirmed(1);
        $item->setConfirmationCode(NULL);
        $item->setUpdatedAt(new \DateTime);
        $user = $this->saveItem($item);
        return $item;
    }

}
