<?php
/**@formatCategory 无线级分类处理
 * @param array $data 数据源
 * @param string $fieldName 字段名
 * @return array
 * @author 张先生
 * @date 2020-03-27
 */
if(!function_exists('formatCategory')){
    function formatCategory(array $data , string $idName = "id", string $fieldName = 'pid', $childrenKey = 'child')
    {
        $items = [];
        foreach ($data as $item) {
            $items[$item[$idName]] = $item;
        }
        $result = array();
        foreach($items as $item){
            if(isset($items[$item[$fieldName]])){
                $items[$item[$fieldName]][$childrenKey][] = &$items[$item[$idName]];
            }else{
                $result[] = &$items[$item[$idName]];
            }
        }
        return $result;
    }
}
?>
