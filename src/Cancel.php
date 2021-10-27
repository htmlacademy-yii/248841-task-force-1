<?php


namespace Lobochkin\TaskForce;


class Cancel extends Action
{
    /**
     * @param int|null $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     */
    public static function checkingRights(?int $idImplement, int $idCustomer, int $idUser): bool
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
    public static function getInnerName(): string
    {
        return 'cancel';
    }
}
