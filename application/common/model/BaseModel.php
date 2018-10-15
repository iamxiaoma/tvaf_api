<?php

namespace app\common\model;
use think\Model;
use think\db\Where;
use think\model\concern\SoftDelete;
/**
 * @author iamxiaoma
 * 基础通用模型类，定义标准的增删改查方法
 */
class BaseModel extends Model
{
    // 软删除设置
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;
    protected $autoWriteTimestamp = 'datetime';  // 自动写入时间

    /**
     * 单表通用分页查询、多条件查询、自定义字段筛选
     *
     * @param integer $page_number
     * @param integer $page_size
     * @param array $where
     * @param array $fields
     * @return void
     */
    public function get_list($page_number = 1, $page_size = 10, $where = array(), $fields = array(), $sort = array()){
        $list = $this->field($fields)->where(new Where($where))->order($sort)->limit(($page_number - 1) * $page_size, $page_size)->select();
        $count = $this->where($where)->count();
        return array(
            'list' => $list,  // 数据列表
            'total_pages' => ceil($count / $page_size), // 总页数
            'total_rows' => $count, // 总记录数
        );
    }



    /**
     * 多表关联通用分页查询、多条件查询、自定义字段筛选
     */
    public function join_list($page_number = 1, $page_size = 10, $alias = 't', $join = array(), $where = array(), $fields = '', $order = array()){
        $list = $this->alias($alias)->join($join)->field($fields)->where(new Where($where))->limit(($page_number - 1) * $page_size, $page_size)->order($order)->select();
        $count = $this->alias($alias)->join($join)->where(new Where($where))->count();
        return array(
            'list' => $list,  // 数据列表
            'total_pages' => ceil($count / $page_size), // 总页数
            'total_rows' => $count, // 总记录数
        );
    }


    /**
     * 新增数据
     *
     * @param [type] $data
     * @return void
     */
    public function add($data){
        $data['create_time'] = now();
        return $this->insertGetId($data); // 在同个事务里新增多条数据，可以正常新增
        // 此方式在同个事务里新增多条数据，只能增加最后一条数据
        // $this->save($data);
        // return $this->id;
    }



    /**
     * 单表批量新增
     *
     * @param [type] $list
     * @return void
     */
    public function addAll($list){
        foreach($list as $item){
            $item['create_time'] = now();
        }
        return $this->saveAll($list);
    }


    /**
     * 删除数据
     *
     * @param [type] $id
     * @return void
     */
    public function del($id){
        // 软删除
        return $this::destroy($id);
        //return $this->where('id', $id)->delete();
    }


    /**
     * 更新数据
     *
     * @param [type] $data
     * @return void
     */
    public function edit($data){
        $data['update_time'] = now();
        $this->update($data);
        return $data['id'];
    }


    /**
     * 单表数据批量更新
     *
     * @param [type] $list
     * @return void
     */
    public function editAll($list){
        foreach($list as $item){
            $item['update_time'] = now();
        }
        return $this->saveAll($list);
    }


    /**
     * 根据主键id查询数据
     *
     * @param [type] $id
     * @return void
     */
    public function findById($id){
        return $this::get($id);
    }


}
