<?php


Class File
{
    private static $path;
    private static $files = [];
    private static $dirs = [];

    private function __construct($path)
    {
        try {
            if (is_dir($path)) {
                self::$path = strtr($path, ['\\' => '/']);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function runFiles($path)
    {
        $arr = ['files' => [], 'dirs' => [], 'all' => []];
        $target = array_diff(scandir($path), ['.', '..']);
        array_walk($target, function ($val, $key) use (&$arr, $path) {
            $subTarget = "{$path}/{$val}";
            if (is_file($subTarget)) {
                array_push($arr['files'], "{$path}/" . $val);
            } else if (is_dir($subTarget)) {
                array_push($arr['dirs'], "{$path}/" . $val);
                $arr = array_merge_recursive($arr, $this->runFiles($subTarget));
            }
        });
        return $arr;
    }

    /**新建文件夹,如果目标文件夹不存在的情况下
     * @param $target
     * @return mixed
     */
    private static function createFile($target)
    {
        if (!is_dir($target)) {
            mkdir($target, 0777, true);
        }
        return $target;
    }

    /**判断是否是空的文件夹
     * @param $dir
     * @return bool
     */
    private static function isEmptyDir($dir)
    {
        $arr = array_diff(scandir($dir), ['.', '..']);
        return count($arr) == 0 ? true : false;
    }

    /**初始化
     * @param $path
     * @return FILE
     */
    public static function init($path)
    {
        $cls = new self($path);
        $all = $cls->runFiles(self::$path);
        self::$files = $all['files'];
        self::$dirs = $all['dirs'];
        return $cls;
    }

    /**处理文件如复制或移动
     * @param $target
     * @param $mode
     * @param $extension
     * @return int
     */
    private function dealFile($target, $mode, $extension)
    {
        $target = self::createFile($target);
        $result = 0;
        array_walk(self::$files, function ($val) use ($target, $extension, $mode, &$result) {
            $info = pathinfo($val);
            if (!$extension || ($extension && strcasecmp($info['extension'], $extension) == 0)) {
                $res = strcasecmp($mode, 'move') == 0 ? rename($val, $target . '/' . $info['basename']) : copy($val, $target . '/' . $info['basename']);
                if ($res) {
                    $result++;
                }
            }
        });
        return $result;
    }

    /**获取真实的文件路径
     * @return array
     */
    public function getRawFiles()
    {
        return self::$files;
    }

    /**获取真实的文件夹路径
     * @return array
     */
    public function getRawDirs()
    {
        return self::$dirs;
    }

    /**获取全部的文件名
     * @return array
     */
    public function getFiles()
    {
        $arr = [];
        array_walk(self::$files, function ($val) use (&$arr) {
            array_push($arr, basename($val));
        });
        return $arr;
    }

    /**获取所有的文件夹
     * @return array
     */
    public function getDirs()
    {
        $arr = [];
        array_walk(self::$dirs, function ($val) use (&$arr) {
            array_push($arr, basename($val));
        });
        return $arr;

    }

    /**获取树形结构图,注意这边的引用传值
     * @return array
     */
    public function getTree()
    {
        $all = array_merge(self::$dirs, self::$files);
        $tree = [];
        $diff = explode('/', self::$path);
        if ($all) {
            array_walk($all, function ($val) use ($diff, &$tree) {
                $temp_arr = explode('/', $val);
                if (is_file($val)) {
                    $file = end($temp_arr);
                    array_push($diff, $file);
                }
                $temp_arr = array_diff($temp_arr, $diff);
                $parent =& $tree;
                foreach ($temp_arr as $k => $v) {
                    if (!$parent[$v]) {
                        $parent[$v] = [];
                    }
                    $parent =& $parent[$v];
                }
                if (is_file($val)) {
                    array_push($parent, $file);
                }
            });
        }
        return $tree;
    }

    /**展示文件夹的信息
     * @return array
     */
    public function getInfo()
    {
        $files = self::$files;
        $dirs = self::$dirs;
        $size = 0;
        array_walk($files, function ($val) use (&$size) {
            $size += filesize($val);
        });
        return [
            'size' => $size,
            'dirs' => count($dirs),
            'files' => count($files)
        ];
    }

    /**进行文件拷贝
     * @param $target
     * @param null $type
     * @return int
     */
    public function copyFiles($target, $type = null)
    {
        return $this->dealFile($target, 'copy', $type);
    }

    /**复制所有的空文件夹
     * @param $target
     * @return int
     */
    public function copyDirs($target)
    {
        $dirs = self::$dirs;
        $target = strtr(trim($target), ['\\' => '/']);
        $target_arr = explode('/', $target);
        if (end($target_arr) == '') {
            array_pop($target_arr);
        }
        $diff = explode('/', self::$path);
        $count = 0;
        array_walk($dirs, function ($val) use (&$count, $target_arr, $diff) {
            $temp_arr = array_diff(explode('/', $val), $diff);
            $new_path = implode('/', $target_arr) . '/' . implode('/', $temp_arr);
            if (mkdir($new_path, 0777, true)) {
                $count++;
            }
        });
        return $count;
    }

    /**文件的剪切
     * @param $target
     * @param null $type
     * @return int
     */
    public function moveFiles($target, $type = null)
    {
        return $this->dealFile($target, 'move', $type);
    }

    /**剪切所有的文件夹以及文件
     * @param $target
     * @return array
     */
    public function moveAll($target)
    {
        $dirs = $this->copyDirs($target);
        $files = self::$files;
        $target_arr = explode('/', $target);
        if (end($target_arr) == '') {
            array_pop($target_arr);
        }
        $diff = explode('/', self::$path);
        $count = 0;
        array_walk($files, function ($val) use (&$count, $target_arr, $diff) {
            $temp_arr = array_diff(explode('/', $val), $diff);
            $new_path = implode('/', $target_arr) . '/' . implode('/', $temp_arr);
            if (rename($val, $new_path)) {
                $count++;
            }
        });
        $this->removeAll();
        return [
            'files' => $count,
            'dirs' => $dirs
        ];
    }

    /**删除指定目录下的所有文件
     * @return int
     */
    public function removeFiles()
    {
        $count = 0;
        array_walk(self::$files, function ($val) use (&$count) {
            if (unlink($val)) {
                $count++;
            }
        });
        return $count;
    }

    /**进行删除文件夹所有内容的操作
     * @return bool
     */
    public function removeAll()
    {
        $dirs = self::$dirs;
        //进行文件夹排序
        uasort($dirs, function ($m, $n) {
            return strlen($m) > strlen($n) ? -1 : 1;
        });
        //删除所有文件
        $this->removeFiles();
        array_walk($dirs, function ($val) {
            rmdir($val);
        });
        return self::isEmptyDir(self::$path);
    }
}