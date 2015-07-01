<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class='name'><h1><a href='index.php?page=1'>CMS v0.1</a></h1></li>
  </ul>
  <section class="top-bar-section">
      <ul class="right">
<?php
$dba = new DbAccessor('db/dbSettings.ini');
$pageResult = $dba->selectAll("pages");
while ($row = $pageResult->fetch()){
    $page = $row['page'];
    $pageID = $row['pageID'];
    ?>
          <li><a href="index.php?page=<?=$pageID?>"><?=$page?></a></li>
    <?php
}
$dba = NULL;
?>
      </ul>
  </section>
</nav>
<?php
