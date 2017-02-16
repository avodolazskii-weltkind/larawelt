<?php

namespace App\Modules\Articles\Facades;

use App\Modules\Search\Http\Controllers\Search as BaseSearch;

class Search extends BaseSearch
{
    public $tableName = 'articles';
    public $routeName = 'articles.show';

    public $dateField = 'date';

    public function getResult()
    {
        $sql = $this->getTable()
            ->select()
            ->where(
                $this->getSearchSqlWhere(
                    $this->getQuery(),
                    array('title', 'preview', 'content','meta_h1', 'meta_title', 'meta_keywords', 'meta_description')
                ))
            ->where('active', 1)
            ->where('lang', \Lang::locale())
            ->get();

        return $this->addNodes($sql, 'articles', trans('articles::index.title'));
    }
}