<?php

namespace DoctrineORMModule\Proxy\__CG__\Sistema\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Rol extends \Sistema\Entity\Rol implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'nrolcodigo', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'crolnombre', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'croldescripcion', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'nrolestado', 'rolcontrols', 'perusuarios');
        }

        return array('__isInitialized__', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'nrolcodigo', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'crolnombre', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'croldescripcion', '' . "\0" . 'Sistema\\Entity\\Rol' . "\0" . 'nrolestado', 'rolcontrols', 'perusuarios');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Rol $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getNrolcodigo()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getNrolcodigo();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNrolcodigo', array());

        return parent::getNrolcodigo();
    }

    /**
     * {@inheritDoc}
     */
    public function setCrolnombre($crolnombre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCrolnombre', array($crolnombre));

        return parent::setCrolnombre($crolnombre);
    }

    /**
     * {@inheritDoc}
     */
    public function getCrolnombre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCrolnombre', array());

        return parent::getCrolnombre();
    }

    /**
     * {@inheritDoc}
     */
    public function setCroldescripcion($croldescripcion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCroldescripcion', array($croldescripcion));

        return parent::setCroldescripcion($croldescripcion);
    }

    /**
     * {@inheritDoc}
     */
    public function getCroldescripcion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCroldescripcion', array());

        return parent::getCroldescripcion();
    }

    /**
     * {@inheritDoc}
     */
    public function setNrolestado($nrolestado)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNrolestado', array($nrolestado));

        return parent::setNrolestado($nrolestado);
    }

    /**
     * {@inheritDoc}
     */
    public function getNrolestado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNrolestado', array());

        return parent::getNrolestado();
    }

    /**
     * {@inheritDoc}
     */
    public function addRolcontrol(\Sistema\Entity\Rolcontrol $rolcontrols)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRolcontrol', array($rolcontrols));

        return parent::addRolcontrol($rolcontrols);
    }

    /**
     * {@inheritDoc}
     */
    public function removeRolcontrol(\Sistema\Entity\Rolcontrol $rolcontrols)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeRolcontrol', array($rolcontrols));

        return parent::removeRolcontrol($rolcontrols);
    }

    /**
     * {@inheritDoc}
     */
    public function getRolcontrols()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRolcontrols', array());

        return parent::getRolcontrols();
    }

    /**
     * {@inheritDoc}
     */
    public function addPerusuario(\Sistema\Entity\Perusuario $perusuarios)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPerusuario', array($perusuarios));

        return parent::addPerusuario($perusuarios);
    }

    /**
     * {@inheritDoc}
     */
    public function removePerusuario(\Sistema\Entity\Perusuario $perusuarios)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePerusuario', array($perusuarios));

        return parent::removePerusuario($perusuarios);
    }

    /**
     * {@inheritDoc}
     */
    public function getPerusuarios()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerusuarios', array());

        return parent::getPerusuarios();
    }

}
