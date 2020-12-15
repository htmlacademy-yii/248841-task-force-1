<?php


namespace Lobochkin\TaskForce;


class Finished extends Action
{
    protected $name = 'Выполнено';
    protected $innerName = 'finished';

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
