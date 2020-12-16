<?php


namespace Lobochkin\TaskForce;


class Decline extends Action
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
        return $idImplement === $idUser;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Отказаться';
    }

    /**
     * @inheritDoc
     */
    public function getInnerName(): string
    {
        return 'decline';
    }
}
