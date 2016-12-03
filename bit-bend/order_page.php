<?php
/**
 * Created by PhpStorm.
 * User: bilguun
 * Date: 12/3/16
 * Time: 11:25 PM
 */
include_once __DIR__.'/../core/connection.php';

if(isset($_POST['sortable'])){
    $sort = $_POST['sortable'];
//    $func->dump($sort);
    $flag = false;
    foreach ($sort as $key => $item){
        if(array_key_exists('id', $item) && array_key_exists('parent_id', $item)){
            $pid = $item['parent_id'];
            if($pid == ''){
                $pid = 0;
            }
            $value = array(
                    "order" => $key,
                    "parent" => $pid
            );
            if($dbc->update($config['db_table_prefix']."pages", $value, "id = '".$item['id']."'") == 0){
                $flag = true;
            }
        }
    }
    if(!$flag){
        echo '<div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<strong>Амжилттай!</strong> Цэсний дараалал амжилттай шинэчлэгдлээ.
        </div>';
    }
    else {
        echo '<div class="alert alert-warning">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<strong>Анхаар!</strong> Цэсний дараалал шинэчлэгдэхэд алдаа гарлаа.
        </div>';
    }
}

$result = $dbc->select($config['db_table_prefix']."pages","id, title, author", "parent = 0", "`order` ASC, `id` ASC");
if ($result != 0) {
    if (is_array($result[0]))
        $pages = $result;
    else $pages[0] = $result;
} else {
    $pages = 0;
}

//$func->dump($pages);
echo get_ol($pages, $dbc, $config, $func);

function get_ol($array, $dbc, $config, $func, $child = FALSE){

    $str = '';
    if(count($array)){
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item){
            $author = $dbc->select($config['db_table_prefix']."users","display_name","uuid = '".$item['author']."'");
            $str .= '<li id="list_'.$item['id'].'">';
            $str .= '<div>'.$item['id'].'. '.$item['title'].' - <i class="text-muted">'.$author['display_name'].'</i></div>';

            // Do we have any children
            $result = $dbc->select($config['db_table_prefix']."pages","id, title, author", "parent = ".$item['id']);
            $page = array();
            if ($result != 0) {
                if (is_array($result[0]))
                    $page = $result;
                else $page[0] = $result;
            }
            if($page != 0){
                $str .= get_ol($page, $dbc, $config, $func, TRUE);
            }

            $str .= '</li>'.PHP_EOL;
        }
        $str .= '</ol>'.PHP_EOL;
    }

    return $str;

}

?>

<script>
    $(document).ready(function(){
        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 2
        });
    });
</script>