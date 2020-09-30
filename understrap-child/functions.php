<?php
function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{

    // Get the theme data
    $the_theme = wp_get_theme();
    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get('Version'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get('Version'), true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function add_child_theme_textdomain()
{
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'add_child_theme_textdomain');

/* main.css追加
---------------------------------------------------------- */
function register_stylesheet()
{
    wp_register_style('main', get_stylesheet_directory_uri() . '/css/main.css?v=20200625');
}
function add_stylesheet()
{
    register_stylesheet();
    wp_enqueue_style('main', '', array(), '1.0', false);
}
add_action('wp_enqueue_scripts', 'add_stylesheet');

/* main.js追加
---------------------------------------------------------- */
function my_scripts_method()
{
    wp_enqueue_script(
        'commmon-script',
        get_stylesheet_directory_uri() . '/js/main.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

/* メニュー　サブタイトル追加
---------------------------------------------------------- */
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
function description_in_nav_menu($item_output, $item)
{
    return preg_replace('/(<a.*?>[^&lt;]*?)</', '$1' . "<br /><div>{$item->description}</div><", $item_output);
}

/* カスタマイザ設定
---------------------------------------------------------- */
add_action('customize_register', 'theme_customize');

function theme_customize($wp_customize)
{

    //ロゴ
    $wp_customize->add_section('logo_section', array(
        'title' => 'ロゴ',
        'priority' => 20,
        'description' => 'ロゴ画像をアップロードしてください。',
    ));

    //ロゴ/トップページ
    $wp_customize->add_setting('logo_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_img', array(
        'label' => 'ロゴ',
        'description' => '（推奨サイズ: 100×220px）',
        'section' => 'logo_section',
        'settings' => 'logo_img',
    )));

    //ロゴ/固定ページ
    $wp_customize->add_setting('pagelogo_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pagelogo_img', array(
        'label' => 'ロゴ(固定ページ用)',
        'description' => '（推奨サイズ: 40×100px）',
        'section' => 'logo_section',
        'settings' => 'pagelogo_img',
    )));

    //トップ画像
    $wp_customize->add_section('topimage_section', array(
        'title' => 'トップ画像',
        'priority' => 30,
        'description' => 'トップ画像画像をアップロードしてください。',
    ));

    $wp_customize->add_setting('top_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'top_img', array(
        'label' => 'トップ画像',
        'section' => 'topimage_section',
        'settings' => 'top_img',
    )));

    //コンセプト
    $wp_customize->add_section('concept_section', array(
        'title' => 'コンセプト',
        'priority' => 40,
        'description' => 'コンセプトを設定してください。',
    ));

    // コンセプト/タイトル
    $wp_customize->add_setting('concept_title', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('concept_title', array(
        'settings' => 'concept_title',
        'label' => 'コンセプト/タイトル',
        'section' => 'concept_section',
        'type' => 'text',
    ));

    // コンセプト/文章
    $wp_customize->add_setting('concept_txtarea', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('concept_txtarea', array(
        'settings' => 'concept_txtarea',
        'label' => 'コンセプト/文章',
        'section' => 'concept_section',
        'type' => 'textarea',
    ));

    //お知らせ
    $wp_customize->add_section('information_section', array(
        'title' => 'お知らせ',
        'priority' => 45,
        'description' => 'お知らせを入力してください',
    ));

    // お知らせ/お知らせ表示切替チェックボックス
    $wp_customize->add_setting('information_text[infoCheckbox]', array(
        'default'   => false,
        'type'      => 'option',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('information_display_checkbox', array(
        'settings'  => 'information_text[infoCheckbox]',
        'label'     => 'お知らせを表示する',
        'section'   => 'information_section',
        'type'      => 'checkbox',
    ));

    // お知らせ/文章
    $wp_customize->add_setting('information_text[infoText]', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('information_text_control', array(
        'settings' => 'information_text[infoText]',
        'label' => 'お知らせ',
        'description' => 'お知らせを入力してください。',
        'section' => 'information_section',
        'type' => 'textarea',
    ));

    //お部屋
    $wp_customize->add_section('room_section', array(
        'title' => 'お部屋',
        'priority' => 50,
        'description' => '画像、テキストを設定してください。',
    ));

    // お部屋/画像
    $wp_customize->add_setting('room_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'room_img', array(
        'label' => 'お部屋/画像',
        'section' => 'room_section',
        'settings' => 'room_img',
        'description' => '推奨サイズ1280×400px',
    )));

    // お部屋/時間
    $wp_customize->add_setting('room_time', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('room_time', array(
        'settings' => 'room_time',
        'label' => 'お部屋/時間',
        'section' => 'room_section',
        'type' => 'text',
    ));

    // お部屋/文章
    $wp_customize->add_setting('room_txtarea', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('room_txtarea', array(
        'settings' => 'room_txtarea',
        'label' => 'お部屋/文章',
        'description' => 'お部屋の説明を入力してください。',
        'section' => 'room_section',
        'type' => 'textarea',
    ));

    // お部屋/ボタンの文字
    $wp_customize->add_setting('room_button', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('room_button', array(
        'settings' => 'room_button',
        'label' => 'お部屋/ボタンの文字',
        'description' => 'ボタンに表示する文字を入力してください。',
        'section' => 'room_section',
        'type' => 'text',
    ));

    // お部屋/ボタンのリンクURL
    $wp_customize->add_setting('room_url', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('room_url', array(
        'settings' => 'room_url',
        'label' => 'お部屋/ボタンのリンクURL',
        'description' => 'リンク先のURLを入力してください。',
        'section' => 'room_section',
        'type' => 'text',
    ));

    //イベント
    $wp_customize->add_section('event_section', array(
        'title' => 'イベント',
        'priority' => 60,
        'description' => '画像、テキストを設定してください。',
    ));

    // イベント/画像
    $wp_customize->add_setting('event_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'event_img', array(
        'label' => 'イベント/画像',
        'section' => 'event_section',
        'settings' => 'event_img',
        'description' => '推奨サイズ1280×400px',
    )));

    // イベント/時間
    $wp_customize->add_setting('event_time', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('event_time', array(
        'settings' => 'event_time',
        'label' => 'イベント/時間',
        'section' => 'event_section',
        'type' => 'text',
    ));

    // イベント/文章
    $wp_customize->add_setting('event_txtarea', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('event_txtarea', array(
        'settings' => 'event_txtarea',
        'label' => 'イベント/文章',
        'description' => 'イベントの説明を入力してください。',
        'section' => 'event_section',
        'type' => 'textarea',
    ));

    // イベント/ボタンの文字
    $wp_customize->add_setting('event_button', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('event_button', array(
        'settings' => 'event_button',
        'label' => 'イベント/ボタンの文字',
        'description' => 'ボタンに表示する文字を入力してください。',
        'section' => 'event_section',
        'type' => 'text',
    ));

    // イベント/ボタンのリンクURL
    $wp_customize->add_setting('event_url', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('event_url', array(
        'settings' => 'event_url',
        'label' => 'イベント/ボタンのリンクURL',
        'description' => 'リンク先のURLを入力してください。',
        'section' => 'event_section',
        'type' => 'text',
    ));

    //島のご案内
    $wp_customize->add_section('attend_section', array(
        'title' => '島のご案内',
        'priority' => 70,
        'description' => '画像、テキストを設定してください。',
    ));

    // 島のご案内/画像
    $wp_customize->add_setting('attend_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'attend_img', array(
        'label' => '島のご案内/画像',
        'section' => 'attend_section',
        'settings' => 'attend_img',
        'description' => '推奨サイズ1280×400px',
    )));

    // 島のご案内/文章
    $wp_customize->add_setting('attend_txtarea', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('attend_txtarea', array(
        'settings' => 'attend_txtarea',
        'label' => '島のご案内/文章',
        'description' => '島のご案内の説明を入力してください。',
        'section' => 'attend_section',
        'type' => 'textarea',
    ));

    // 島のご案内/ボタンの文字
    $wp_customize->add_setting('attend_button', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('attend_button', array(
        'settings' => 'attend_button',
        'label' => '島のご案内/ボタンの文字',
        'description' => 'ボタンに表示する文字を入力してください。',
        'section' => 'attend_section',
        'type' => 'text',
    ));

    // 島のご案内/ボタンのリンクURL
    $wp_customize->add_setting('attend_url', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('attend_url', array(
        'settings' => 'attend_url',
        'label' => '島のご案内/ボタンのリンクURL',
        'description' => 'リンク先のURLを入力してください。',
        'section' => 'attend_section',
        'type' => 'text',
    ));

    //交通手段
    $wp_customize->add_section('access_section', array(
        'title' => '交通手段',
        'priority' => 75,
        'description' => '画像、テキストを設定してください。',
    ));

    // 交通手段/googlemap埋め込み
    $wp_customize->add_setting('access_googlemap', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('access_googlemap', array(
        'settings' => 'access_googlemap',
        'label' => '交通手段/googlemap埋め込み',
        'description' => 'googlemapの埋め込みコードを入力してください。',
        'section' => 'access_section',
        'type' => 'textarea',
    ));

    // 交通手段/タイトル
    $wp_customize->add_setting('access_title', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('access_title', array(
        'settings' => 'access_title',
        'label' => '交通手段/タイトル',
        'section' => 'access_section',
        'type' => 'text',
    ));

    // 交通手段/住所
    $wp_customize->add_setting('access_adress', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('access_adress', array(
        'settings' => 'access_adress',
        'label' => '交通手段/住所',
        'description' => '住所を入力してください。',
        'section' => 'access_section',
        'type' => 'textarea',
    ));

    //ご予約
    $wp_customize->add_section('booking_section', array(
        'title' => 'ご予約',
        'priority' => 76,
        'description' => '画像、テキストを設定してください。',
    ));

    // ご予約/画像
    $wp_customize->add_setting('booking_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'booking_img', array(
        'label' => 'ご予約/画像',
        'section' => 'booking_section',
        'settings' => 'booking_img',
        'description' => '推奨サイズ1280×400px',
    )));

    // ご予約/ボタンの文字
    $wp_customize->add_setting('booking_button', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('booking_button', array(
        'settings' => 'booking_button',
        'label' => 'ご予約/ボタンの文字',
        'description' => 'ボタンに表示する文字を入力してください。',
        'section' => 'booking_section',
        'type' => 'text',
    ));

    // ご予約/ボタンのリンクURL
    $wp_customize->add_setting('booking_url', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('booking_url', array(
        'settings' => 'booking_url',
        'label' => 'ご予約/ボタンのリンクURL',
        'description' => 'リンク先のURLを入力してください。',
        'section' => 'booking_section',
        'type' => 'text',
    ));

    //フッター
    $wp_customize->add_section('footer_section', array(
        'title' => 'フッター',
        'priority' => 120,
        'description' => 'フッターロゴ、テキストを設定してください。',
    ));

    // フッター/ロゴ
    $wp_customize->add_setting('footerlogo_img');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footerlogo_img', array(
        'label' => 'フッター/ロゴ',
        'description' => '（推奨サイズ: 100×220px）',
        'section' => 'footer_section',
        'settings' => 'footerlogo_img',
    )));

    // フッター/住所
    $wp_customize->add_setting('footer_adress', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('footer_adress', array(
        'settings' => 'footer_adress',
        'label' => 'フッター/住所',
        'description' => '住所を入力してください。',
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // フッター/電話番号
    $wp_customize->add_setting('footer_tel', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('footer_tel', array(
        'settings' => 'footer_tel',
        'label' => 'フッター/電話番号',
        'section' => 'footer_section',
        'type' => 'text',
    ));

    // フッター/メールアドレス
    $wp_customize->add_setting('footer_email', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('footer_email', array(
        'settings' => 'footer_email',
        'label' => 'フッター/メールアドレス',
        'description' => 'メールアドレスを入力してください。',
        'section' => 'footer_section',
        'type' => 'text',
    ));

    // フッター/住所（英語）
    $wp_customize->add_setting('footer_adress_en', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('footer_adress_en', array(
        'settings' => 'footer_adress_en',
        'label' => 'フッター/住所（英語）',
        'description' => '住所（英語）を入力してください。',
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // フッター/電話番号（英語）
    $wp_customize->add_setting('footer_tel_en', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('footer_tel_en', array(
        'settings' => 'footer_tel_en',
        'label' => 'フッター/電話番号（英語）',
        'description' => '電話番号（英語）を入力してください。',
        'section' => 'footer_section',
        'type' => 'text',
    ));

    // フッター/facebook
    $wp_customize->add_setting('facebook_icon');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'facebook_icon', array(
        'label' => 'フッター/facebookアイコン',
        'section' => 'footer_section',
        'settings' => 'facebook_icon',
        'description' => 'facebookのアイコンを設定してください。',
    )));

    // フッター/facebookリンク先
    $wp_customize->add_setting('facebook_link', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('facebook_link', array(
        'settings' => 'facebook_link',
        'label' => 'フッター/facebookリンク先',
        'description' => 'facebookのリンク先を入力してください。',
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // フッター/インスタ
    $wp_customize->add_setting('insta_icon');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'insta_icon', array(
        'label' => 'フッター/インスタアイコン',
        'section' => 'footer_section',
        'settings' => 'insta_icon',
        'description' => 'インスタのアイコンを設定してください。',
    )));

    // フッター/インスタリンク先
    $wp_customize->add_setting('insta_link', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('insta_link', array(
        'settings' => 'insta_link',
        'label' => 'フッター/インスタリンク先',
        'description' => 'インスタのリンク先を入力してください。',
        'section' => 'footer_section',
        'type' => 'textarea',
    ));

    // フッター/コピーライト
    $wp_customize->add_setting('copyright', array(
        'type' => 'option',
    ));

    $wp_customize->add_control('copyright', array(
        'settings' => 'copyright',
        'label' => 'フッター/コピーライト',
        'description' => 'コピーライトを入力してください。',
        'section' => 'footer_section',
        'type' => 'text',
    ));
}

/* カスタマイザーで設定された画像のURLを取得
---------------------------------------------------------- */
//ロゴ画像
function get_the_logo_img_url()
{
    return esc_url(get_theme_mod('logo_img'));
}

//ロゴ画像(固定ページ用)
function get_the_pagelogo_img_url()
{
    return esc_url(get_theme_mod('pagelogo_img'));
}

//トップページメイン画像
function get_the_topimage_url()
{
    return esc_url(get_theme_mod('top_img'));
}

//お部屋画像
function get_the_roomimage_url()
{
    return esc_url(get_theme_mod('room_img'));
}

//イベント画像
function get_the_eventimage_url()
{
    return esc_url(get_theme_mod('event_img'));
}

//島のご案内画像
function get_the_attendimage_url()
{
    return esc_url(get_theme_mod('attend_img'));
}

//ご予約画像
function get_the_bookingimage_url()
{
    return esc_url(get_theme_mod('booking_img'));
}

//フッターロゴ
function get_the_footerlogo_url()
{
    return esc_url(get_theme_mod('footerlogo_img'));
}

//facebookアイコン
function get_the_facebookicon_url()
{
    return esc_url(get_theme_mod('facebook_icon'));
}

//インスタアイコン
function get_the_instaicon_url()
{
    return esc_url(get_theme_mod('insta_icon'));
}

/* カスタム投稿タイプ　ご案内追加
---------------------------------------------------------- */
add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type(
        'attend',
        array(
            'labels' => array(
                'name' => __('ご案内'),
                'singular_name' => __('ご案内')
            ),
            'public' => true,
            'menu_position' => 5,
        )
    );
}

function people_init()
{
    $labels = array(
        'name' => _x('ご案内のカテゴリー', 'taxonomy general name'),
        'singular_name' => _x('ご案内のカテゴリー', 'taxonomy singular name'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'attend_cat', 'with_front' => true,),
        'show_admin_column' => false,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_quick_edit' => false,
    );
    register_taxonomy('attend_cat', array('attend'), $args);
}
add_action('init', 'people_init');

/* Contact Form 7 Safari日付バグ対応
---------------------------------------------------------- */
add_filter('wpcf7_support_html5_fallback', '__return_true');
