<?php
//Este archiuvo se ejecurta en index.php por lo que las importaciones deben de hacerse a ese nivel
include_once 'database/conn.php';
include_once 'database/db-functions.php';

$num_total_rows = countAllBets($conn);
$itemsPerPage = 20;
$total_pages = 0;

if ($num_total_rows > 0) {
    $page = false;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $itemsPerPage;
    }
    //calculo el total de paginas
    $total_pages = ceil($num_total_rows / $itemsPerPage);
}

function createPaginator($total_pages, $page)
{
    echo '<nav id="pagination-menu">';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        if ($page > 3) {
            $rangoInicio = $page - 3;
            $rangoFin = $page  + 3 > $total_pages ?  $total_pages : $page + 3;
        } else {
            $rangoInicio = 1;
            $rangoFin = 6 > $total_pages ?  $total_pages : 6;
        }

        for ($i = $rangoInicio; $i <= $rangoFin; $i++) {
            if ($page == $i) {
                echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}
