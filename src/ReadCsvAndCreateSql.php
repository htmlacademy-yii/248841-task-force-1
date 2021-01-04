<?php


namespace Lobochkin\TaskForce;


use SplFileObject;

class ReadCsvAndCreateSql
{
    private $fileName;
    private $dirName;
    private $bdName;
    private $outDirName;

    /**
     * ReadCsvAndCreateSql constructor.
     * @param string $name
     * @param string $dirName
     * @param string $outDirName
     * @param string $bdName
     */

    function __construct(string $name, string $dirName, string $outDirName, string $bdName)
    {
        $this->fileName = str_replace(".csv", '', $name);
        $this->dirName = $dirName;
        $this->bdName = $bdName;
        $this->outDirName = $outDirName;
    }

    public function csvToSqlConvert(): string
    {
        $fullName = $this->dirName . $this->fileName . ".csv";

        if (!file_exists($fullName)) {
            throw new \Exception("Файла {$fullName} не существует");
        }

        $file = new SplFileObject($fullName);
        if ($file->getExtension() !== 'csv') {
            throw new \Exception("Файл {$fullName} имеет расширение {$file->getExtension()}");
        }

        if (!$file->getSize()) {
            throw new \Exception("Файл {$fullName} пустой");
        }

        $file->setFlags(SplFileObject::READ_CSV);
        $headers = '';
        $sqlQuestion = "INSERT INTO " . $this->bdName . ".{$this->fileName} (`";
        foreach ($file as $row) {
            if (!$headers) {
                $headers = implode($row, '`,`');//VALUES
                $sqlQuestion .= $headers . "`) VALUES";
            } else {
                if (trim($row[0]) !== '') {

                    $sqlQuestion .= '("' . implode('","', $row) . '"' . '),';
                }
            }
        }

        $sqlQuestion = substr($sqlQuestion, 0, -1) . ";";

        $newFile = $this->outDirName . $this->fileName . '.sql';
        /** @var TYPE_NAME $resoursFile */
        $resoursFile = fopen($newFile, 'w');
        $result = fwrite($resoursFile, $sqlQuestion);
        fclose($resoursFile);
        return $result;

    }

}
