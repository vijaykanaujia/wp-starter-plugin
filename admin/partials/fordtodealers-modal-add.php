<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', true);
global $wpdb;
$table = $wpdb->prefix.'fortodealers_modal_list';
$update = false;

if (isset($_POST['modal_submit'])) {
    $data = [
        'page_id' => isset($_POST['page_id']) ? $_POST['page_id'] : null,
        'modal_image_url'        => isset($_POST['modal_image_url']) ? $_POST['modal_image_url'] : null,
        'modal_name'       => isset($_POST['modal_name']) ? $_POST['modal_name'] : null,
        'modal_class' => isset($_POST['modal_class']) ? $_POST['modal_class'] : null,
        'price'        => isset($_POST['price']) ? $_POST['price'] : null,
    ];

    if(isset($_POST['id'])){
        $res = $wpdb->update($table,$data, ['id' => $_POST['id']]);
        if($res){
            echo '<p style="color: green;">data updated successfully</p>';
        };
    }else{
        $wpdb->insert($table,$data);
        if($wpdb->insert_id){
            echo '<p style="color: green;">data inserted successfully</p>';
        };
    }
    
}
if(isset($_POST['isEdit'])){
    $result = $wpdb->get_results('SELECT * FROM `'.$table.'` WHERE `id`='.$_POST['id'].'')[0];
    $update = true;
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="" enctype="multipart/form-data" method="post" id="modal_price_form">
        <?php if($update){ ?>
            <input type="hidden" name="id" value="<?php echo $result->id; ?>">
        <?php } ?>
        <div class="">
            <table width="100%">
                <tr>
                    <td>Modal Name</td>
                    <td>:</td>
                    <td><input type="text" name="modal_name" value="<?php echo $update ? $result->modal_name : '' ?>"></td>
                </tr>
                <tr>
                    <td>Modal Class</td>
                    <td>:</td>
                    <td><input type="text" name="modal_class" value="<?php echo $update ? $result->modal_class : '' ?>"></td>
                </tr>
                <tr>
                    <td>Modal Image</td>
                    <td>:</td>
                    <td><input type="text" name="modal_image_url" value="<?php echo $update ? $result->modal_image_url : '' ?>"></td>
                </tr>
                <tr>
                    <td>Page Id</td>
                    <td>:</td>
                    <td><input type="text" name="page_id" value="<?php echo $update ? $result->page_id : '' ?>"></td>
                </tr>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>:</td>
                    <td><input type="text" name="price" value="<?php echo $update ? $result->price : '' ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input name="modal_submit" type="submit" value="submit" /></td>
                </tr>
            </table>
        </div>
    </form>
</div>