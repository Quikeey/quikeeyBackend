<?php

namespace App\CentralLogics;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;

class CategoryLogic
{
    public static function parents()
    {
        return Category::where('position', 0)->get();
    }

    public static function child($parent_id)
    {
        return Category::where(['parent_id' => $parent_id])->get();
    }

    public static function products($category_id, array $zone_id, int $limit,int $offset, $type)
    {
        $paginator = Food::whereHas('restaurant', function($query)use($zone_id){
            return $query->whereIn('zone_id', $zone_id);
        })
        ->whereHas('category',function($q)use($category_id){
            return $q->whereId($category_id)->orWhere('parent_id', $category_id);
        })
        ->active()->type($type)->latest()->paginate($limit, ['*'], 'page', $offset);

        return [
            'total_size' => $paginator->total(),
            'limit' => $limit,
            'offset' => $offset,
            'products' => $paginator->items()
        ];
    }


    public static function restaurants($category_id, array $zone_id, int $limit,int $offset, $type,$longitude=0,$latitude=0)
    {
        $paginator = Restaurant::withOpen($longitude,$latitude)->whereIn('zone_id', $zone_id)
        ->whereHas('foods.category', function($query)use($category_id){
            return $query->whereId($category_id)->orWhere('parent_id', $category_id);
        })
        // ->whereHas('category',function($q)use($category_id){
        //     return $q->whereId($category_id)->orWhere('parent_id', $category_id);
        // })
        ->active()->type($type)->latest()->paginate($limit, ['*'], 'page', $offset);

        return [
            'total_size' => $paginator->total(),
            'limit' => $limit,
            'offset' => $offset,
            'restaurants' => $paginator->items()
        ];
    }


    public static function all_products($id)
    {
        $cate_ids=[];
        array_push($cate_ids,(int)$id);
        foreach (CategoryLogic::child($id) as $ch1){
            array_push($cate_ids,$ch1['id']);
            foreach (CategoryLogic::child($ch1['id']) as $ch2){
                array_push($cate_ids,$ch2['id']);
            }
        }

        return Food::whereIn('category_id', $cate_ids)->get();
    }


    public static function format_export_category($category)
    {
        $storage = [];
        foreach($category as $item)
        {
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'image'=>$item->image,
                'parent_id'=>$item->parent_id,
                'position'=>$item->position,
                'priority'=>$item->priority,
            ];
        }

        return $storage;
    }
}
