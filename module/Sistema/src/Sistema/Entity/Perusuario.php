<?php

namespace Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perusuario
 *
 * @ORM\Table(name="perusuario", indexes={@ORM\Index(name="IDX_524BD0CBAE0A7C87", columns={"npercodigo"})})
 * @ORM\Entity(repositoryClass="Sistema\Repository\PerusuarioRepository")
 */
class Perusuario {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nperusucodigo", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="SEQUENCE")
	 * @ORM\SequenceGenerator(sequenceName="perusuario_nperusucodigo_seq", allocationSize=1, initialValue=1)
	 */
	private $nperusucodigo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cperusuname", type="string", length=100, nullable=false)
	 */
	private $cperusuname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cperusuclave", type="string", length=50, nullable=false)
	 */
	private $cperusuclave;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nperusuestado", type="integer", nullable=false)
	 */
	private $nperusuestado;

	/**
	 * @var \Sistema\Entity\Persona
	 *
	 * @ORM\ManyToOne(targetEntity="Sistema\Entity\Persona", inversedBy="perusuarios")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="npercodigo", referencedColumnName="npercodigo")
	 * })
	 */
	private $persona;

	/**
	 * @ORM\ManyToOne(targetEntity="Sistema\Entity\Rol", inversedBy="perusuarios")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="nrolcodigo", referencedColumnName="nrolcodigo", nullable=true)
	 * })
	 */
	protected $rol;

	/**
	 * @var  \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\OneToMany(targetEntity="Sistema\Entity\Perusuacceso", mappedBy="perusuario")
	 */
	protected $perusuaccesos;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->perusuaccesos = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get nperusucodigo
	 *
	 * @return integer
	 */
	public function getNperusucodigo() {
		return $this->nperusucodigo;
	}

	/**
	 * Set cperusuname
	 *
	 * @param string $cperusuname
	 * @return Perusuario
	 */
	public function setCperusuname($cperusuname) {
		$this->cperusuname = $cperusuname;

		return $this;
	}

	/**
	 * Get cperusuname
	 *
	 * @return string
	 */
	public function getCperusuname() {
		return $this->cperusuname;
	}

	/**
	 * Set cperusuclave
	 *
	 * @param string $cperusuclave
	 * @return Perusuario
	 */
	public function setCperusuclave($cperusuclave) {
		$this->cperusuclave = $cperusuclave;

		return $this;
	}

	/**
	 * Get cperusuclave
	 *
	 * @return string
	 */
	public function getCperusuclave() {
		return $this->cperusuclave;
	}

	/**
	 * Set nperusuestado
	 *
	 * @param integer $nperusuestado
	 * @return Perusuario
	 */
	public function setNperusuestado($nperusuestado) {
		$this->nperusuestado = $nperusuestado;

		return $this;
	}

	/**
	 * Get nperusuestado
	 *
	 * @return integer
	 */
	public function getNperusuestado() {
		return $this->nperusuestado;
	}

	/**
	 * Set persona
	 *
	 * @param \Sistema\Entity\Persona $persona
	 * @return Perusuario
	 */
	public function setPersona(\Sistema\Entity\Persona $persona = null) {
		$this->persona = $persona;

		return $this;
	}

	/**
	 * Get persona
	 *
	 * @return \Sistema\Entity\Persona
	 */
	public function getPersona() {
		return $this->persona;
	}

	/**
	 * Set rol
	 *
	 * @param \Sistema\Entity\Rol $rol
	 * @return Perusuario
	 */
	public function setRol(\Sistema\Entity\Rol $rol = null) {
		$this->rol = $rol;

		return $this;
	}

	/**
	 * Get rol
	 *
	 * @return \Sistema\Entity\Rol
	 */
	public function getRol() {
		return $this->rol;
	}

	/**
	 * Add perusuaccesos
	 *
	 * @param \Sistema\Entity\Perusuacceso $perusuaccesos
	 * @return Perusuario
	 */
	public function addPerusuacceso(\Sistema\Entity\Perusuacceso $perusuaccesos) {
		$this->perusuaccesos[] = $perusuaccesos;

		return $this;
	}

	/**
	 * Remove perusuaccesos
	 *
	 * @param \Sistema\Entity\Perusuacceso $perusuaccesos
	 */
	public function removePerusuacceso(\Sistema\Entity\Perusuacceso $perusuaccesos) {
		$this->perusuaccesos->removeElement($perusuaccesos);
	}

	/**
	 * Get perusuaccesos
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPerusuaccesos() {
		return $this->perusuaccesos;
	}
}
