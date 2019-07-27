<?php
/**
 * Created by PhpStorm.
 * User: pijh
 * Date: 2017/8/20
 * Time: 00:33
 */

/**
 * 获取IP地址归属地
 * @param $ip
 * @return string
 */
function get_ip_address($ip)
{
    if ('127.0.0.1' == $ip) return 'Localhost';
    $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
    $location = curl_exec($ch);
    $location = json_decode($location, true);
    curl_close($ch);

    if (false != $location && 0 === $location['code']) {
        return $location['data']['region'] . $location['data']['city'] . $location['data']['county'] . '・' . $location['data']['isp'];
    } else {
        return 'unknown';
    }

}

/**
 * 递归查询获取分类树结构
 * @param $data
 * @param int $pid
 * @param int $level
 * @param array $tree
 * @param string $pidField
 * @param string $showField
 * @return array
 */
function get_tree_list(&$data, $pid = 0, $level = 0, &$tree = [], $pidField = 'pid', $showField = 'name')
{
    foreach ($data as $key => &$value) {
        if ($value[$pidField] == $pid) {
            $value['level'] = $level;
            $value['level'] && $value[$showField] = '&nbsp;' . $value[$showField];
            $value[$showField] = str_repeat('ㅡ', $value['level']) . $value[$showField];
            $tree[] = $value;
            unset($data[$key]);
            get_tree_list($data, $value['id'], $level + 1, $tree);
        }
    }
    unset($value);

    return $tree;
}

/**
 * 递归查询获取分类树结构带child
 * @param $data
 * @param int $pid
 * @param int $level
 * @param string $pidField
 * @return array
 */
function get_tree_list_with_child(&$data, $pid = 0, $level = 0, $pidField = 'pid')
{
    $tree = [];
    foreach ($data as $key => &$value) {
        if ($value[$pidField] == $pid) {
            $value['level'] = $level;
//            $value['child'] = get_tree_list_with_child($data, $value['id'], $level + 1);
            $value['children'] = get_tree_list_with_child($data, $value['id'], $level + 1);
            $tree[] = $value;
            unset($data[$key]);
        }
    }
    unset($value);

    return $tree;
}

/**
 * 打印sql语句，在sql语句之前调用
 */
function dump_sql()
{
    \DB::listen(function ($query) {
        $bindings = $query->bindings;
        $i = 0;
        $rawSql = preg_replace_callback('/\?/', function ($matches) use ($bindings, &$i) {
            $item = isset($bindings[$i]) ? $bindings[$i] : $matches[0];
            $i++;
            return gettype($item) == 'string' ? "'$item'" : $item;
        }, $query->sql);
        echo $rawSql . "\n<br /><br />\n";
    });
}

function create_guid($namespace = null)
{
    static $guid = '';
    $uid = uniqid("", true);

    $data = $namespace;
    $data .= $_SERVER ['REQUEST_TIME'];     // 请求那一刻的时间戳
    $data .= $_SERVER ['HTTP_USER_AGENT'];  // 获取访问者在用什么操作系统
    $data .= $_SERVER ['SERVER_ADDR'];      // 服务器IP
    $data .= $_SERVER ['SERVER_PORT'];      // 端口号
    $data .= $_SERVER ['REMOTE_ADDR'];      // 远程IP
    $data .= $_SERVER ['REMOTE_PORT'];      // 端口信息

    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = substr($hash, 0, 8);

    return $guid;
}

function create_order_number()
{
    return date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
}

/**
 * curl 请求
 * @param $url
 * @param null $header
 * @param null $data
 * @return mixed
 */
function curlRequest($url, $header = null, $data = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if ($data) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    if ($header) {
        curl_setopt($ch, CURLOPT_HEADER, $header);
    }
    $ret = curl_exec($ch);
    curl_close($ch);

    return $ret;
}

/**
 * 去除二维数组空元素
 * @param array $skuNumber
 * @return array
 */
function trim_array_null_item(array $skuNumber): array
{
    $arr = [];
    if ($skuNumber) {
        foreach ($skuNumber as $item) {
            $arr[] = array_values(array_filter($item, function ($v) {
                return !is_null($v);
            }));
        }
    }

    return $arr;
}

//操作成功：20000.
function success($data = NULL)
{
    return response()->json(['code' => 20000, 'msg' => 'ok', 'data' => $data]);
}

//操作失败：自定义失败消息
function failMsg(string $msg = '操作失败')
{
    return getResponseMessage('10x', $msg);
}

/**
 * 获取 格式化的 响应消息.
 *
 * @param string $id
 * @param mixed $msg
 *
 * @return array
 */
function getResponseMessage($id, $msg)
{
    return response()->json(['code' => $id, 'msg' => $msg]);
}

