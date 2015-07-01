<?php
class DbAccessor extends PDO {
    /**
     * 
     * @param string $dbSettingsPath
     * A string containing the path to the .ini file containing your database
     * settings.  
     * @throws exception
     * The passed in file must be a .ini file, otherwise an exception will
     * be thrown.
     */
    function __construct($dbSettingsPath){
        if (!$settings = parse_ini_file($dbSettingsPath, TRUE)) throw new exception('Unable to open ' . $dbSettingsPath . '.');
        $username = $settings['database']['username'];
        $password = $settings['database']['password'];
        $host = $settings['database']['host'];
        $dbName = $settings['database']['schema'];
        $dsn = "mysql:host=$host;dbname=$dbName";
        try {
            parent::__construct($dsn, $username, $password);
        } catch (Exception $e) {
            echo "ERROR!: " . $e->getMessage();
        }
    }
    /**
     * 
     * @param string $table
     * The name of the table you would like to select all columns of
     * @return PDO::Query
     * Returns a PDO Query object to be fetch()ed
     */
    function selectAll($table){
        try {
            $sql = "SELECT * FROM $table";
            return $result = $this->query($sql);
        } catch (PDOException $e) {
                echo "ERROR!: " . $e->getMessage();
        }
    }
    /**
     * 
     * @param string $table 
     * The name of the table you would like to insert into.
     * @param array $varArray 
     * An associative array, the key being the column name, the value 
     * is the value to be inserted into that column.
     */
    function insert($table, $varArray){
        $arrayLength = count($varArray);
        try {
            $sql = "INSERT INTO $table (";
            $ctr = 1;
            foreach ($varArray as $varName => $varVal){
                if ($ctr < $arrayLength){
                    $sql .= "$varName, ";
                } else {
                    $sql .= "$varName) VALUES (:";
                }
                $ctr++;
            }
            $ctr = 1;
            foreach ($varArray as $varName => $varVal){
                if ($ctr < $arrayLength){
                    $sql .= "$varName, :";
                } else {
                    $sql .= "$varName)";
                }
                $ctr++;
            }
            $stmt = $this->prepare($sql);
            foreach ($varArray as $varName => $varVal){
                $stmt->bindParam(":$varName", $varVal);
            }
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
        }
    }
    /**
     * 
     * @param string $table
     * The name of the table you would like to delete from
     * @param string $idVarName
     * The name of the column you are using to identify which item(s) to 
     * delete
     * @param mixed $id
     * The value that will be searched for to identify which item(s) to
     * delete
     */
    function delete($table, $idVarName, $id){
        try {
            $sql = "DELETE FROM $table WHERE $idVarName=:$idVarName";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":$idVarName", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
        }
    }
    /**
     * 
     * @param string $table
     * The name of the table you would like to update in
     * @param array $varArray
     * An associative array, the key being the column name, the value 
     * is the value to be updated into that column.
     * @param string $idVarName
     * The name of the column you are using to identify which item(s) to 
     * update
     * @param mixed $id
     * The value that will be searched for to identify which item(s) to
     * update
     */
    function update($table, $varArray, $idVarName, $id){
        $arrayLength = count($varArray);
        try {
            $sql = "UPDATE $table SET ";
            $ctr = 1;
            foreach ($varArray as $varName => $varVal){
                if ($ctr < $arrayLength){
                    $sql .= "$varName = :$varName, ";
                } else {
                  $sql .= "$varName = :$varName ";  
                }
                $ctr++;
            }
            $sql .= "WHERE $idVarName=:$idVarName";
            $stmt = $this->prepare($sql);
            foreach ($varArray as $varName => $varVal) {
                $stmt->bindParam(":$varName", $varVal);
            }
            $stmt->bindParam(":$idVarName", $id);
            $stmt->execute();
            echo "$sql<br>";
        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
        }
    }
    /**
     * 
     * @param string $table
     * The name of the table you would like to add a column to
     * @param string $column
     * The name of the column you would like to add
     * @param string $type
     * The data type of the column you would like to add
     * Ex. 'varchar(20)' or 'int'
     */
    function addColumn($table, $column, $type){
        try{
            $sql = "ALTER TABLE $table ADD :column :type";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(":column", $column);
            $stmt->bindParam(":type", $type);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR!: " . $e->getMessage();
        } 
    }
}