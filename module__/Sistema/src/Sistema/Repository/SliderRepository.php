<?php

namespace Sistema\Repository;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

/**
 * SliderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SliderRepository extends EntityRepository {
	public function addFiltro($qb, $campos, $paginacion) {
		$expr = $qb->expr();
		$andX = $expr->andX();

		foreach ($campos as $columna => $valor) {
			if (strpos($columna, '-') !== false) {
				$colSeparadas = explode('-', $columna);

				$orX = $qb->expr()->orX();
				for ($i = 0; $i < count($colSeparadas); $i++) {
					$parametro = substr($colSeparadas[$i], strpos($colSeparadas[$i], '.') + 1);
					$orX->add($expr->like($colSeparadas[$i], ':' . $parametro));
					$qb->setParameter($parametro, '%' . $valor . '%');

					switch (true) {
						case ($i === 0):
							$concat = $qb->expr()->concat($colSeparadas[$i], $qb->expr()->literal(' '));
							break;
						case ($i < count($colSeparadas) - 1):
							$concat = $qb->expr()->concat($concat, $qb->expr()->concat($colSeparadas[$i], $qb->expr()->literal(' ')));
							break;
						case ($i === count($colSeparadas) - 1):
							$concat = $qb->expr()->concat($concat, $colSeparadas[$i]);
							break;
					}
				}

				$orX->add($expr->like($concat, ':concat'));
				$qb->setParameter('concat', '%' . $valor . '%');
				$andX->add($orX);
			} else {
				$parametro = substr($columna, strpos($columna, '.') + 1);
				$andX->add($expr->like($columna, ':' . $parametro));
				$qb->setParameter($parametro, '%' . $valor . '%');
			}

		}
		$qb->andWhere($andX);

		if ($paginacion) {
			$qb->setFirstResult($paginacion['inicio']);
			$qb->setMaxResults($paginacion['items']);
		}

		$query = $qb->getQuery();
		return $query;
	}

	public function buscar($campos, $paginacion) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('s')
		   ->from('Sistema\Entity\Slider', 's')
		   ->where('s.nsliestado != :nsliestado')
		   ->orderBy('s.cslijerrarquia', 'ASC')
		   ->setParameter('nsliestado', 0);

		return $this->addFiltro($qb, $campos, $paginacion)->getResult();
	}

	public function getPaginador($campos, $paginacion) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('s')
		   ->from('Sistema\Entity\Slider', 's')
		   ->where('s.nsliestado != :nsliestado')
		   ->orderBy('s.cslijerrarquia', 'ASC')
		   ->setParameter('nsliestado', 0);

		$query = $this->addFiltro($qb, $campos, $paginacion);

		$adapter = new DoctrineAdapter(new ORMPaginator($query));
		$paginator = new Paginator($adapter);
		$paginator->setDefaultItemCountPerPage($paginacion['items']);
		$paginator->setCurrentPageNumber($paginacion['pagina']);

		return $paginator;
	}

	public function buscarUltimoOrden() {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('s.cslijerrarquia')
		   ->from('Sistema\Entity\Slider', 's')
		   ->orderBy('s.cslijerrarquia', 'DESC')
		   ->setFirstResult(0)
		   ->setMaxResults(1);

		$query = $qb->getQuery();
		$tempResult = $query->getResult();
		if (!empty($tempResult)) {
			$result = $query->getSingleScalarResult();
		} else {
			$result = 0;
		}

		return $result;
	}

	public function buscarMenoresParaOrdenar($cslijerrarquiaMay, $cslijerrarquiaMin) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('s')
		   ->from('Sistema\Entity\Slider', 's')
		   ->where('s.cslijerrarquia > :cslijerrarquiaMin')
		   ->andWhere('s.cslijerrarquia <= :cslijerrarquiaMay')
		   ->setParameter('cslijerrarquiaMay', $cslijerrarquiaMay)
		   ->setParameter('cslijerrarquiaMin', $cslijerrarquiaMin);

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function buscarMayoresParaOrdenar($cslijerrarquiaMin, $cslijerrarquiaMay) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('s')
		   ->from('Sistema\Entity\Slider', 's')
		   ->where('s.cslijerrarquia >= :cslijerrarquiaMin')
		   ->andWhere('s.cslijerrarquia < :cslijerrarquiaMay')
		   ->setParameter('cslijerrarquiaMin', $cslijerrarquiaMin)
		   ->setParameter('cslijerrarquiaMay', $cslijerrarquiaMay);

		$query = $qb->getQuery();
		return $query->getResult();
	}
}
