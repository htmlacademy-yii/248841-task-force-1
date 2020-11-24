<?php


namespace TaskForce;


use http\QueryString;

class Task
{
    // Стастусы задания
    const STATUS_NEW = 'new'; // Новое
    const STATUS_IN_WORK= 'in_work'; // В работе
    const STATUS_DONE = 'done'; // Выполнено
    const STATUS_FAILED = 'failed'; // Провалено
    const STATUS_CANCEL = 'cancel'; // Отменено
    // Действия с заданием
    const ACTION_CANCEL = 'cancel_task'; // Отменить задание( Заказчик)
    const ACTION_ANSWER = 'answer'; // Откликнуться на задание(Исполнитель)
    const ACTION_FINISHED = 'finished'; //  Задание выполнено(Заказчик)
    const ACTION_DECLINE = 'decline'; // Отказаться от задания(Исполнитель)
    const ACTION_ACCEPT = 'accept'; // Принять отклик от исполнителя(Заказчик)

    protected $arMapActionAndStatus = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено',
        self::STATUS_CANCEL => 'Отменено',
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_ANSWER => 'Откликнуться',
        self::ACTION_FINISHED => 'Выполнено',
        self::ACTION_DECLINE => 'Отказаться',
        self::ACTION_ACCEPT => 'Принять'
    ];
    protected $arNextActionAndNextStatus = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_ANSWER => null,
        self::ACTION_FINISHED => self::STATUS_DONE,
        self::ACTION_DECLINE => self::STATUS_FAILED,
        self::ACTION_ACCEPT => self::STATUS_IN_WORK,
        self::STATUS_NEW => [
            'implementer' => self::ACTION_ANSWER,
            'customer' => self::ACTION_CANCEL
        ],
        self::STATUS_IN_WORK => [
            'implementer' => self::ACTION_DECLINE,
            'customer' => self::ACTION_FINISHED
        ],
        self::STATUS_DONE => null,
        self::STATUS_FAILED => null,
        self::STATUS_CANCEL => null,
    ];
    public $strUser = ''; // Исполнитель или Заказчик implementer|customer

    protected $intIdTask = null;
    protected $intIdStatus = null;

    public function __construct(int $intIdTask,int $intIdStatus)
    {
        $this->intIdTask = $intIdTask;
        $this->intIdStatus = $intIdStatus;
    }

    /**
     * @param string $action
     * @return string|null
     */
    public function getNextStatus(string $action)
    {
        if(strlen($action) < 1){
            return null;
        }
        return $this->arNextActionAndNextStatus[$action];
    }

    /**
     * @param string $status
     * @return string|null
     */
    public function getNextAction(string $status)
    {
        if(strlen($status) < 1){
            return null;
        }
        return $this->arNextActionAndNextStatus[$status][$this->strUser];
    }
}

