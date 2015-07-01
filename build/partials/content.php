<div class="row">
    <div class="12 column">
        <?php
        $dba = new DbAccessor('db/dbSettings.ini');
        //$home = new Page("Home");
        //$dba->insert("pages", array("page" => "Home"));
        //$dba->delete("pages","pageID","19");
        //$dba->update("pages", array("page" => "Home"), "pageID", 2);
        //Page::changeName("Contact", 2);
        $pageResult = $dba->selectAll("pages");
        while ($row = $pageResult->fetch()){
            $page = $row['page'];
            $pageID = $row['pageID'];
            ?>
        <h1><a href="index.php?page=<?=$pageID?>"><?=$page?></a></h1>
            <?php
        }
        $dba = NULL;
        ?>
    </div>
</div>


