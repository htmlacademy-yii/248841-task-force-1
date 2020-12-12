<?php


namespace Lobochkin\TaskForce;


class Cancel extends Action
{
    protected $name = 'Отменить';
    protected $innerName = 'cancel';

    /**
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     * @inheritDoc
     */
    public function checkingRights(int $idImplement, int $idCustomer, int $idUser): bool
    {
        return $idCustomer === $idUser;
    }
}
