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
     * Метод возвращает имя действия
     * @return string
     */
    public abstract function getName(): string;

    /**
     * Метод возвращает внутреннее имя действия
     * @return string
     */
    public abstract function getInnerName(): string;

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
    public abstract static function checkingRights(int $idImplement,int $idCustomer,int $idUser) : bool;

}
