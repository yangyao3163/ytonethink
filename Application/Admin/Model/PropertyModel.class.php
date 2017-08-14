<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/8/10
 * Time: 17:08
 */

namespace Admin\Model;


class PropertyModel extends ModelModel
{
    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('problem', 'require', '问题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('status', '1', self::MODEL_BOTH),
        array('number','getNo',1,'callback'),

    );

    public  function getNo(){
        return uniqid("one_");
    }
}