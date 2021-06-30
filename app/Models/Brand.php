<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
Use voku\helper\HtmlDomParser;

class Brand extends Model
{
    use HasFactory;

    public function BrandListAdd($url, $type)
    {
        /*TODO тут пиплим проверку юрл через регулярки
            Дальше выбираем функцию в зваисимости от типа МП
            пока это вайлдберис
        */
        $url ='https://www.wildberries.ru/brands/podarok52-112777';
        $brand= DB::table('brands')->select(array('id', 'href'))->where('href', '=',  $url )->get();
        if (count($brand)<=0)
        {
            DB::table('brands')->insert(array('href'=>$url, 'mp_id'=>'1',  	'created_at'=>Now(), 'updated_at'=>Now()));
            $brand= DB::table('brands')->select(array('id', 'href'))->where('href', '=',  $url )->get();

            $links = $this->wildberriesBrandList($brand[0]->href);
        }
        else {
            $links = $this->wildberriesBrandList($brand[0]->href);

        }
        print_R($links);

    }

    protected function wildberriesBrandList($url){
        /*
         * TODO тут будет приходить правильный юрл
         *   пока делаем очереди
         */
        //$url = 'https://www.wildberries.ru/brands/podarok52-112777';
        $main_url = 'https://www.wildberries.ru';
        $html =HtmlDomParser::file_get_html($url);
        foreach ($html->find('.j-card-item') as $product)
        {
            $link = $product->find('.ref_goods_n_p')->href;
            if (!empty ($link[0]))
            {
                $links[] = $link[0];
            }
        }
        $pages = $html->find('.pageToInsert');
        $nextpage = $pages->find('.pagination-next')->href;
        if (!empty($nextpage[0]))
        {
            echo $main_url.$nextpage[0];
            $new_arr = $this->wildberriesBrandList($main_url.$nextpage[0]);
            $links = array_merge($links, $new_arr);
        }

        return $links;
        //echo $nextpage[0];
        /*foreach($pages->find('.pagination-item') as $page)
        {
            echo $page->href;
        }*/
    }
    protected function wildberisNextpage($url)
    {

    }
}
