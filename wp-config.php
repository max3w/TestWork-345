<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'twp-new' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'twp-new' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'Gc5XC5v4' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ng)u=#]|uS+Z~I#9 K~ im6gk]Gdj(YanL5jS*BIBNqYEYT0}o5dmjn=~m|BcH&i' );
define( 'SECURE_AUTH_KEY',  'WUvdARZpyBxM[2-Ts-  q>ld50 %*-E:55#?c{HqMTW@1Wbnl8S}eq!&B<}g~o}F' );
define( 'LOGGED_IN_KEY',    'DaxL/b3Kq!u]%bh9bbdbC55k3Q@]{0:$8c]oOm<%e/=XY EvT0w)ax*0b;<`PF6Y' );
define( 'NONCE_KEY',        '0k/yZ0,-O]xxI{s@$-E-)TQWwc`BnGfG[(0#;brZ~6`v7mNZuE5a-7eG%7qriL)]' );
define( 'AUTH_SALT',        '?-VDMO4V*IFiS%L4x#aT)B%f2k(,^QwWh(s|Zc(d$OeC$ffQhI6&gOaa~QD+RG]S' );
define( 'SECURE_AUTH_SALT', 'hjyIMu-IADJI5d|r4CsilT5Q454d2;mnDk*wAk[$NQ.PcGbs3NN,oO+Qg/Ig-Z_{' );
define( 'LOGGED_IN_SALT',   'Mew)BQ}/ObGd{=5$IAsmV?l.D:L*u:!~h`r}jD=JO2##?O?2V1SRG?5Lp(vpC~Wf' );
define( 'NONCE_SALT',       'hA*%%Jo:z=ef6U^o=beG=dLfSBoh)A_r)z{O[[eQWn9Af-%vA0`w[U<tR&Jl^~5(' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
