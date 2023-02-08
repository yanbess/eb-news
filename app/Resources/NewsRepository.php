<?php


namespace App\Resources;

use App\Services\EchoBotAPI;


class NewsRepository
{
    public function getList(string $query = '', array $filters = [], array $sorting = ['publishedDate', 'asc'], array $paging = [0, 20]) : object {
        $echoBotAPI = new EchoBotAPI;
        $result = $echoBotAPI->post(
            'news/search',
            [
                ...$filters,
                'query' => $query,
                'options' => ['sortBy' => ['field' => $sorting[0], 'order' => $sorting[1]]],
                'paging' => ['page' => $paging[0], 'pageSize' => $paging[1]]
            ]);

        return $result;
    }
}
