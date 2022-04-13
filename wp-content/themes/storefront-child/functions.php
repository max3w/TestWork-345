<?php 
//Подключаем скрипты
function add_custom_photo() {
wp_enqueue_script('add-custom-photo', get_stylesheet_directory_uri() . '/js/add-custom-photo.js');
}
add_action( 'wp_enqueue_scripts', 'add_custom_photo' );
add_action( 'admin_enqueue_scripts', 'add_custom_photo' );

//Добавляем кастомные поля

add_action( 'woocommerce_product_options_pricing', 'custom_product_options');

function custom_product_options(){
	echo '<div class="my_options_group">';
	//Селект
	woocommerce_wp_select( array(
	'id'      => '_selectprod',
	'label' => 'Тип продукта',
	'style' => '',
	'value' => get_post_meta( get_the_ID(), '_selectprod', true ),
	'class' => 'short clerinp',
	'options' => array(
		'' => 'Выберите...',
		'rare' => 'rare',
		'frequent' => 'frequent',
		'unusual' => 'unusual'
	)));	
	//Время создания
	woocommerce_wp_text_input(
    array(
        'id' => '_custom_product_date_field',
		'style' => 'pointer-events: none;',
		'value' => get_the_time(),
        'label' => __('Товар создан:', 'woocommerce'),
        'type' => 'time',
		'class' => 'short clerinp'
        ));
	
	//Дополнительное фото
?>	
	<p class="form-field _custom_product_foto">
	<label for="_custom_product_foto">Дополнительное фото:</label>
	<input type="text" placeholder="Image link" id="_custom_product_foto" class="short clerinp"  name="_custom_product_foto" value="<?php echo get_post_meta( get_the_ID(), '_custom_product_foto', true ); ?>" style="width: 50%">
	<input type="button" class="buttoncam button tagadd" value="Выберите фото"> 
	<input type="button" class="removecam button tagadd" value="Удалить">
	</p>

	<p class="form-field">
		<input type="button" class="removeall button tagadd" value="Очистить доп. поля">
		<input type="submit" name="save" id="publish" class="button button-primary button-large" value="Обновить">
	</p>
	
<?php		
    echo '</div>';
}
 
	//Функции сохранения полей
add_action( 'woocommerce_process_product_meta', 'save_custom_product_options', 10, 2 );
function save_custom_product_options( $id, $post ){

	if( !empty( $_POST['_selectprod'] ) ) {
		update_post_meta( $id, '_selectprod', $_POST['_selectprod'] );
	} else {
	delete_post_meta( $id, '_selectprod' ); //Удаляем если пустое 
	}

	//Обновляем время создания
	update_post_meta( $id, '_custom_product_date_field',  get_the_time());
	
	//Обновляем фото
	if( !empty( $_POST['_custom_product_foto'] ) ) {
		update_post_meta( $id, '_custom_product_foto', $_POST['_custom_product_foto']  );
	} else {
	delete_post_meta( $id, '_custom_product_foto' ); //Удаляем если пустое 
	}

}

//Вывод полей в списке товаров
add_action( 'woocommerce_after_shop_loop_item', 'add_to_custom_fields' );

function add_to_custom_fields() {
global $product; 
echo '<pre>';
echo get_post_meta( $product->get_id(), '_selectprod', true );
echo ('<br>');
echo get_post_meta( $product->get_id(), '_custom_product_date_field', true );
echo ('<br>');
echo get_post_meta( $product->get_id(), '_custom_product_foto', true );
echo '</pre>';
}
//
//

//Добавление формы на фронт
	//Подключаем функцию загрузки фото на фронт
	function load_media_files() {
	wp_enqueue_media();
	}
	add_action( 'wp_enqueue_scripts', 'load_media_files' );

//Програмное создание продукта
function add_custom_prod() {

}

//Добавляем форму
add_action( 'woocommerce_before_shop_loop', 'add_to_custom_form', 1 );

function add_to_custom_form() { 

//Если кнопка нажата вызовем add_custom_prod
if( isset( $_POST['dobavit_tovar'] ) )
{
	$name = $_POST['nameprod'];
	$price = $_POST['priceprod'];
	$selectprod = $_POST['_selectprod'];
	$cpp = $_POST['_custom_product_foto'];
	$item = array(
    'Name' => $name ,
	'Price' => $price,
    '_selectprod' => $selectprod,
	'_custom_product_date_field' => get_the_time(),
	'_custom_product_foto' => $cpp
);
$user_id = 1;
$post_id = wp_insert_post( array(
    'post_author' => $user_id,
    'post_title' => $item['Name'],
    'post_content' => '',
    'post_status' => 'publish',
    'post_type' => "product",
) );
wp_set_object_terms( $post_id, 'simple', 'product_type' );
update_post_meta( $post_id, '_visibility', 'visible' );
update_post_meta( $post_id, '_stock_status', 'instock');
update_post_meta( $post_id, 'total_sales', '0' );
update_post_meta( $post_id, '_downloadable', 'no' );
update_post_meta( $post_id, '_virtual', 'no' );
update_post_meta( $post_id, '_regular_price', '' );
update_post_meta( $post_id, '_sale_price', '' );
update_post_meta( $post_id, '_purchase_note', '' );
update_post_meta( $post_id, '_featured', 'no' );
update_post_meta( $post_id, '_weight', '' );
update_post_meta( $post_id, '_length', '' );
update_post_meta( $post_id, '_width', '' );
update_post_meta( $post_id, '_height', '' );
update_post_meta( $post_id, '_sku', '' );
update_post_meta( $post_id, '_product_attributes', array() );
update_post_meta( $post_id, '_sale_price_dates_from', '' );
update_post_meta( $post_id, '_sale_price_dates_to', '' );
update_post_meta( $post_id, '_price', $item['Price'] );
update_post_meta( $post_id, '_sold_individually', '' );
update_post_meta( $post_id, '_manage_stock', 'no' );
update_post_meta( $post_id, '_backorders', 'no' );
update_post_meta( $post_id, '_stock', '' );
update_post_meta( $post_id, '_selectprod', $item['_selectprod'] );
update_post_meta( $post_id, '_custom_product_date_field', $item['_custom_product_date_field'] );
update_post_meta( $post_id, '_custom_product_foto', $item['_custom_product_foto'] );

    echo 'Товар <b>' . $name . ' </b>добавлен! Обновляем страницу';
	echo "<meta http-equiv='refresh' content='0'>";
}
?>
<form method="POST">
	<div align="center">
		<div style="width:400px;background-color: #f9f9f9;padding: 30px;text-align: end;">
	<p class="form-field">
	<label for="nameprod">Имя продукта</label>
	<input type='text' name='nameprod'>
	</p>
	<p class="form-field">
	<label for="priceprod">Цена</label>
	<input type='text' name='priceprod'>
	</p>
	<p class="form-field _selectprod_field">
		<label for="_selectprod">Тип продукта</label>
				<select style="" id="_selectprod" name="_selectprod" class="short clerinp">
			<option value="">Выберите...</option><option value="rare">rare</option><option value="frequent" selected="selected">frequent</option><option value="unusual">unusual</option>		</select>
	</p>
	<p class="form-field _custom_product_foto">
	<label for="_custom_product_foto">Фото:</label>
	<input type="text" placeholder="Image link" id="_custom_product_foto" class="short clerinp"  name="_custom_product_foto" value="..." style="width: 80%;margin-bottom: 20px;pointer-events: none;">
	<input type="button" class="buttoncam button tagadd" value="Выберите фото"> 
	<input type="button" class="removecam button tagadd" value="Удалить">
	</p>
    <input type="submit" name="dobavit_tovar" value="Добавить товар" />
		</div>
	</div>
</form>

<?php } ?>
