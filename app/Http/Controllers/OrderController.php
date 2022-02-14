<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request) {
        $FIO = $request->input('FIO');
        $article = $request->input('article');
        $manufacturer = $request->input('brand');
        $customerComment = $request->input('comment');
        list ($lastName, $firstName, $patronymic) = mb_split('\s', $FIO);

        //запрос на получение данных по артикулу и бренду
        $productInfo = $this->query('https://superposuda.retailcrm.ru/api/v5/store/products?apiKey=QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb'
            .'&'
            .'filter[name]='
            .$article
            .'&'
            .'filter[manufacturer]='
            .$manufacturer
        );

        if(!$productInfo['products'])//если данных о продукте нет - выдаем ошибку
            return redirect()->back()
                ->with('error', 'Ошибка: такого товара не существует');

        $result = $this->query('https://superposuda.retailcrm.ru/api/v5/orders/create?apiKey=QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb', array(//запрос
            'order' => json_encode(array(
                'lastName' => $lastName,
                'firstName' => $firstName,
                'patronymic' => $patronymic,
                'customerComment' => $customerComment,
                'items' => [
                    [
                        'offer' => [
                            'id' => $productInfo['products'][0]['offers'][0]['id']
                        ]
                    ]
                ],
                'status' => 'trouble',
                'orderType' => 'fizik',
                'site' => 'test',
                'orderMethod' => 'test',
                'number' => '13122001',
            ))
        ));

        if (!$result)//если ничего не получили
            return redirect()->back()
                ->with('error', 'Ошибка запроса');

        if(!$result['success'])//если success у полученного результата == false
            return redirect()->back()
                ->with('error', 'Ошибка:'. $result['errorMsg']);

        return redirect()->back()//получили данные
            ->with('success', 'Заказ создан'. $result['id']);

    }

    public function query($url, $data = array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);

        if (count($data) != 0)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if (false === ($response = curl_exec($ch))){
            echo "Ошибка HTTP запроса : " . curl_error($ch);
            return null;
        } else {
            return json_decode($response, true);
        }
    }
}
