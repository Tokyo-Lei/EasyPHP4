<?php
namespace App\Lib;
use App\Bootstrap;

/**
 * download save to :  \your_thinkphp_project\thinkphp\library\think\
 * think5.1.* Auth权限认证类
 * 数据表说明：
 *     建表语句在本类同级的tables.sql文件。
 *     建表时根据自身需要删除或替换[think_]表前缀
 *
 *     用户与用户组关系[auth_group_access]
 *     用户组列表[auth_group]
 *     规则表[auth_rule]
 *
 * 认证类说明：
 *     1、本类对规则认证，可以把节点（路由）理解为规则实现节点认证。
 *        $auth = new \think\Auth();
 *        $auth->check('规则名称', '用户ID');
 *
 *     2、同时对多条规则进行认证，可以设置多条规则的关系[or|and]
 *        $auth = new \think\Auth();
 *        $auth->check('规则1,规则2,...', '用户ID', 'and');
 *        -> and表示用户需要同时具有规则列表权限。
 *        -> or 表示用户只需要具有任一规则权限。
 *
 *     3、规则表达式用法
 *        在[auth_rule]表中[condition]字段，如果定义了表达式，则同时进行表达式验证。
 *        比如 {score}>5 and {score}<100 表示用户分数在5~100之间时才会通过认证。
 *        [score]为用户表字段，表达式字段用{}包裹。
 *
 * 配置说明：
 *     1、正式开发需要在应用配置目录添加根为auth的配置项，参考下面$_config属性
 */
class Auth
{

	public $Author = 'shensuping';
    // 默认配置
    protected $_config = [
        'auth_on'           =>  true, // 认证开关
        'auth_type'         =>  1,    // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        =>  'think_auth_group',        // 用户组数据表名
        'auth_group_access' =>  'think_auth_group_access', // 用户-用户组关系表
        'auth_rule'         =>  'think_auth_rule',         // 权限规则表
        'auth_user'         =>  'think_user',            // 用户信息表
        'auth_user_id_field'=>  'id', // 用户表ID字段名
        'administrator'     =>  [],   // 超级管理员列表
    ];
    public function __construct()
    {

        $Bootstrap = new Bootstrap();
        $auth = $Bootstrap->Auth_Config();    

        if (!empty($auth)) {
            $this->_config = array_merge($this->_config, $auth);
        }
    }
    /**
     * 验证权限
     * @param  mixed   $name     规则验证列表支持逗号分隔或者数组
     * @param  integer $uid      用户ID
     * @param  string  $relation 关系类型 or | and
     * @param  string  $mode     执行模式 url
     * @return boolean           验证结果
     */
    public function check($name, $uid, $relation = 'or', $mode = 'url')
    {
        // 没有开启认证，直接通过
        if (!$this->_config['auth_on']) {
            return true;
        }
        // 超级管理员，直接通过
        if (!empty($this->_config['administrator']) && in_array($uid, $this->_config['administrator'])) {
            return true;
        }
        $authlist = $this->getAuthList($uid);

        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') === false) {
                $name = [$name];
            } else {
                $name = explode(',', $name);
            }
        }
        $list = [];
        if ($mode === 'url') {
            $REQUEST = unserialize(strtolower(serialize(Request::param())));
        }
        foreach ($authlist as $auth) {
            $query = preg_replace('/^.+\?/U', '', $auth);
            if ($mode === 'url' && $query !== $auth) {
                parse_str($query, $param);
                $intersect = array_intersect_assoc($REQUEST, $param);
                $auth = preg_replace('/\?.*$/U', '', $auth);
                if (in_array($auth, $name) && $intersect == $param) {
                    $list[] = $auth;
                }
            } elseif (in_array($auth, $name)) {
                $list[] = $auth;
            }
        }
        if ($relation === 'or' && !empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation === 'and' && empty($diff)) {
            return true;
        }
        return false;
    }
    /**
     * 根据用户ID获取用户组，返回值为数组
     * @param  integer $uid 用户ID
     * @return array      用户所属用户组 ['uid'=>'用户ID', 'group_id'=>'用户组ID', 'title'=>'用户组名', 'rules'=>'用户组拥有的规则ID，多个用英文,隔开']
     */
    public function getGroups($uid)
    {
        static $groups = [];
        if (isset($groups[$uid])) {
            return $groups[$uid];
        }
        $user_groups = Db::name($this->_config['auth_group_access'])
                        ->alias('a')
                        ->join($this->_config['auth_group'].' g', "a.group_id = g.id")
                        ->field('uid,group_id,title,rules')
                        ->where('a.uid', $uid)
                        ->where('g.status', 1)
                        ->select();
        $groups[$uid] = $user_groups ?: [];
        return $groups[$uid];
    }
    /**
     * 获得权限列表
     * @param  integer $uid  用户ID
     * @param  integer $type 规则类型
     * @return array       权限列表
     */
    protected function getAuthList($uid)
    {
        static $_authlist = [];
        if (isset($_authlist[$uid])) {
           return $_authlist[$uid];
        }
        if ($this->_config['auth_type'] === 2 && Session::has('_auth_list_'.$uid)) {
            return Session::get('_auth_list_'.$uid);
        }
        // 读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = []; // 保存用户所属用户组设置的所有权限规则ID
        foreach ($groups as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
        if (empty($ids)) {
            $_authlist[$uid] = [];
            return [];
        }
        $map = [
            ['id', 'in', $ids],
            ['status', '=', 1] // 只查正常状态的数据
        ];
        // 读取用户组所有权限规则
        $rules = Db::name($this->_config['auth_rule'])->where($map)->field('condition,name')->select();
        // 循环规则，判断结果。
        $authlist = [];
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) { // 根据condition进行验证
                $user = $this->getUserInfo($uid); // 获取用户信息,一维数组
                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                // dump($command); // debug
                @(eval('$condition=('.$command.');'));
                if ($condition) {
                    $authlist[] = strtolower($rule['name']);
                }
            } else {
                // 只要存在就记录
                $authlist[] = strtolower($rule['name']);
            }
        }
        $_authlist[$uid] = $authlist;
        if ($this->_config['auth_type'] == 2) {
            Session::set('_auth_list_'.$uid, $authlist);
        }
        return array_unique($authlist);
    }
    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    protected function getUserInfo($uid) {
        static $userinfo = [];
        if (!isset($userinfo[$uid])) {
            $userinfo[$uid] = Db::name($this->_config['auth_user'])->where((string)$this->_config['auth_user_id_field'], $uid)->find();
        }
        return $userinfo[$uid];
    }
}