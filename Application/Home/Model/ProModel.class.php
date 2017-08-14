<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 16:46
 */

namespace Home\Model;


use Think\Model;

class ProModel extends Model
{

    protected $_validate = array(
        array('name', 'require', '报修人不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话号码不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '报修地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('question', 'require', '报修问题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
      /*  array('odd',,self::MODEL_INSERT),*/

    );
}