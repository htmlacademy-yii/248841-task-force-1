<?php


namespace Lobochkin\TaskForce;


use SplFileObject;

class ReadCsvAndCreateSql
{
    protected $fileName;
    const PATH = '/data/';
    protected $dirName;
    const NAME_BD = 'taskforce';

    /**
     * ReadCsvAndCreateSql constructor.
     * @param string $name
     */

    function __construct(string $name)
    {
        $this->fileName = $name;
        $this->dirName = $_SERVER['DOCUMENT_ROOT'] . self::PATH;
    }

    public function convertStringCsv(): string
    {
        $fullName = $this->dirName . $this->fileName . ".csv";

        if (!file_exists($fullName)) {
            throw new \Exception("Файла {$fullName} не существует");
        }

        $file = new SplFileObject($fullName);
        $file->setFlags(SplFileObject::READ_CSV);
        $headers = '';
        $sqlQuestion = "INSERT INTO " . self::NAME_BD . ".{$this->fileName} (";
        foreach ($file as $row) {
            if (!$headers) {
                $headers = implode($row, ',');//VALUES
                $sqlQuestion .= $headers . ") VALUES";
            } else {
                if (count(array_filter($row))>0) {

                    $sqlQuestion .= '("' . implode($row, '","') . '"' . '),';
                }
            }
        }

        $sqlQuestion = substr($sqlQuestion, 0, -1) . ";";

        $newFile = $this->dirName . '/bd/' . $this->fileName . '.sql';
        /** @var TYPE_NAME $resoursFile */
        $resoursFile = fopen($newFile, 'w');
        $result = fwrite($resoursFile, $sqlQuestion);
        fclose($resoursFile);

        return $result;

    }

}
