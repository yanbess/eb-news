<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\EchoBotAPI;
use App\Resources\NewsRepository;

class NewsSearchController extends Controller
{
    public function main(Request $request)
    {
        $form = $request->form;
        if (!empty($form['daterange'])) {
            $daterange = explode(' - ', $form['daterange']);
            unset($form['daterange']);

            $form['daterange']['from'] = $daterange[0];
            $form['daterange']['to'] = $daterange[1];
        }

        $result = null;

        if (!empty($form['query'])) {

            $filters = [];

            if (!empty($form['language'])) {
                $filters['languages'] = [$form['language']];
            }

            if (!empty($form['daterange'])) {
                $filters['dateRange'] = [
                    'from' => date(DATE_ISO8601, strtotime($form['daterange']['from'])),
                    'to' => date(DATE_ISO8601, strtotime($form['daterange']['to'])),
                    'field' => 'publishedDate',
                ];
            }

            $news = new NewsRepository;
            $result = $news->getList(
                $form['query'],
                $filters,
                ['publishedDate', $form['sorting']],
                [0, 10]
            );
        }

        return view('search', ['news' => $result, 'form' => $form]);
    }
}
