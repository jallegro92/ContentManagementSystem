<?php
class Page {
    /**
     * 
     * @param string $page
     * The name of the page you would like to create.
     */
    function __construct($page){
        $varArray = array("page" => $page);
        $dba = new DbAccessor('db/dbSettings.ini');
        $dba->insert("pages", $varArray);
        $dba = NULL;
    }
    /**
     * 
     * @param int $pageID
     * The id of the page you would like to delete
     */
    function delete($pageID){
        $dba = new DbAccessor('db/dbSettings.ini');
        $dba->delete("pages", "pageID", $pageID);
        $dba = NULL;
    }
    /**
     * 
     * @param string $newName
     * The string that you want the name of the page to be changed to
     * @param int $pageID
     * The id of the page you would like to change the name of
     */
    static function changeName($newName, $pageID){
        $dba = new DbAccessor('db/dbSettings.ini');
        $dba->update("pages", array("page" => $newName), "pageID", $pageID);
        $dba = NULL;
    }
}