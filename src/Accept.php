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
