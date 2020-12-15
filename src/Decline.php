<?php


namespace Lobochkin\TaskForce;


class Decline extends Action
{
    protected $name = 'Отказаться';
    protected $innerName = 'decline';

    /**
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     * @inheritDoc
     */
    public static function checkingRights(int $idImplement, int $idCustomer, int $idUser): bool
    {
        return $idImplement === $idUser;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getInnerName(): string
    {
        return $this->innerName;
    }
}
