<?php


namespace Lobochkin\TaskForce;


class Cancel extends Action
{
    /**
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     * @inheritDoc
     */
    public static function checkingRights(int $idImplement, int $idCustomer, int $idUser): bool
    {
        return $idCustomer === $idUser;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Отменить';
    }

    /**
     * @inheritDoc
     */
    public function getInnerName(): string
    {
        return 'cancel';
    }
}
