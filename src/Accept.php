<?php


namespace Lobochkin\TaskForce;


class Accept extends Action
{
    protected $name = 'Принять';
    protected $innerName = 'accept';

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
