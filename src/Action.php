<?php


namespace Lobochkin\TaskForce;

/**
 *
 * Class Action
 * @package Lobochkin\TaskForce
 */
abstract class Action
{
    /**
     * @var string Внешнее имя действия
     */
    protected $name;

    /**
     * @var string Внутреннее имя действия
     */
    protected $innerName;

    public function getName(): string
    {
        return $this->name;
    }
    public function getInnerName(): string
    {
        return $this->innerName;
    }

    public function __toString()
    {
        return get_class($this);
    }

    /**
     * метод для праверки прав на действие
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return boolean
     */
    public abstract function checkingRights(int $idImplement,int $idCustomer,int $idUser) : bool;

}
