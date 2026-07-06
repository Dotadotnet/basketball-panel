<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Config as ModelsConfig;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Models\Config;
use App\Models\Product;

class ApiController extends Controller
{

    public function model_new(string $name_model)
    {
        if (ucfirst($name_model) == 'Admin' || ucfirst($name_model) == 'Order' || ucfirst($name_model) == 'User' || ucfirst($name_model) == 'Config') {
            return response('دسترسی محدود است', 403);
        }
        $full_name_model = "App\Models\\" . ucfirst($name_model);
        try {
            $model_class = new $full_name_model();
        } catch (\Throwable $th) {
            http_response_code(400);
            echo $th->getMessage();
            die();
        }
        return $model_class;
    }

    
    public function all($model)
    {
        if (ucfirst($model) == 'Admin' || ucfirst($model) == 'Order' || ucfirst($model) == 'User' || ucfirst($model) == 'Config') {
            return response('دسترسی محدود است', 403);
        }
        $model_class = $this->model_new($model);
        return response($model_class->get());
    }
    public function get($model, $key, $value)
    {
        $model_class = $this->model_new($model);
        return response($model_class::where([$key => $value])->get());
    }

    public function edite(Request $request, $model)
    {
        $payload = $request->all();
        $model_class = $this->model_new($model);

        $keys = array_keys($payload);


        $selectField = $keys[0];      // اولین key
        $updataField = $keys[1];      // دومین key

        $targetValue = $payload[$selectField]; // مقدار اولین key
        $newValue = $payload[$updataField]; // مقدار دومین key
                                            

        return response($model_class::where([$selectField => $targetValue])->update([$updataField => $newValue]));
    }


    public function blogAllApi()
    {
        $blogs = Blog::all()->toArray();
        for ($i = 0; $i < count($blogs); $i++) {
            $blogs[$i]['link'] = '/blog/' . $blogs[$i]['id'];
            $dom = \HTMLDomParser\DomFactory::load($blogs[$i]['amount']);
            try {
                $blogs[$i]['img'] = str_replace(env('APP_URL') . '/storage/', '', $dom->findOne('img')->getAttribute('src'));
            } catch (\Throwable $th) {
                $blogs[$i]['img'] = '/img/image/noimg.png';
            }
            $blogs[$i]['data'] = explode(' ', Jalalian::forge($blogs[$i]['created_at'])->format('%d %B %Y h:m:s'));
        }
        unset($blogs[0]);
        return response(array_reverse($blogs));
    }
}
