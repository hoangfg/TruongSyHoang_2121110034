<?php

namespace App\Libraries;

class Pagination
{
    public static function pageCurrent()
    {
        $page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $page = (is_numeric($page)) ? $page : 1;
        $page = ($page <= 0) ? 1 : $page;
        return $page;
    }
    public static function pageOffset($page, $limit)
    {
        return ($page - 1) * $limit;
    }
    public static function pageLinks($total, $current, $limit, $url = '')
    {
        if ($total == 0) return '';
        $numPage = floor($total / $limit);
        if (($total / $limit) - $numPage > 0) {
            $numPage += 1;
        }
        $html = "<ul class='pagination justify-content-center'>";
        if ($numPage == 1) {
            return '';
        }
        if ($current == 1) {
            $html .= "<li class='page-item'><a class='page-link'><i class='fas fa-angle-double-left text-muted'></i> </a></li> ";
            $html .= "<li class='page-item'><a class='page-link'><i class='fas fa-angle-left text-muted'></i> </a></li> ";
        } else {
            $html .= "<li class='page-item'><a class='page-link' href='$url&page=1'><i class='fas fa-angle-double-left '></i></a> </li> ";
            $html .= "<li class='page-item'><a class='page-link' href='$url&page=" . ($current - 1) . "'><i class='fas fa-angle-left '></i></a> </li> ";
        }
        if ($current <= 3) {
            for ($i = 1; ($i <= 5) and ($i <= $numPage); $i++) {
                if ($i == $current) {
                    $html .= "<li class='page-item'><a class='page-link bg-success'>" . $i . "</a></li>";
                } else {
                    $html .= "<li class='page-item'><a class='page-link' href='$url&page=$i'>$i</a></li>";
                }
            }
        } else {
            if ($numPage >= $current + 2) {
                for ($i = $current - 2; ($i <= $current + 2) and ($i <= $numPage); $i++) {
                    if ($i == $current) {
                        $html .= "<li class='page-item'><a class='page-link bg-success'>" . $i . "</a></li>";
                    } else {
                        $html .= "<li class='page-item'><a class='page-link' href='$url&page=$i'>$i</a> </li> ";
                    }
                }
            } else {
                for ($i = $numPage - 4; $i <= $numPage; $i++) {
                    if ($i > 0) {
                        if ($i == $current) {
                            $html .= "<li class='page-item'><a class='page-link bg-success'>" . $i . "</a></li>";
                        } else {
                            $html .= "<li class='page-item'><a class='page-link' href='$url&page=$i'>$i</a> </li> ";
                        }
                    }
                }
            }
        }
        if ($current == $numPage) {
            $html .= "<li class='page-item'><a class='page-link '><i class='fas fa-angle-right text-muted'></i> </a></li> ";
            $html .= "<li class='page-item'><a class='page-link'><i class='fas fa-angle-double-right text-muted'></i></a></li>";
        } else {
            $html .= "<li class='page-item'><a class='page-link' href='$url&page=" . ($current + 1) . "'><i class='fas fa-angle-right '></i></a> </li> ";
            $html .= "<li class='page-item'><a class='page-link' href='$url&page=$numPage'><i class='fas fa-angle-double-right '></i></a></li>";
        }
        $html .= "</ul>";
        return $html;
    }
}
