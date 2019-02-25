<?php

namespace App\Helpers;

class URLHelper {

    /**
     * Calculate page navigations
     *
     * @param int $maxPerPage
     * @param int $currentPage
     * @param int $totalItems
     * @return array
     */
    public static function pagesCalculation($maxPerPage = 10, $currentPage = 1, $totalItems = 0) {

        if ($currentPage <= 0) {
            $currentPage = 1;
        }

        $maxPages = ceil($totalItems/$maxPerPage);
        $nextPage = $currentPage + 1;
        $lastPage = $maxPages;

        if ($currentPage >= $maxPages) {
            $currentPage = $maxPages;
            $nextPage = $maxPages;
        }

        $offset = ($currentPage - 1) * $maxPerPage;

        return [
            'offset' => $offset,
            'nextPage' => $nextPage,
            'lastPage' => $lastPage,
            'currentPage' => $currentPage
        ];
    }
}