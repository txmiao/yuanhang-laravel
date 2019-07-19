<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2018/9/6
 * Time: 18:54
 */

namespace App\Services;


use Psy\Util\Json;

class CommonService
{

    /**
     * @param bool $status      成功状态
     * @param array $data       返回数据
     * @param string $msg       返回提示语
     * @return array
     */
    public static function status_return($status=true,$data=[],$msg=''){
        return ['status'=>$status,'data'=>$data,'msg'=>$msg];
    }

    /**
     * @param $model    需要插入的模型名
     * @param $data     需要插入的数据
     * @param $relation 关联模型
     * @param $findKeys 模型查询字段
     * @return array    ['status'=>boolean,'data'=>'插入成功后的数据','msg'=>'插入成功后的提示语']
     */
    public static function store($model,$data,$relation=null,$findKeys=[]){
        $insertModel=$model;
        if(is_string($model)&&class_exists($model)){
            if(count($findKeys)==0){
                $insertModel=new $model;
            }else{
                $findData=[];
                //使用字段进行
                foreach($data as $key=>$value){
                    if(in_array($key,$findKeys)){
                        $findData[$key]=$value;
                    }
                }
                $insertModel=$model::firstOrNew($findData);
            }

            foreach($data as $key=>$value){
                $insertModel->$key=$value;
            }
            $result=true;
            if(!is_null($relation)){
                $result=$relation->save($insertModel);
            }else{
                $result=$insertModel->save();
            }
            if($result){
                return self::status_return(true,$insertModel,$model::message('insert_success'));
            }
            return self::status_return(false,[],$model::message('insert_failure'));

        }

        return self::status_return(false,[],'class_not_found');

    }


    public static function firstOrCreate($model,$data,$findKey=[],$relation=null){
        if(count($findKey)<1){
            //用所有字段进行查找
            $findData=$data;
        }

        $insertModel=$model::firstOrNew($findData);

        foreach($data as $key=>$value){
            if(is_array($value)){
                $value=Json::encode($value);
            }
            $insertModel->$key=$value;
        }

        if(!is_null($relation)){
            $result=$relation->save($insertModel);
        }else{
            $result=$insertModel->save();
        }
        if($result){
            return self::status_return(true,$insertModel,$model::message('insert_success'));
        }
        return self::status_return(false,[],$model::message('insert_failure'));

    }


    /**
     * @param $model    需要修改的模型
     * @param $data     需要修改的数据
     * @return array    ['status'=>boolean,'data'=>'插入成功后的数据','msg'=>'插入成功后的提示语']
     */
    public static function update($model,$data){
        foreach($data as $key=>$value){
            $model->$key=$value;
        }
        if($model->save()){
            return self::status_return(true,$model,$model::message('update_success'));
        }
        return self::status_return(false,[],$model::message('update_failure'));
    }


    /**
     * 删除模型
     * @param $model
     * @return array
     */
    public static function delete($model){
        if($model->delete()){
            return self::status_return(true,[],$model::message('delete_success'));
        }
        return self::status_return(false,[],$model::message('delete_failure'));
    }

}