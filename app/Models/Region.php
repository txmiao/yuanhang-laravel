<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Region extends Model
{
    protected $table = 'regions';
    public $timestamps = false;
    protected $guarded = ['_token'];

    /**
     * 获取完整地址
     * @param $province
     * @param null $city
     * @param null $district
     * @return string
     */
    public function getFullAddress($province, $city = null, $district = null)
    {
        $p = Region::where('code', $province)->first();
        if (is_null($city) && is_null($district)) {
            $fullAddress = $p->name;
        } else {
            if (is_null($district)) {
                $c = Region::where('code', $city)->first();
                $fullAddress = $p->name . $c->name;
            } else {
                $d = Region::where('code', $district)->first();
                $c = Region::where('code', $city)->first();
                $fullAddress = $p->name . $c->name . $d->name;
            }
        }

        return $fullAddress;
    }

    public function upOneLevel()
    {
        return $this->belongsTo(Region::class, 'parent_code', 'code');
    }

    /**
     * 获取地区三级联动列表
     * @return array
     */
    public static function getRegions()
    {
        $regions = Region::all();
        $regionsOne = $regionsTwo = $regionsThree = [];
        foreach ($regions as $oneLevel) {
            if (86 == $oneLevel->parent_code) {
                $code = array_get($oneLevel, 'code');
                $name = array_get($oneLevel, 'name');
                $letter = array_get($oneLevel, 'letter');
                $regionsOne[] = compact('code', 'name', 'letter');
            }
        }

        foreach ($regionsOne as $item) {
            foreach ($regions as $twoLevel) {
                $item['code'] == $twoLevel->parent_code &&
                $regionsTwo[$item['code']][] = [
                    'code' => array_get($twoLevel, 'code'),
                    'name' => array_get($twoLevel, 'name'),
                ];
            }
        }

        foreach ($regionsTwo as $regionsItem) {
            foreach ($regionsItem as $item) {
                foreach ($regions as $threeLevel) {
                    $item['code'] == $threeLevel->parent_code &&
                    $regionsThree[$item['code']][] = [
                        'code' => array_get($threeLevel, 'code'),
                        'name' => array_get($threeLevel, 'name'),
                    ];
                }
            }
        }

        $regionsList = (["86" => $regionsOne] + $regionsTwo + $regionsThree);
        Cache::forever('regions', $regionsList);

        return $regionsList;
    }

    /**
     * 获取地区三级联动列表带 child 格式
     * @return array
     */
    public static function getRegionsWithChild(): array
    {
        $regions = Region::all();
        $regionsArr = [];
        foreach ($regions as $oneLevel) {
            if (86 == $oneLevel->parent_code) {
                $code = array_get($oneLevel, 'code');
                $name = array_get($oneLevel, 'name');
                $letter = array_get($oneLevel, 'letter');
                $regionsArr[] = compact('code', 'name', 'letter');
            }
        }

        foreach ($regionsArr as &$item) {
            foreach ($regions as &$twoLevel) {
                $item['code'] == $twoLevel->parent_code &&
                $item['city'][] = [
                    'code' => array_get($twoLevel, 'code'),
                    'name' => array_get($twoLevel, 'name'),
                ];
            }
            unset($twoLevel);
        }
        unset($item);


        foreach ($regionsArr as $key => $regionsItem) {
            if (isset($regionsItem['city'])) {
                foreach ((array)$regionsItem['city'] as $k => &$itemCity) {
                    foreach ($regions as $threeLevel) {
                        $itemCity['code'] == $threeLevel->parent_code &&
                        $regionsArr[$key]['city'][$k]['district'][] = [
                            'code' => array_get($threeLevel, 'code'),
                            'name' => array_get($threeLevel, 'name'),
                        ];
                    }
                }
                unset($itemCity);
            }
        }


        $regionsList = ['province' => $regionsArr];
        Cache::forever('regions_with_child', $regionsList);

        return $regionsList;
    }

}
