<?php
trocaPage(299);
function trocaPage($num) {
    $numPage = 0;
    for($i = 0; $i >= $numPage; $i++){
        $numPage = $num / 80;
        $intNumPage = (int)$numPage;
        echo "<br>";
        echo "$intNumPage";
        echo "<br>";
    }
    return $intNumPage;
}
?>