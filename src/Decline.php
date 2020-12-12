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
    public function checkingRights(int $idImplement, int $idCustomer, int $idUser): bool
    {
        return $idImplement === $idUser;
    }
}
