<?php
$home = esc_url(home_url('/'));
$company = esc_url(home_url('/company/'));
$iwd = esc_url(home_url('/iwd/'));
$news = esc_url(home_url('/news/'));
$demolition = esc_url(home_url('/demolition/'));
$contact = esc_url(home_url('/contact/'));
$privacy_policy = esc_url(home_url('/privacy-policy/'));
$transportation = esc_url(home_url('/transportation/'));
$service = esc_url(home_url('/service/'));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6RWT88YRKH"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-6RWT88YRKH');
    </script>

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- meta情報 -->
  <title>
    <?php
    global $page, $paged;
    if (is_front_page()) : //トップページ
      echo '岩守産業 株式会社｜北海道名寄市';
      bloginfo('name');
    elseif (is_home()) : //ブログページ（ブログサイトの場合はトップページ）
      wp_title('｜', true, 'right');
      bloginfo('name');
    elseif (is_page()) : //固定ページ
      wp_title('｜', true, 'right');
      bloginfo('name');
    elseif (is_single()) : //投稿ページ
      wp_title('｜', true, 'right');
      bloginfo('name');
    elseif (is_category()) : //カテゴリーページ
      echo 'カテゴリ ：';
      echo single_term_title();
      echo '｜岩守産業 株式会社';
    elseif (is_archive()) : //アーカイブページ
      echo wp_title('') . '年のお知らせ｜岩守産業 株式会社';
    // echo'｜岩守産業 株式会社';
    elseif (is_404()) : //404ページ
      echo '404｜';
      bloginfo('name');
    endif;
    if ($paged >= 2 || $page >= 2) : //２ページ目以降の場合
      echo '｜' . sprintf(
        '%sページ',
        max($paged, $page)
      );
    endif;
    ?>
  </title>
  <meta name="description" content="上川北部で唯一の安定型最終処分場を自社保有し、産業廃棄物処理や土木工事、解体工事、道路除雪、施設管理、貨物自動車運送と幅広くインフラ・ライフラインの維持管理に努めています。">
  <meta name="keywords" content="岩守産業,北海道,名寄市,産業廃棄物,土木工事.解体工事,トラック,運送">
  <meta name="robots" content="all" />
  <!-- OGP -->
  <meta property="og:type" content="article">
  <meta property="og:title" content="岩守産業 株式会社｜北海道名寄市">
  <meta property="og:description" content="上川北部で唯一の安定型最終処分場を自社保有し、産業廃棄物処理や土木工事、解体工事、道路除雪、施設管理、貨物自動車運送と幅広くインフラ・ライフラインの維持管理に努めています。">
  <meta property="og:url" content="https://www.iwamori.co.jp/">
  <meta property="og:image" content="">
  <meta property="og:site_name" content="岩守産業 株式会社｜北海道名寄市">
  <!-- ファビコン -->
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/common/favicon.ico" />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="header__inner">

      <!-- ハンバーガー -->
      <button class="header__drawer hamburger js-hamburger">
        <span class="u-mobile-1440"></span>
        <span class="u-mobile-1440"></span>
        <span class="u-mobile-1440"></span>
      </button>

      <!-- ロゴ -->
      <h1 class="header__logo">
        <a href="<?php echo $home ?>" class="header__logo-link">
          <img src="<?php echo get_template_directory_uri(); ?>/images/common/header-logo.svg" alt="岩守産業株式会社ロゴ">
        </a>
      </h1>

      <nav class="header__nav">
        <ul class="header__items">
          <li class="header__item header__has-sub u-desktop-1440"><a href="<?php echo $service ?>">事業内容</a>
            <ul class="header__sub">
              <li class="header__sub-heading"><a href="<?php echo $service ?>">事業内容</a></li>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-civil-engineering">-土木工事</a>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-demolition">-解体工事</a>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-iwd">-産業廃棄物処理・収集運搬</a>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-transportation">-貨物自動車運送業</a>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-facility">-施設管理</a>
              <li class="header__sub-text"><a href="<?php echo esc_url(home_url('/')); ?>service#service-snow-removal">-除雪業務</a>
              <li class="header__sub-heading"><a href="<?php echo $iwd ?>">廃棄物処理場のご利用案内</a>
              </li>
            </ul>
          </li>
          <li class="header__item u-desktop-1440"><a href="<?php echo $company ?>">会社情報</a></li>
          <li class="header__item u-desktop-1440"><a href="https://en-gage.net/iwamori_saiyo" target="_blank" rel="noreferrer noopener">採用情報</a></li>
          <li class="header__item u-desktop-1440"><a href="<?php echo $news ?>">お知らせ</a></li>
          <li class="header__item-access u-desktop-1440"><a href="<?php echo esc_url(home_url('/')); ?>company#company-main">アクセス</a></li>
          <li class="header__item header__item--green"><a href="<?php echo $contact ?>">お問い合せ</a></li>
        </ul>
      </nav>

      <nav class="header__sp-nav u-mobile-1440 js-drawer-menu">
        <ul class="header__sp-nav__items" id="nav">
          <li class="header__sp-nav__item"><a class="link" href="<?php echo $service ?>">事業内容</a></li>
          <li class="header__sp-nav__item"><a class="link" href="<?php echo $company ?>">会社情報</a></li>
          <li class="header__sp-nav__item"><a href="https://en-gage.net/iwamori_saiyo" target="_blank" rel="noreferrer noopener">採用情報</a></li>
          <li class="header__sp-nav__item"><a class="link" href="<?php echo $news ?>">お知らせ</a></li>
          <li class="header__sp-nav__item"><a class="link" href="<?php echo esc_url(home_url('/')); ?>company#company-main">アクセス</a></li>
          <li class="header__sp-nav__item"><a class="link" href="<?php echo $contact ?>">お問い合せ</a></li>
        </ul>
      </nav>
    </div>

    <!-- ローディングスピナー -->
    <div class="cube-wrapper" id="loader">
      <div class="cube-folding">
        <span class="leaf1"></span>
        <span class="leaf2"></span>
        <span class="leaf3"></span>
        <span class="leaf4"></span>
      </div>
    </div>

  </header>