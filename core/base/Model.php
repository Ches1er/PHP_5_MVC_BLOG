<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 11.02.2019
 * Time: 20:38
 */
namespace core\base;
use core\db\DBQueryBuilder;
abstract class Model
{
    protected static $table;
    /**
     * Model constructor.
     */
    public function __construct(array $data=[])
    {
        foreach ($data as $field=>$value){
            $this->$field=$value;
        }
    }
    public static function get(){
        $class = get_called_class();
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)
            ->from($class::$table)->get();
    }
    private function parseFields(){
        $class = new \ReflectionClass(get_class($this));
        $fields = $class->getProperties();
        $arr = [];
        foreach ($fields as $field){
            if ($field->isStatic()||!$field->isPublic()) continue;
            $arr[] = $field->getName();
        }
        return $arr;
    }
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        $dbo = DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)->from($class::$table);
        return call_user_func_array([$dbo,$name],$arguments);
    }
    public function save(){
        $filds = $this->parseFields();
        $data = [];
        foreach ($filds as $fild){
            if(is_null($this->$fild)) continue;
            $data[$fild]=$this->$fild;
        }
        $class = get_class($this);
        if(is_null($this->id)){
            $id =  DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)->insert($class::$table,$data);
            $this->id = $id;
        }else{
            DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)
                ->where("id",":id")
                ->update($class::$table,$data,["id"=>$this->id]);
        }
    }

    private function currentTable():string{
        $current_table_class = get_class($this);
        return $current_table_class::$table;
    }

    protected function belongsTo($class,$current_key=null,$far_key="id"){
        if($current_key===null) $current_key = $class::$table."_id";
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)
            ->from($class::$table)->where($far_key,$this->$current_key)->first();
    }
    protected function hasMany($class,$far_key=null,$current_key="id"){
        var_dump($this->$current_key);
        $class2 = get_class($this);
        if($far_key===null) $far_key = $class2::$table."_id";
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$class)
            ->from($class::$table)->where($far_key,$this->$current_key);
    }
    protected function hasManyBelong($far_table_class,$mid_table,$far_mid_key,
                                     $mid_far_key,$cur_key,$mid_cur_key)
    {
        $cur_table = $this->currentTable();
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME,$far_table_class)
            ->from($far_table_class::$table)->join("inner",$mid_table,
                [$far_mid_key,$mid_far_key],[$cur_table,$cur_key,$mid_table,$mid_cur_key])
            ->where($cur_table.".".$cur_key,$this->$cur_key);
    }
    protected function addData($data):int{
        $cur_table = $this->currentTable();
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)
            ->insert($cur_table,$data);
    }
    protected function updateData($data,$where){
        $cur_table = $this->currentTable();
        DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)->where($where[0],$where[1])
            ->update($cur_table,$data);
    }
    protected function getId($id_field,$identification_field,$value){
        $cur_table = $this->currentTable();
        return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)->
            select([$id_field])->from($cur_table)->where($identification_field,$value)
                ->one();
    }
}