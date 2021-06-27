<?php

namespace App\Repository;

use App\Entity\AttributeValue;
use App\Entity\CheckLikeOffer;
use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */

    public function findByAll(): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByAllOffersUser(int $id): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.uploadedAt', 'DESC')
            ->where('o.user = :id')
            ->setParameter('id', $id, ParameterType::INTEGER)
            ->getQuery()
            ->getResult();
    }

    public function findByAllOtherOffersUser(int $id, int $offerId): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.uploadedAt', 'DESC')
            ->where('o.user = :id')
            ->andWhere('o.id != :offerId')
            ->setParameter('id', $id, ParameterType::INTEGER)
            ->setParameter('offerId', $offerId, ParameterType::INTEGER)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function findByOfferByIndex(): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function findBySortOffers(int $val): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->leftJoin(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id');
        if ($val == 0) {
            $q->orderBy('o.uploadedAt', 'DESC');
        }
        if ($val == 0) {
            $q->orderBy('av.value = 2', 'ASC');
        }
        if ($val == 0) {
            $q->orderBy('av.value = 2', 'DESC');
        }

        return $q->getQuery()
            ->getResult();
    }

    public function findByCategoryOffers(int $value): ?array
    {
        return $this->createQueryBuilder('o')
            ->Where('o.template = :val')
            ->setParameter('val', $value, ParameterType::INTEGER)
            ->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByChildCategoryOffers(int $value, int $child): ?array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('o.template = :val')
            ->setParameter('val', $value, ParameterType::INTEGER)
            ->andWhere('av.attribute = 21 AND av.value = :int')
            ->setParameter('int', $child, ParameterType::INTEGER)
            ->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByLikeUserOffers(int $userId): ?array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin(CheckLikeOffer::class, 'cp', Join::WITH, 'cp.offer = p.id')
            ->Where('cp.user IN (:user)')
            ->setParameter('user', $userId, ParameterType::INTEGER)
            ->orderBy('p.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);

        if ($filters['location'] > 0) {
            $q->leftJoin(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av1.attribute = 17 AND av1.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if ($cat == 1 || $cat == 2) {
            if($cat == 1 ){
                if ($filters['mark'] > 0) {
                    $q->andWhere('av.attribute = 3 AND av.value = :mark')
                        ->setParameter('mark', $filters['mark'], ParameterType::INTEGER);
                }
                if ($filters['model'] > 0) {
                    $q->Join(AttributeValue::class, 'av2', Join::WITH, 'av2.offer = o.id')
                        ->andWhere('av2.attribute = 4 AND av2.value = :model')
                        ->setParameter('model', $filters['model'], ParameterType::INTEGER);
                }
                if ($filters['milF'] < $filters['milT']) {
                    $q->leftJoin(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                        ->andWhere('av6.attribute = 9 AND av6.value >= :milF')
                        ->andWhere('av6.attribute = 9 AND av6.value <= :milT')
                        ->setParameter('milF', $filters['milF'], ParameterType::INTEGER)
                        ->setParameter('milT', $filters['milT'], ParameterType::INTEGER);

                }
                if ($filters['powF'] < $filters['powT']) {
                    $q->leftJoin(AttributeValue::class, 'av7', Join::WITH, 'av7.offer = o.id')
                        ->andWhere('av7.attribute = 8 AND av7.value >= :powF')
                        ->andWhere('av7.attribute = 8 AND av7.value <= :powT')
                        ->setParameter('powF', $filters['powF'], ParameterType::INTEGER)
                        ->setParameter('powT', $filters['powT'], ParameterType::INTEGER);

                }
                if ($filters['fuel'] > 0) {
                    $q->Join(AttributeValue::class, 'av8', Join::WITH, 'av8.offer = o.id')
                        ->andWhere('av8.attribute = 7 AND av8.value = :fuel')
                        ->setParameter('fuel', $filters['fuel'], ParameterType::INTEGER);
                }
                if ($filters['gearbox'] > 0) {
                    $q->Join(AttributeValue::class, 'av9', Join::WITH, 'av9.offer = o.id')
                        ->andWhere('av9.attribute = 13 AND av9.value = :gearbox')
                        ->setParameter('gearbox', $filters['gearbox'], ParameterType::INTEGER);
                }
                if ($filters['body'] > 0) {
                    $q->Join(AttributeValue::class, 'av10', Join::WITH, 'av10.offer = o.id')
                        ->andWhere('av10.attribute = 11 AND av10.value = :body')
                        ->setParameter('body', $filters['body'], ParameterType::INTEGER);
                }
                if ($filters['handlebar'] > 0) {
                    $q->Join(AttributeValue::class, 'av12', Join::WITH, 'av12.offer = o.id')
                        ->andWhere('av12.attribute = 15 AND av12.value = :handlebar')
                        ->setParameter('handlebar', $filters['handlebar'], ParameterType::INTEGER);
                }
                if ($filters['color'] > 0) {
                    $q->Join(AttributeValue::class, 'av13', Join::WITH, 'av13.offer = o.id')
                        ->andWhere('av13.attribute = 10 AND av13.value = :color')
                        ->setParameter('color', $filters['color'], ParameterType::INTEGER);
                }

            }
            if($cat == 2){
                if ($filters['childCat'] > 0) {
                    $q->Join(AttributeValue::class, 'av15', Join::WITH, 'av15.offer = o.id')
                        ->andWhere('av15.attribute = 21 AND av15.value = :childCat')
                        ->setParameter('childCat', $filters['childCat'], ParameterType::INTEGER);
                }
                if ($filters['markMotors'] > 0) {
                    $q->Join(AttributeValue::class, 'av16', Join::WITH, 'av16.offer = o.id')
                        ->andWhere('av16.attribute = 27 AND av16.value = :markMotors')
                        ->setParameter('markMotors', $filters['markMotors'], ParameterType::INTEGER);
                }
            }
            if ($filters['yearF'] < $filters['yearT']) {
                $q->leftJoin(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                    ->andWhere('av4.attribute = 5 AND av4.value >= :yearF')
                    ->andWhere('av4.attribute = 5 AND av4.value <= :yearT')
                    ->setParameter('yearF', $filters['yearF'], ParameterType::INTEGER)
                    ->setParameter('yearT', $filters['yearT'], ParameterType::INTEGER);

            }
            if ($filters['capF'] < $filters['capT']) {
                $q->leftJoin(AttributeValue::class, 'av5', Join::WITH, 'av5.offer = o.id')
                    ->andWhere('av5.attribute = 6 AND av5.value >= :capF')
                    ->andWhere('av5.attribute = 6 AND av5.value <= :capT')
                    ->setParameter('capF', $filters['capF'], ParameterType::INTEGER)
                    ->setParameter('capT', $filters['capT'], ParameterType::INTEGER);

            }

        }
        if ($filters['country'] > 0) {
            $q->Join(AttributeValue::class, 'av11', Join::WITH, 'av11.offer = o.id')
                ->andWhere('av11.attribute = 14 AND av11.value = :country')
                ->setParameter('country', $filters['country'], ParameterType::INTEGER);
        }
        if ($filters['condition'] > 0) {
            $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                ->andWhere('av14.attribute = 12 AND av14.value = :condition')
                ->setParameter('condition', $filters['condition'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByChildVansTrucksCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('av.attribute = 21 AND av.value = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if($cat == 1 || $cat == 2){
            if ($filters['markVT'] > 0) {
                $q->leftJoin(AttributeValue::class, 'av2', Join::WITH, 'av2.offer = o.id')
                    ->andWhere('av2.attribute = 24 AND av2.value = :markVT')
                    ->setParameter('markVT', $filters['markVT'], ParameterType::INTEGER);
            }
            if ($filters['capF'] < $filters['capT']) {
                $q->leftJoin(AttributeValue::class, 'av5', Join::WITH, 'av5.offer = o.id')
                    ->andWhere('av5.attribute = 6 AND av5.value >= :capF')
                    ->andWhere('av5.attribute = 6 AND av5.value <= :capT')
                    ->setParameter('capF', $filters['capF'], ParameterType::INTEGER)
                    ->setParameter('capT', $filters['capT'], ParameterType::INTEGER);

            }
            if ($filters['milF'] < $filters['milT']) {
                $q->leftJoin(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                    ->andWhere('av6.attribute = 9 AND av6.value >= :milF')
                    ->andWhere('av6.attribute = 9 AND av6.value <= :milT')
                    ->setParameter('milF', $filters['milF'], ParameterType::INTEGER)
                    ->setParameter('milT', $filters['milT'], ParameterType::INTEGER);

            }
            if ($filters['powF'] < $filters['powT']) {
                $q->leftJoin(AttributeValue::class, 'av7', Join::WITH, 'av7.offer = o.id')
                    ->andWhere('av7.attribute = 8 AND av7.value >= :powF')
                    ->andWhere('av7.attribute = 8 AND av7.value <= :powT')
                    ->setParameter('powF', $filters['powF'], ParameterType::INTEGER)
                    ->setParameter('powT', $filters['powT'], ParameterType::INTEGER);

            }
            if ($filters['fuel'] > 0) {
                $q->Join(AttributeValue::class, 'av8', Join::WITH, 'av8.offer = o.id')
                    ->andWhere('av8.attribute = 7 AND av8.value = :fuel')
                    ->setParameter('fuel', $filters['fuel'], ParameterType::INTEGER);
            }
            if ($filters['sizeF'] < $filters['sizeT']) {
                $q->leftJoin(AttributeValue::class, 'av16', Join::WITH, 'av16.offer = o.id')
                    ->andWhere('av16.attribute = 22 AND av16.value >= :sizeF')
                    ->andWhere('av16.attribute = 22 AND av16.value <= :sizeT')
                    ->setParameter('sizeF', $filters['sizeF'], ParameterType::INTEGER)
                    ->setParameter('sizeT', $filters['sizeT'], ParameterType::INTEGER);

            }
            if ($filters['axisF'] < $filters['axisT']) {
                $q->leftJoin(AttributeValue::class, 'av17', Join::WITH, 'av17.offer = o.id')
                    ->andWhere('av17.attribute = 23 AND av17.value >= :axisF')
                    ->andWhere('av17.attribute = 23 AND av17.value <= :axisT')
                    ->setParameter('axisF', $filters['axisF'], ParameterType::INTEGER)
                    ->setParameter('axisT', $filters['axisT'], ParameterType::INTEGER);

            }
            if ($filters['gearbox'] > 0) {
                $q->Join(AttributeValue::class, 'av9', Join::WITH, 'av9.offer = o.id')
                    ->andWhere('av9.attribute = 13 AND av9.value = :gearbox')
                    ->setParameter('gearbox', $filters['gearbox'], ParameterType::INTEGER);
            }
            if ($filters['country'] > 0) {
                $q->Join(AttributeValue::class, 'av11', Join::WITH, 'av11.offer = o.id')
                    ->andWhere('av11.attribute = 14 AND av11.value = :country')
                    ->setParameter('country', $filters['country'], ParameterType::INTEGER);
            }
        }
        if($cat == 20){
            if ($filters['milF'] < $filters['milT']) {
                $q->leftJoin(AttributeValue::class, 'av18', Join::WITH, 'av18.offer = o.id')
                    ->andWhere('av18.attribute = 9 AND av18.value >= :milF')
                    ->andWhere('av18.attribute = 9 AND av18.value <= :milT')
                    ->setParameter('milF', $filters['milF'], ParameterType::INTEGER)
                    ->setParameter('milT', $filters['milT'], ParameterType::INTEGER);

            }
        }
        if ($filters['yearF'] < $filters['yearT']) {
            $q->leftJoin(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 5 AND av4.value >= :yearF')
                ->andWhere('av4.attribute = 5 AND av4.value <= :yearT')
                ->setParameter('yearF', $filters['yearF'], ParameterType::INTEGER)
                ->setParameter('yearT', $filters['yearT'], ParameterType::INTEGER);

        }
        if ($filters['condition'] > 0) {
            $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                ->andWhere('av14.attribute = 12 AND av14.value = :condition')
                ->setParameter('condition', $filters['condition'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByChildVansTrucksCriteria1(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if ($filters['yearF'] < $filters['yearT']) {
            $q->leftJoin(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 5 AND av4.value >= :yearF')
                ->andWhere('av4.attribute = 5 AND av4.value <= :yearT')
                ->setParameter('yearF', $filters['yearF'], ParameterType::INTEGER)
                ->setParameter('yearT', $filters['yearT'], ParameterType::INTEGER);

        }
        if ($filters['capF'] < $filters['capT']) {
            $q->leftJoin(AttributeValue::class, 'av5', Join::WITH, 'av5.offer = o.id')
                ->andWhere('av5.attribute = 6 AND av5.value >= :capF')
                ->andWhere('av5.attribute = 6 AND av5.value <= :capT')
                ->setParameter('capF', $filters['capF'], ParameterType::INTEGER)
                ->setParameter('capT', $filters['capT'], ParameterType::INTEGER);

        }
        if ($filters['milF'] < $filters['milT']) {
            $q->leftJoin(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                ->andWhere('av6.attribute = 9 AND av6.value >= :milF')
                ->andWhere('av6.attribute = 9 AND av6.value <= :milT')
                ->setParameter('milF', $filters['milF'], ParameterType::INTEGER)
                ->setParameter('milT', $filters['milT'], ParameterType::INTEGER);

        }
        if ($filters['powF'] < $filters['powT']) {
            $q->leftJoin(AttributeValue::class, 'av7', Join::WITH, 'av7.offer = o.id')
                ->andWhere('av7.attribute = 8 AND av7.value >= :powF')
                ->andWhere('av7.attribute = 8 AND av7.value <= :powT')
                ->setParameter('powF', $filters['powF'], ParameterType::INTEGER)
                ->setParameter('powT', $filters['powT'], ParameterType::INTEGER);

        }
        if ($filters['fuel'] > 0) {
            $q->Join(AttributeValue::class, 'av8', Join::WITH, 'av8.offer = o.id')
                ->andWhere('av8.attribute = 7 AND av8.value = :fuel')
                ->setParameter('fuel', $filters['fuel'], ParameterType::INTEGER);
        }

        if ($filters['gearbox'] > 0) {
            $q->Join(AttributeValue::class, 'av9', Join::WITH, 'av9.offer = o.id')
                ->andWhere('av9.attribute = 13 AND av9.value = :gearbox')
                ->setParameter('gearbox', $filters['gearbox'], ParameterType::INTEGER);
        }
        if ($filters['country'] > 0) {
            $q->Join(AttributeValue::class, 'av11', Join::WITH, 'av11.offer = o.id')
                ->andWhere('av11.attribute = 14 AND av11.value = :country')
                ->setParameter('country', $filters['country'], ParameterType::INTEGER);
        }
        if ($filters['condition'] > 0) {
            $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                ->andWhere('av14.attribute = 12 AND av14.value = :condition')
                ->setParameter('condition', $filters['condition'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByChildPartsCarsCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('av.attribute = 25 AND av.value = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if($cat != 5){
            if ($filters['typeParts'] > 0) {
                $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                    ->andWhere('av14.attribute = 26 AND av14.value = :typeParts')
                    ->setParameter('typeParts', $filters['typeParts'], ParameterType::INTEGER);
            }
            if ($filters['state'] > 0) {
                $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                    ->andWhere('av4.attribute = 12 AND av4.value = :state')
                    ->setParameter('state', $filters['state'], ParameterType::INTEGER);
            }
        }

        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }


        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByChildPartsCarsCriteria1(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['typeParts'] > 0) {
            $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                ->andWhere('av14.attribute = 26 AND av14.value = :typeParts')
                ->setParameter('typeParts', $filters['typeParts'], ParameterType::INTEGER);
        }
        if ($filters['state'] > 0) {
            $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 12 AND av4.value = :state')
                ->setParameter('state', $filters['state'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByChildPartsMotorsCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['typeParts'] > 0) {
            $q->Join(AttributeValue::class, 'av14', Join::WITH, 'av14.offer = o.id')
                ->andWhere('av14.attribute = 26 AND av14.value = :typeParts')
                ->setParameter('typeParts', $filters['typeParts'], ParameterType::INTEGER);
        }
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if ($filters['state'] > 0) {
            $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 28 AND av4.value = :state')
                ->setParameter('state', $filters['state'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByChildTiresCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('av.attribute = 21 AND av.value = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);
        }
        if ($filters['state'] > 0) {
            $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 28 AND av4.value = :state')
                ->setParameter('state', $filters['state'], ParameterType::INTEGER);
        }
        if ($filters['vehicleType'] > 0) {
            $q->Join(AttributeValue::class, 'av5', Join::WITH, 'av5.offer = o.id')
                ->andWhere('av5.attribute = 29 AND av5.value = :vehicleType')
                ->setParameter('vehicleType', $filters['vehicleType'], ParameterType::INTEGER);
        }
        if($cat == 6 || $cat == 7 || $cat == 8){
            if($cat == 6){
                if ($filters['typeTires'] > 0) {
                    $q->Join(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                        ->andWhere('av6.attribute = 30 AND av6.value = :typeTires')
                        ->setParameter('typeTires', $filters['typeTires'], ParameterType::INTEGER);
                }
                if ($filters['inch'] > 0) {
                    $q->Join(AttributeValue::class, 'av7', Join::WITH, 'av7.offer = o.id')
                        ->andWhere('av7.attribute = 31 AND av7.value = :inch')
                        ->setParameter('inch', $filters['inch'], ParameterType::INTEGER);
                }
                if ($filters['widthTires'] > 0) {
                    $q->Join(AttributeValue::class, 'av8', Join::WITH, 'av8.offer = o.id')
                        ->andWhere('av8.attribute = 32 AND av8.value = :widthTires')
                        ->setParameter('widthTires', $filters['widthTires'], ParameterType::INTEGER);
                }
                if ($filters['profilTires'] > 0) {
                    $q->Join(AttributeValue::class, 'av9', Join::WITH, 'av9.offer = o.id')
                        ->andWhere('av9.attribute = 33 AND av9.value = :profilTires')
                        ->setParameter('profilTires', $filters['profilTires'], ParameterType::INTEGER);
                }
            }
            if($cat == 7){
                if ($filters['typeRims'] > 0) {
                    $q->Join(AttributeValue::class, 'av10', Join::WITH, 'av10.offer = o.id')
                        ->andWhere('av10.attribute = 34 AND av10.value = :typeRims')
                        ->setParameter('typeRims', $filters['typeRims'], ParameterType::INTEGER);
                }
            }
            if($cat == 8){
                if ($filters['typeRims'] > 0) {
                    $q->Join(AttributeValue::class, 'av11', Join::WITH, 'av11.offer = o.id')
                        ->andWhere('av11.attribute = 34 AND av11.value = :typeRims')
                        ->setParameter('typeRims', $filters['typeRims'], ParameterType::INTEGER);
                }
                if ($filters['typeTires'] > 0) {
                    $q->Join(AttributeValue::class, 'av12', Join::WITH, 'av12.offer = o.id')
                        ->andWhere('av12.attribute = 30 AND av12.value = :typeTires')
                        ->setParameter('typeTires', $filters['typeTires'], ParameterType::INTEGER);
                }
            }

        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByChildTiresCriteria1(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);
        }
        if ($filters['state'] > 0) {
            $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 28 AND av4.value = :state')
                ->setParameter('state', $filters['state'], ParameterType::INTEGER);
        }
        if ($filters['vehicleType'] > 0) {
            $q->Join(AttributeValue::class, 'av5', Join::WITH, 'av5.offer = o.id')
                ->andWhere('av5.attribute = 29 AND av5.value = :vehicleType')
                ->setParameter('vehicleType', $filters['vehicleType'], ParameterType::INTEGER);
        }
        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findByChildTrailersCriteria(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('av.attribute = 21 AND av.value = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['yearF'] < $filters['yearT']) {
            $q->leftJoin(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 5 AND av4.value >= :yearF')
                ->andWhere('av4.attribute = 5 AND av4.value <= :yearT')
                ->setParameter('yearF', $filters['yearF'], ParameterType::INTEGER)
                ->setParameter('yearT', $filters['yearT'], ParameterType::INTEGER);

        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if ($filters['condition'] > 0) {
            $q->Join(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                ->andWhere('av6.attribute = 12 AND av6.value = :condition')
                ->setParameter('condition', $filters['condition'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findByChildTrailersCriteria1(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($filters['location'] > 0) {
            $q->Join(AttributeValue::class, 'av1', Join::WITH, 'av1.offer = o.id')
                ->andWhere('av.attribute = 17 AND av.value = :val')
                ->setParameter('val', $filters['location'], ParameterType::INTEGER);
        }
        if ($filters['yearF'] < $filters['yearT']) {
            $q->leftJoin(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                ->andWhere('av4.attribute = 5 AND av4.value >= :yearF')
                ->andWhere('av4.attribute = 5 AND av4.value <= :yearT')
                ->setParameter('yearF', $filters['yearF'], ParameterType::INTEGER)
                ->setParameter('yearT', $filters['yearT'], ParameterType::INTEGER);

        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }
        if ($filters['condition'] > 0) {
            $q->Join(AttributeValue::class, 'av6', Join::WITH, 'av6.offer = o.id')
                ->andWhere('av6.attribute = 12 AND av6.value = :condition')
                ->setParameter('condition', $filters['condition'], ParameterType::INTEGER);
        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findByLatestCategories(int $cat, array $filters): ?array
    {
        $q = $this->createQueryBuilder('o')
            ->Join(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->Where('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER);
        if ($cat == 8){
            if ($filters['state'] > 0) {
                $q->Join(AttributeValue::class, 'av4', Join::WITH, 'av4.offer = o.id')
                    ->andWhere('av4.attribute = 28 AND av4.value = :state')
                    ->setParameter('state', $filters['state'], ParameterType::INTEGER);
            }
        }
        if ($filters['priceF'] < $filters['priceT']) {
            $q->leftJoin(AttributeValue::class, 'av3', Join::WITH, 'av3.offer = o.id')
                ->andWhere('av3.attribute = 2 AND av3.value >= :priceF')
                ->andWhere('av3.attribute = 2 AND av3.value <= :priceT')
                ->setParameter('priceF', $filters['priceF'], ParameterType::INTEGER)
                ->setParameter('priceT', $filters['priceT'], ParameterType::INTEGER);

        }

        return $q->orderBy('o.uploadedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByAllLikeOffers(int $attr, int $cat, int $offer): ?array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.uploadedAt', 'DESC')
            ->leftJoin(AttributeValue::class, 'av', Join::WITH, 'av.offer = o.id')
            ->where('av.attribute = 17 AND av.value = :attr')
            ->setParameter('attr', $attr, ParameterType::INTEGER)
            ->andWhere('o.category = :cat')
            ->setParameter('cat', $cat, ParameterType::INTEGER)
            ->andWhere('o.id != :offer')
            ->setParameter('offer', $offer, ParameterType::INTEGER)
            ->getQuery()
            ->getResult();
    }
}
