<?php

namespace Sistema\Repository;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends EntityRepository {
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
		$qb->select('m')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->leftJoin('m.padre', 'p')
		   ->where('m.nmenestado != :nmenestado')
		   ->orderBy('m.cmenjerarquia', 'ASC')
		   ->setParameter('nmenestado', 0);

		return $this->addFiltro($qb, $campos, $paginacion)->getResult();
	}

	public function getPaginador($campos, $paginacion) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('m')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->leftJoin('m.padre', 'p')
		   ->where('m.nmenestado != :nmenestado')
		   ->orderBy('m.cmenjerarquia', 'ASC')
		   ->setParameter('nmenestado', 0);

		$query = $this->addFiltro($qb, $campos, $paginacion);

		$adapter = new DoctrineAdapter(new ORMPaginator($query));
		$paginator = new Paginator($adapter);
		$paginator->setDefaultItemCountPerPage($paginacion['items']);
		$paginator->setCurrentPageNumber($paginacion['pagina']);

		return $paginator;
	}

	public function buscarUltimoOrden() {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('m.cmenjerarquia')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->orderBy('m.cmenjerarquia', 'DESC')
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

	public function buscarMenoresParaOrdenar($cmenjerarquiaMay, $cmenjerarquiaMin) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('m')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->where('m.cmenjerarquia > :cmenjerarquiaMin')
		   ->andWhere('m.cmenjerarquia <= :cmenjerarquiaMay')
		   ->setParameter('cmenjerarquiaMay', $cmenjerarquiaMay)
		   ->setParameter('cmenjerarquiaMin', $cmenjerarquiaMin);

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function buscarMayoresParaOrdenar($cmenjerarquiaMin, $cmenjerarquiaMay) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('m')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->where('m.cmenjerarquia >= :cmenjerarquiaMin')
		   ->andWhere('m.cmenjerarquia < :cmenjerarquiaMay')
		   ->setParameter('cmenjerarquiaMin', $cmenjerarquiaMin)
		   ->setParameter('cmenjerarquiaMay', $cmenjerarquiaMay);

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function buscarSiExisteContenido($nmencodigo, $tipocontenido) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('count(m)')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->where('m.nmencodigo = :nmencodigo')
		   ->setParameter('nmencodigo', $nmencodigo);

		switch ($tipocontenido) {
			case 1:
				$qb->leftJoin('m.htmls', 'h')
				   ->andWhere('h.nhtmlestado != :nhtmlestado')
				   ->setParameter('nhtmlestado', 0);
				break;

			case 2:
				$qb->leftJoin('m.pdfs', 'p')
				   ->andWhere('p.npdfestado != :npdfestado')
				   ->setParameter('npdfestado', 0);
				break;

			case 3:
				$qb->leftJoin('m.urls', 'u')
				   ->andWhere('u.nurlestado != :nurlestado')
				   ->setParameter('nurlestado', 0);
				break;
		}

		$query = $qb->getQuery();
		$result = $query->getSingleScalarResult();

		if ($result == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function buscarPorNivel($nnivmencodigo) {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('m')
		   ->from('Sistema\Entity\Menu', 'm')
		   ->innerJoin('m.nivelmenu', 'nm')
		   ->where('m.nmenestado != :nmenestado')
		   ->andWhere('nm.nnivmencodigo = :nnivmencodigo')
		   ->orderBy('m.cmenjerarquia')
		   ->setParameter('nmenestado', 0)
		   ->setParameter('nnivmencodigo', $nnivmencodigo);

		if ($nnivmencodigo == 2) {
			$qb->andWhere('m.padre IS NULL');
		}

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function enviarEstado($nmencodigo) {
		$menu = $this->find($nmencodigo);
		$tipocontenido = $menu->getTipocontenido();

		$qb = $this->_em->createQueryBuilder();
		$qb->from('Sistema\Entity\Menu', 'm')
		   ->where('m.nmencodigo = :nmencodigo')
		   ->setParameter('nmencodigo', $nmencodigo);

		if ($tipocontenido) {
			switch ($tipocontenido->getNtipconcodigo()) {
				case 1:
					$qb->select('h.nhtmlestado AS estado')
					   ->innerJoin('m.htmls', 'h')
					   ->andWhere('h.nhtmlestado != :nhtmlestado')
					   ->setParameter('nhtmlestado', 0);
					break;

				case 2:
					$qb->select('p.npdfestado AS estado')
					   ->innerJoin('m.pdfs', 'p')
					   ->andWhere('p.npdfestado != :npdfestado')
					   ->setParameter('npdfestado', 0);
					break;

				case 3:
					$qb->select('u.nurlestado AS estado')
					   ->innerJoin('m.urls', 'u')
					   ->andWhere('u.nurlestado != :nurlestado')
					   ->setParameter('nurlestado', 0);
					break;
			}

			$query = $qb->getQuery();
			$result = $query->getOneOrNullResult();

			if ($result) {
				return $result['estado'];
			} else {
				return 1;
			}

		} else {
			return 1;
		}
	}

	public function buscarHabilitados() {
		$qb = $this->_em->createQueryBuilder()
		           ->select('m')
		           ->from('Sistema\Entity\Menu', 'm')
		           ->where('m.nmenestado = 1')
		           ->orderBy('m.cmenjerarquia');

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function buscarHabilitadosPorNivel($nnivmencodigo) {
		$qb = $this->_em->createQueryBuilder()
		           ->select('m')
		           ->from('Sistema\Entity\Menu', 'm')
		           ->innerJoin('m.nivelmenu', 'nm')
		           ->where('nm.nnivmencodigo = :nnivmencodigo')
		           ->andWhere('m.nmenestado = 1')
		           ->orderBy('m.cmenjerarquia')
		           ->setParameter('nnivmencodigo', $nnivmencodigo);

		$query = $qb->getQuery();
		return $query->getResult();
	}

	public function buscarHabilitadosPorNivelSinPadre($nnivmencodigo) {
		$qb = $this->_em->createQueryBuilder()
		           ->select('m')
		           ->from('Sistema\Entity\Menu', 'm')
		           ->innerJoin('m.nivelmenu', 'nm')
		           ->where('nm.nnivmencodigo = :nnivmencodigo')
		           ->andWhere('m.padre IS NULL')
		           ->andWhere('m.nmenestado = 1')
		           ->orderBy('m.cmenjerarquia')
		           ->setParameter('nnivmencodigo', $nnivmencodigo);

		$query = $qb->getQuery();
		return $query->getResult();
	}
}
