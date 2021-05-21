<?php


namespace Lobochkin\TaskForce;


class Finished extends Action
{
    /**
     * @param int|null $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     * @inheritDoc
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
        return 'Выполнено';
    }

    /**
     * @inheritDoc
     */
    public static function getInnerName(): string
    {
        return Task::ACTION_FINISHED;
    }
}
