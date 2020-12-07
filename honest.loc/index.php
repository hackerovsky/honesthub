<?php
if (!empty($_COOKIE['sid'])) {session_id($_COOKIE['sid']);}
session_start();
require_once 'classes/Auth.class.php';

if (!Auth\User::isAuthorized()):
  header("Location: /authpage.php");
  die();
endif;

require_once 'handlers/get_data.php';
?>
<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Honest - социальная сеть для предпренимателей</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
  <link rel="manifest" href="/assets/favicons/site.webmanifest">
  <link rel="mask-icon" href="/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/assets/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#484e55">
  <meta name="msapplication-config" content="/assets/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
    style="height: 0; width: 0; position: absolute; top: -99999px; left: -99999px; visibility: hidden;">
    <symbol id="i-appointment" viewBox="0 0 24 24">
      <path fill="#86929f"
        d="M10 24a3.74 3.74 0 003.67-3H6.33A3.74 3.74 0 0010 24zM17.58 14.5h-.08A8 8 0 0111 1.85V1a1 1 0 00-2 0v1.08A7 7 0 003 9v2.79a6.69 6.69 0 01-2.39 5.13A1.75 1.75 0 001.75 20h16.5a1.75 1.75 0 001.13-3.09 6.53 6.53 0 01-1.8-2.41z" />
      <path fill="#e55756"
        d="M17.5 0A6.5 6.5 0 1024 6.5 6.51 6.51 0 0017.5 0zm1 8.75a.75.75 0 01-1.5 0V5.5h-.5a.75.75 0 010-1.5h1.25a.76.76 0 01.75.75z" />
    </symbol>
    <symbol id="i-audio" viewBox="0 0 16.62 24">
      <path fill="#86929f"
        d="M15.28 15.26a9.9 9.9 0 001.33-4.39 6.05 6.05 0 00-.64-3 8.61 8.61 0 00-3.32-3.27 9.46 9.46 0 01-2.46-2.08l-.11-.15A4.18 4.18 0 019.22.8a.93.93 0 00-1-.8.92.92 0 00-.85.92v16.45a5.36 5.36 0 00-2.77-.76c-2.53 0-4.6 1.66-4.6 3.7S2.07 24 4.62 24s4.61-1.66 4.61-3.69V9.55a6.63 6.63 0 014.28 5 4.54 4.54 0 01-.36.5.92.92 0 001.39 1.22 6.76 6.76 0 00.68-1z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-chevron" viewBox="0 0 12.04 6.15">
      <path fill="#86929f" fill-rule="evenodd"
        d="M.89.14a.53.53 0 00-.75 0 .53.53 0 000 .75L5.7 6a.87.87 0 00.18.11.59.59 0 00.37 0A.57.57 0 006.43 6L11.87.93a.53.53 0 000-.75.53.53 0 00-.75 0L6.06 4.9z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-location" viewBox="0 0 17.38 24">
      <path fill="#86929f"
        d="M8.69 0A8.7 8.7 0 000 8.69c0 6 7.78 14.68 8.11 15.05a.77.77 0 001.16 0c.34-.37 8.11-9.1 8.11-15A8.7 8.7 0 008.69 0zm0 13.06a4.37 4.37 0 114.37-4.37 4.37 4.37 0 01-4.37 4.37z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-photo" viewBox="0 0 27.69 24">
      <g fill="#86929f" data-name="lay-1">
        <path
          d="M26.61 4.77A3.56 3.56 0 0024 3.69h-3.23l-.74-2A2.63 2.63 0 0019 .51 2.55 2.55 0 0017.54 0h-7.39a2.58 2.58 0 00-1.49.51 2.69 2.69 0 00-1 1.22l-.74 2H3.69a3.56 3.56 0 00-2.61 1.04A3.59 3.59 0 000 7.38v12.93a3.56 3.56 0 001.08 2.61A3.56 3.56 0 003.69 24H24a3.69 3.69 0 003.69-3.69V7.38a3.59 3.59 0 00-1.08-2.61zm-8.2 13.64a6.2 6.2 0 01-4.56 1.9 6.22 6.22 0 01-4.57-1.9 6.22 6.22 0 01-1.9-4.56 6.49 6.49 0 016.47-6.47 6.24 6.24 0 014.56 1.9 6.22 6.22 0 011.9 4.57 6.18 6.18 0 01-1.9 4.56z" />
        <path
          d="M13.85 9.69a4.17 4.17 0 00-4.16 4.16A4.17 4.17 0 0013.85 18 4.17 4.17 0 0018 13.85a4.17 4.17 0 00-4.15-4.16z" />
      </g>
    </symbol>
    <symbol id="i-search" viewBox="0 0 23.17 24">
      <path fill="#86929f"
        d="M22.82 21.86l-5.71-5.94a9.71 9.71 0 10-1.87 1.71l5.76 6a1.26 1.26 0 001.78 0 1.26 1.26 0 00.04-1.77zM9.69 2.53a7.16 7.16 0 11-7.16 7.16 7.17 7.17 0 017.16-7.16z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-video" viewBox="0 0 24 24">
      <path fill="#86929f"
        d="M12 0a12 12 0 1012 12A12 12 0 0012 0zm6.23 12.33l-8.8 6a.39.39 0 01-.23.07.45.45 0 01-.19 0 .39.39 0 01-.21-.4V6a.39.39 0 01.2-.35.42.42 0 01.42 0l8.8 6a.41.41 0 010 .66z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-balance-move" viewBox="0 0 6.93 6">
      <path fill="#484e55" d="M3.46 0l3.47 6H0z" data-name="Слой 1" />
    </symbol>
    <symbol id="i-help" viewBox="0 0 16 16">
      <circle cx="8" cy="8" r="8" />
      <path fill="#fff"
        d="M7.44 10.2a4 4 0 01.19-1.29 3.21 3.21 0 01.69-1l.9-.93a2.06 2.06 0 00.57-1.39 1.58 1.58 0 00-.37-1.12A1.4 1.4 0 008.32 4a1.63 1.63 0 00-1.12.37 1.23 1.23 0 00-.42 1H5.51a2.29 2.29 0 01.79-1.78 3 3 0 012-.68 2.75 2.75 0 012 .7 2.47 2.47 0 01.73 1.9A3.45 3.45 0 0110 7.87l-.8.73a2.32 2.32 0 00-.49 1.6zm-.05 2.16a.76.76 0 01.18-.51.72.72 0 01.56-.21.69.69 0 01.75.72.73.73 0 01-.19.52.75.75 0 01-.56.2.75.75 0 01-.56-.2.77.77 0 01-.18-.52z" />
    </symbol>
    <symbol id="i-check" viewBox="0 0 29.87 21.94">
      <path
        d="M29.43.44a1.48 1.48 0 00-2.11 0L9.43 18.33l-6.88-6.88a1.5 1.5 0 00-2.11 0 1.48 1.48 0 000 2.11l7.93 7.94a1.5 1.5 0 002.11 0l19-18.95a1.48 1.48 0 00-.05-2.11z" />
    </symbol>
    <symbol id="i-like" viewBox="0 0 25.5 22.29">
      <path
        d="M7.42 22.29h-6A1.43 1.43 0 010 20.91V9.26a1.64 1.64 0 011.45-1.6h6c.59 0 1.19.5 1.19 1.6v11.65a1.21 1.21 0 01-1.22 1.38zm-5.92-1.5h5.61V9.16H1.57a.52.52 0 00-.07.12zM19.94 21.19H18.8a.75.75 0 010-1.5h1.14c.14 0 1.38 0 1.68-.8.37-1 1.84-6.79 2.38-9A3 3 0 0023.29 8h-6.68a.75.75 0 010-1.5h6.77a1.52 1.52 0 011.19.65 4.5 4.5 0 01.89 3.06c-.08.34-2 7.91-2.44 9.15a3.15 3.15 0 01-3.08 1.83z" />
      <path
        d="M8.42 10.86a.75.75 0 01-.69-.47.74.74 0 01.42-1l1-.4 2.41-4.27a12.23 12.23 0 01.21-3.29A2.63 2.63 0 0114.07 0c.77 0 2.19.22 3.18 2.33 1.61 3.45 0 5.47-.1 5.56a.75.75 0 01-1.15-1s1.08-1.43-.11-4c-.3-.66-.84-1.45-1.64-1.47a1.52 1.52 0 00-1.09.58 14.75 14.75 0 00-.11 2.94v.21l-2.87 5.1-1.49.59a.66.66 0 01-.27.02zM12.71 21.4a.8.8 0 01-.26 0C11.2 20.9 8 19.69 8 19.69l.52-1.41s3.2 1.21 4.45 1.66a.77.77 0 01.44 1 .75.75 0 01-.7.46z" />
      <path d="M19.89 21.19h-7.11a.75.75 0 110-1.5h7.11a.75.75 0 010 1.5z" />
    </symbol>
    <symbol id="i-comment" viewBox="0 0 25.5 23.69">
      <path
        d="M24.18 18.69h-8a.75.75 0 010-1.5H24V1.55H1.5v15.61h6.68a.75.75 0 010 1.5H1.32A1.5 1.5 0 010 17.16V.94A.9.9 0 01.32.21 1 1 0 011.19 0H24.31a1 1 0 01.87.18.9.9 0 01.32.73v16.25a1.5 1.5 0 01-1.32 1.53z" />
      <path
        d="M12.18 23.69a.78.78 0 01-.48-.17.76.76 0 01-.1-1.06l3.78-4.63a.76.76 0 011.06-.1.74.74 0 01.1 1.05l-3.78 4.63a.72.72 0 01-.58.28z" />
      <path d="M12.18 23.69a.72.72 0 01-.58-.28l-3.79-4.63a.75.75 0 011.16-1l3.79 4.63a.76.76 0 01-.58 1.23z" />
    </symbol>
    <symbol id="i-repost" viewBox="0 0 27.42 20.1">
      <path
        d="M0 20.1L.5 18a15.9 15.9 0 015.05-7.88 16.62 16.62 0 0110.5-4.48 2.28 2.28 0 00.81-.08.82.82 0 00.37-.29 1.51 1.51 0 00.2-.63V0l10 10-10 10v-2.53-1.5-.54a1.27 1.27 0 000-.28 1.15 1.15 0 00-.22-.56.8.8 0 00-.37-.24 1.64 1.64 0 00-.48 0h-.86a23.64 23.64 0 00-8.2 1.25 21.35 21.35 0 00-5.62 3.2zm16.35-7.3a3.25 3.25 0 01.9.11 2.23 2.23 0 011.11.74 2.69 2.69 0 01.53 1.24V16.32L25.3 10l-6.37-6.39v1.18a2.82 2.82 0 01-.46 1.36 2.28 2.28 0 01-1.06.85 3.55 3.55 0 01-1.33.18 15.11 15.11 0 00-9.53 4.1 16 16 0 00-3.82 5 20.46 20.46 0 014.05-2A24.44 24.44 0 0115 12.81h1.32z"
        data-name="Слой 1" />
    </symbol>
    <symbol id="i-view" viewBox="0 0 25.5 17.5">
      <path
        d="M12.75 12.36a3.61 3.61 0 113.61-3.61 3.61 3.61 0 01-3.61 3.61zm0-5.72a2.11 2.11 0 102.11 2.11 2.12 2.12 0 00-2.11-2.11z" />
      <path
        d="M.75 9.5a.86.86 0 01-.27-.05.75.75 0 01-.43-1C1.79 4 7.73 0 12.77 0s10.86 3.83 12.68 8.36a.75.75 0 01-1.4.56C22.47 5 17.2 1.5 12.77 1.5S3 5 1.45 9a.74.74 0 01-.7.5z" />
      <path
        d="M12.77 17.5c-5 0-11-4-12.72-8.48a.75.75 0 01.43-1 .75.75 0 011 .43C3 12.49 8.28 16 12.77 16s9.7-3.47 11.28-7.42a.75.75 0 011.4.56c-1.82 4.53-7.63 8.36-12.68 8.36z" />
    </symbol>
    <symbol id="i-attach" viewBox="0 0 18.03 20">
      <path
        d="M16.76 12.33l-1.48-1.48-6.65-6.66a3.14 3.14 0 00-4.44 4.44l6.66 6.66a.7.7 0 001-1L5.18 7.64a1.74 1.74 0 012.46-2.46l6.66 6.65 1.48 1.48a3.14 3.14 0 01-4.44 4.44l-1.23-1.23-6.9-6.91-.5-.49a4.53 4.53 0 016.41-6.41l7.4 7.4a.71.71 0 00.67.18.69.69 0 00.49-.49.68.68 0 00-.18-.68l-7.39-7.39a5.93 5.93 0 00-8.38 8.38l7.39 7.39 1.24 1.24a4.53 4.53 0 006.4-6.41z" />
    </symbol>
    <symbol id="i-smile" viewBox="0 0 20 20">
      <path
        d="M10 0a10 10 0 1010 10A10 10 0 0010 0zm0 18.92a8.92 8.92 0 116.05-15.47 9.08 9.08 0 012 2.71 8.8 8.8 0 01.87 3.84A8.93 8.93 0 0110 18.92z" />
      <path
        d="M6.73 8.85a1.08 1.08 0 10-1.08-1.08 1.08 1.08 0 001.08 1.08zM13.42 8.85a1.08 1.08 0 10-1.08-1.08 1.08 1.08 0 001.08 1.08zM10 15.54a6.26 6.26 0 005.24-2.85l-.9-.58a5.14 5.14 0 01-8.64 0l-.9.58a6.25 6.25 0 004.5 2.81 5.48 5.48 0 00.7.04z" />
    </symbol>
    <symbol id="i-camera" viewBox="0 0 22 17.86">
      <path
        d="M0 5.46v9.71a2.69 2.69 0 002.68 2.69h16.64A2.69 2.69 0 0022 15.17V5.46a2.55 2.55 0 00-2.55-2.55h-3.58l-.08-.37A3.27 3.27 0 0012.59 0H9.41a3.27 3.27 0 00-3.2 2.54l-.09.37H2.55A2.55 2.55 0 000 5.46zM6.56 4a.56.56 0 00.54-.43l.18-.8A2.18 2.18 0 019.41 1.1h3.18a2.16 2.16 0 012.12 1.68l.19.8a.55.55 0 00.53.43h4a1.46 1.46 0 011.47 1.45v9.71a1.59 1.59 0 01-1.59 1.59H2.68a1.59 1.59 0 01-1.58-1.59V5.46A1.45 1.45 0 012.55 4z" />
      <path
        d="M3.72 7.09A.74.74 0 103 6.36a.74.74 0 00.72.73zM11 15a4.62 4.62 0 10-4.62-4.62A4.62 4.62 0 0011 15zm0-8.14a3.52 3.52 0 11-3.52 3.52A3.53 3.53 0 0111 6.89z" />
    </symbol>
    <symbol id="i-rating" viewBox="0 0 75.41 10.85">
      <path fill="#484e55"
        d="M5.71 0l2.11 3.09 3.59 1.06-2.28 3 .1 3.74L5.71 9.6l-3.53 1.25.1-3.74L0 4.15l3.59-1.06zM21.71 0l2.11 3.09 3.59 1.06-2.28 3 .1 3.74-3.52-1.29-3.53 1.25.1-3.74L16 4.15l3.59-1.06zM37.71 0l2.11 3.09 3.59 1.06-2.28 3 .1 3.74-3.52-1.29-3.53 1.25.1-3.74L32 4.15l3.59-1.06zM53.71 0l2.11 3.09 3.59 1.06-2.28 3 .1 3.74-3.52-1.29-3.53 1.25.1-3.74L48 4.15l3.59-1.06z" />
      <path fill="#c3ceda"
        d="M69.71 0l2.11 3.09 3.59 1.06-2.28 3 .1 3.74-3.52-1.29-3.53 1.25.1-3.74L64 4.15l3.59-1.06z" />
    </symbol>
    <symbol id="i-settings" viewBox="0 0 23.32 24">
      <path
        d="M12.36 11.7V.67a.68.68 0 00-1.36 0v11a3.42 3.42 0 000 6.71v4.91a.68.68 0 101.35 0v-4.88a3.42 3.42 0 000-6.71zm-.68 5.43a2.08 2.08 0 112.08-2.07 2.07 2.07 0 01-2.08 2.07zM4.1 6V.67a.68.68 0 00-1.35 0V6a3.43 3.43 0 000 6.72v10.6a.68.68 0 101.35 0V12.75A3.42 3.42 0 004.1 6zm-.68 5.43A2.07 2.07 0 115.5 9.4a2.07 2.07 0 01-2.08 2.07zM20.57 6V.67a.68.68 0 00-1.35 0V6a3.43 3.43 0 000 6.72v10.61a.68.68 0 001.35 0V12.75a3.42 3.42 0 000-6.71zm-.68 5.43A2.07 2.07 0 1122 9.4a2.07 2.07 0 01-2.11 2.07z" />
    </symbol>
    <symbol id="i-more" viewBox="0 0 17.33 4">
      <circle cx="2" cy="2" r="2" />
      <circle cx="8.67" cy="2" r="2" />
      <circle cx="15.33" cy="2" r="2" />
    </symbol>
        <symbol id="i-logout" viewBox="0 0 512 512"><path d="M453.33 512h-224a58.71 58.71 0 01-58.66-58.67v-96a16 16 0 0132 0v96A26.7 26.7 0 00229.33 480h224A26.71 26.71 0 00480 453.33V58.67A26.71 26.71 0 00453.33 32h-224a26.7 26.7 0 00-26.66 26.67v96a16 16 0 01-32 0v-96A58.71 58.71 0 01229.33 0h224A58.71 58.71 0 01512 58.67v394.66A58.71 58.71 0 01453.33 512z"/><path d="M325.33 272H16a16 16 0 010-32h309.33a16 16 0 010 32z"/><path d="M240 357.33A16 16 0 01228.69 330l74-74-74-74a16 16 0 1122.64-22.63l85.33 85.33a16 16 0 010 22.64l-85.33 85.33a15.88 15.88 0 01-11.33 4.66z"/></symbol>
  </svg>
  <div class="wrapper">
    <div class="topbar">
      <div class="container">
        <div class="topbar__inner">
          <div class="topbar__menu-btn js-menu-btn">
            <div class="menu-btn">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <div class="topbar__left-col">
            <a href="/" class="topbar__logo">Honest</a>
            <div class="topbar__search">
              <div class="topbar__search-icon">
                <svg class="svg-icon">
                  <use xlink:href="#i-search"></use>
                </svg>
              </div>
              <input type="text" placeholder="Поиск" class="topbar__search-field">
            </div>
            <div class="topbar__links">
              <div class="topbar__links-list">
                <div class="topbar__links-item">
                  <a href="#" class="topbar__links-btn">
                    <div class="topbar__links-btn-icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-audio"></use>
                      </svg>
                    </div>
                    <div class="topbar__links-btn-label">Аудио</div>
                  </a>
                </div>
                <div class="topbar__links-item">
                  <a href="#" class="topbar__links-btn">
                    <div class="topbar__links-btn-icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-photo"></use>
                      </svg>
                    </div>
                    <div class="topbar__links-btn-label">Фото</div>
                  </a>
                </div>
                <div class="topbar__links-item">
                  <a href="#" class="topbar__links-btn">
                    <div class="topbar__links-btn-icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-video"></use>
                      </svg>
                    </div>
                    <div class="topbar__links-btn-label">Видео</div>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="topbar__profile">
            <div class="topbar__profile-appointment hover">
              <div class="topbar__profile-appointment-btn">
                <svg class="svg-icon">
                  <use xlink:href="#i-appointment"></use>
                </svg>
              </div>
              <div class="topbar__profile-appointment-balloon"></div>
            </div>
            <div class="topbar__profile-location hover">
              <div class="topbar__profile-location-icon">
                <svg class="svg-icon">
                  <use xlink:href="#i-location"></use>
                </svg>
              </div>
              <div class="topbar__profile-location-label">Пятигорск</div>
            </div>
            <div class="topbar__profile-avatar hover">
              <img src="/assets/img/profile/avatar.png" alt="Магомед Евлоев">
            </div>
            <form novalidate="novalidate"  method="post" action="handlers/ajax.php" class="form-ajax form-signin-2 ajax topbar__profile-chevron hover">
            <input type="hidden" name="act" value="logout">
              <button>
              <svg class="svg-icon">
                <use xlink:href="#i-chevron"></use>
              </svg>
              </button>
            </form>
          </div>
          <form novalidate="novalidate" method="post" action="handlers/ajax.php" class="form-ajax form-signin-2 ajax topbar__m-profile">
          <input type="hidden" name="act" value="logout">
            <div class="topbar__profile-avatar hover">
              <button type="submit"><img src="/assets/img/profile/avatar.png" alt="Магомед Евлоев"></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="m-menu js-menu">
      <div class="container">
        <div class="m-menu__inner">
          <div class="m-menu__list">
            <a href="/index" class="m-menu__item is-active">Моя страница</a>
            <a href="/news" class="m-menu__item">Новости</a>
            <a href="/partners" class="m-menu__item">Партнеры</a>
            <a href="/community" class="m-menu__item">Сообщества</a>
            <a href="/investments" class="m-menu__item">Инвестиции</a>
            <a href="/motivation" class="m-menu__item">Мотивация</a>
            <a href="/education" class="m-menu__item">Обучение</a>
            <a href="/startups" class="m-menu__item">Стартапы</a>
            <a href="/store" class="m-menu__item">Маркет</a>
            <a href="/crypto" class="m-menu__item">Криптовалюта</a>
            <a href="/credit" class="m-menu__item">Кредит</a>
          </div>
        </div>
      </div>
    </div>
    <div class="header">
      <div class="container">
        <div class="header__inner">
          <div class="header__nav">
            <div class="header__nav-list js-nav-list">
              <div class="header__nav-item">
                <a href="/index" class="header__nav-btn js-nav-item is-active">Моя страница</a>
              </div>
              <div class="header__nav-item">
                <a href="/news" class="header__nav-btn js-nav-item">Новости</a>
              </div>
              <div class="header__nav-item">
                <a href="/partners" class="header__nav-btn js-nav-item">Партнеры</a>
              </div>
              <div class="header__nav-item">
                <a href="/community" class="header__nav-btn js-nav-item">Сообщества</a>
              </div>
              <div class="header__nav-item">
                <a href="/investments" class="header__nav-btn js-nav-item">Инвестиции</a>
              </div>
              <div class="header__nav-item">
                <a href="/motivation" class="header__nav-btn js-nav-item">Мотивация</a>
              </div>
              <div class="header__nav-item">
                <a href="/education" class="header__nav-btn js-nav-item">Обучение</a>
              </div>
              <div class="header__nav-item">
                <a href="/startups" class="header__nav-btn js-nav-item">Стартапы</a>
              </div>
              <div class="header__nav-item">
                <a href="/store" class="header__nav-btn js-nav-item">Маркет</a>
              </div>
              <div class="header__nav-item">
                <a href="/crypto" class="header__nav-btn js-nav-item">Криптовалюта</a>
              </div>
              <div class="header__nav-item">
                <a href="/credit" class="header__nav-btn js-nav-item ">Кредит</a>
              </div>
              <div class="header__nav-item-line js-nav-item-line"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container">
        <div class="content__row">
          <div class="content__col content__col--sidebar">
            <div class="block">
              <div class="block__inner widget widget-profile">
                <div class="widget__body">
                  <div class="widget-profile__avatar">
                    <img src="assets/img/profile/avatar_big.jpg" alt="Магомед Евлоев">
                  </div>
                  <div class="widget-profile__btn btn btn--gray">
                    Редактировать
                  </div>
                </div>
              </div>
            </div>
            <div class="block show-m">
              <div class="block__inner widget widget-balance">
                <div class="widget__title">Баланс</div>
                <div class="widget__body">
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">₽</div>
                    <div class="widget-balance__value">40.420,18</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">€</div>
                    <div class="widget-balance__value">148,45</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">$</div>
                    <div class="widget-balance__value">348,45</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">EPP</div>
                    <div class="widget-balance__value">2,121</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content__col content__col--main">
            <div class="block">
              <div class="block__inner block__inner--pdb40">
                <div class="block__title"><?=$arr['names'];?></div>
                <div class="block__content">
                  <div class="profile-info js-profile-info-list">
                    <div class="profile-info__section">
                      <div class="profile-info__section-content">
                        <div class="profile-info__row">
                          <div class="profile-info__label">День рождения:</div>
                          <div class="profile-info__value">3 мая</div>
                        </div>
                        <div class="profile-info__row">
                          <div class="profile-info__label">Город:</div>
                          <div class="profile-info__value">Назрань</div>
                        </div>
                        <div class="profile-info__row">
                          <div class="profile-info__label">Сайт:</div>
                          <div class="profile-info__value">honest.ru</div>
                        </div>
                        <div class="profile-info__row">
                          <div class="profile-info__label">Социальные сети:</div>
                          <div class="profile-info__value">@honest</div>
                        </div>
                        <div class="profile-info__row is-hidden js-profile-info-item">
                          <div class="profile-info__label">VK:</div>
                          <div class="profile-info__value">vk.com/r199rr06</div>
                        </div>
                        <div class="profile-info__row is-hidden js-profile-info-item">
                          <div class="profile-info__label">Facebook:</div>
                          <div class="profile-info__value">fb.com/r199rr06</div>
                        </div>
                        <div data-state="hidden" class="profile-info__btn hover js-profile-info-showmore">Показать
                          больше</div>
                      </div>
                    </div>
                    <div class="profile-info__section">
                      <div class="profile-info__section-title">Образование</div>
                      <div class="profile-info__section-content">
                        <div class="profile-info__row">
                          <div class="profile-info__label">ВУЗ:</div>
                          <div class="profile-info__value">КГУ</div>
                        </div>
                        <div class="profile-info__row js-profile-info-item">
                          <div class="profile-info__label">Факультет:</div>
                          <div class="profile-info__value">Физ-Мат</div>
                        </div>
                        <div class="profile-info__row js-profile-info-item">
                          <div class="profile-info__label">Год выпуска:</div>
                          <div class="profile-info__value">2014</div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-info__section">
                      <div class="profile-info__section-title">Проекты</div>
                      <div class="profile-info__section-content">
                        <div class="profile-info__row">
                          <div class="profile-info__label">Название:</div>
                          <div class="profile-info__value"><?=$arr['company'];?></div>
                        </div>
                        <div class="profile-info__row">
                          <div class="profile-info__label">Сфера:</div>
                          <div class="profile-info__value">Торговля</div>
                        </div>
                        <div class="profile-info__row js-profile-info-item">
                          <div class="profile-info__label">Годы работы:</div>
                          <div class="profile-info__value">2015 - по н.в.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="block__inner block__inner--pdb40">
                <div class="block__content">
                  <div class="news-item">
                    <div class="news-item__head">
                      <div class="news-item__head-avatar">
                        <img src="assets/img/profile/avatar_blank.png" alt="Магомед Евлоев
                        ">
                      </div>
                      <div class="news-item__head-info">
                        <div class="news-item__head-title hover">Игорь Валенсийский</div>
                        <div class="news-item__head-subtitle">два часа назад</div>
                      </div>
                      <div class="news-item__head-more hover">
                        <svg class="svg-icon">
                          <use xlink:href="#i-more"></use>
                        </svg>
                      </div>
                    </div>
                    <div class="news-item__content">
                      <div class="news-item__text">
                      На этой странице 24 июля в 11:00 состоится трансляция онлайн-форума «Forum. Digital sport 2020», организованного Фондом развития цифровой экономики. Эксперты индустрии расскажут о цифровизации спорта, передовых технологиях и проектах в спортивной области
                      </div>
                      <div class="news-item__pic">
                        <img src="assets/img/news/news_2.jpg" alt="Новость">
                      </div>
                      <a href="#" class="news-item__link">24 июля, 11:00. Онлайн-дискуссия: как трансформировать индустрию спорта
                        приложение</a>
                      <a href="#" class="news-item__link-url">rbk.ru</a>
                    </div>
                    <div class="news-item__actions">
                      <div class="news-item__actions-left">
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-like"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">214</div>
                        </div>
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-comment"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">12</div>
                        </div>
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-repost"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">15</div>
                        </div>
                      </div>
                      <div class="news-item__actions-right">
                        <div class="news-item__actions-item">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-view"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">711</div>
                        </div>
                      </div>
                    </div>
                    <div class="news-item__comments js-comments">
                      <div class="news-item__comments-filter hover">
                        <div class="news-item__comments-filter-label">Самые популярные</div>
                        <div class="news-item__comments-filter-icon">
                          <svg class="svg-icon">
                            <use xlink:href="#i-chevron"></use>
                          </svg>
                        </div>
                      </div>
                      <div class="news-item__comments-item">
                        <div class="comment">
                          <div class="comment__avatar hover">
                            <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                          </div>
                          <div class="comment__content">
                            <div class="comment__title hover">Олег Вайков</div>
                            <div class="comment__text">Опять венчурные фонды. Интересно, как это будет.</div>
                            <div class="comment__bottom-row">
                              <div class="comment__bottom-row-left">
                                <div class="comment__bottom-date">сегодня в 12:34</div>
                                <div class="comment__bottom-link">Ответить</div>
                              </div>
                              <div class="comment__bottom-row-right">
                                <div class="news-item__actions-item">
                                  <div class="news-item__actions-icon">
                                    <svg class="svg-icon">
                                      <use xlink:href="#i-like"></use>
                                    </svg>
                                  </div>
                                  <div class="news-item__actions-label">9</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="news-item__comments-showmore hover js-comments-showmore">
                        Показать следующие комментарии
                      </div>
                      <div class="news-item__comments-bottom">
                        <div class="news-item__comments-bottom-avatar">
                          <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                        </div>
                        <div class="news-item__comments-bottom-input">
                          <input type="text" placeholder="Написать комментарий"
                            class="news-item__comments-bottom-input-control">
                          <div class="news-item__comments-bottom-input-actions">
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-attach"></use>
                              </svg>
                            </div>
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-camera"></use>
                              </svg>
                            </div>
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-smile"></use>
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="block__inner block__inner--pdb40">
                <div class="block__content">
                  <div class="news-item">
                    <div class="news-item__head">
                      <div class="news-item__head-avatar">
                        <img src="assets/img/profile/avatar_big.jpg" alt="Магомед Евлоев
                        ">
                      </div>
                      <div class="news-item__head-info">
                        <div class="news-item__head-title hover">Магомед Евлоев</div>
                        <div class="news-item__head-subtitle">два часа назад</div>
                      </div>
                      <div class="news-item__head-more">
                        <svg class="svg-icon">
                          <use xlink:href="#i-more"></use>
                        </svg>
                      </div>
                    </div>
                    <div class="news-item__content">
                      <div class="news-item__text">В приложении «Сбербанк Онлайн» стало возможным сделать перевод на
                        карты Сбербанка с карт других банков. За услугу клиенты должны заплатить комиссию в 1,2%.
                        Подобные сервисы есть и у других банков, в основном они бесплатные</div>
                      <div class="news-item__pic">
                        <img src="assets/img/news/news-pic.jpg" alt="Новость">
                      </div>
                      <a href="#" class="news-item__link">Сбербанк запустил переводы с карт других банков через свое
                        приложение</a>
                      <a href="#" class="news-item__link-url">rbk.ru</a>
                    </div>
                    <div class="news-item__actions">
                      <div class="news-item__actions-left">
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-like"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">116</div>
                        </div>
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-comment"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">21</div>
                        </div>
                        <div class="news-item__actions-item hover">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-repost"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">8</div>
                        </div>
                      </div>
                      <div class="news-item__actions-right">
                        <div class="news-item__actions-item">
                          <div class="news-item__actions-icon">
                            <svg class="svg-icon">
                              <use xlink:href="#i-view"></use>
                            </svg>
                          </div>
                          <div class="news-item__actions-label">689</div>
                        </div>
                      </div>
                    </div>
                    <div class="news-item__comments js-comments">
                      <div class="news-item__comments-filter hover">
                        <div class="news-item__comments-filter-label">Самые популярные</div>
                        <div class="news-item__comments-filter-icon">
                          <svg class="svg-icon">
                            <use xlink:href="#i-chevron"></use>
                          </svg>
                        </div>
                      </div>
                      <div class="news-item__comments-item">
                        <div class="comment">
                          <div class="comment__avatar hover">
                            <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                          </div>
                          <div class="comment__content">
                            <div class="comment__title hover">Олег Олегов</div>
                            <div class="comment__text">Жалею тех кто связывается с банками. Только нал</div>
                            <div class="comment__bottom-row">
                              <div class="comment__bottom-row-left">
                                <div class="comment__bottom-date">сегодня в 12:34</div>
                                <div class="comment__bottom-link">Ответить</div>
                              </div>
                              <div class="comment__bottom-row-right">
                                <div class="news-item__actions-item">
                                  <div class="news-item__actions-icon">
                                    <svg class="svg-icon">
                                      <use xlink:href="#i-like"></use>
                                    </svg>
                                  </div>
                                  <div class="news-item__actions-label">9</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="news-item__comments-item">
                        <div class="comment">
                          <div class="comment__avatar hover">
                            <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                          </div>
                          <div class="comment__content">
                            <div class="comment__title hover">Артур Артуров</div>
                            <div class="comment__text">что бы переложить деньги из одного кармана в другой ты должен
                              отдать постороннему дяде 1,2%</div>
                            <div class="comment__bottom-row">
                              <div class="comment__bottom-row-left">
                                <div class="comment__bottom-date">сегодня в 12:34</div>
                                <div class="comment__bottom-link">Ответить</div>
                              </div>
                              <div class="comment__bottom-row-right">
                                <div class="news-item__actions-item">
                                  <div class="news-item__actions-icon">
                                    <svg class="svg-icon">
                                      <use xlink:href="#i-like"></use>
                                    </svg>
                                  </div>
                                  <div class="news-item__actions-label">9</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="news-item__comments-item">
                        <div class="comment">
                          <div class="comment__avatar hover">
                            <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                          </div>
                          <div class="comment__content">
                            <div class="comment__title hover">Игорь Игорев</div>
                            <div class="comment__text">то чувство когда в любом банке это работает уже лет 5 и бесплатно
                              какой президент такой и главный банк - позорный.</div>
                            <div class="comment__bottom-row">
                              <div class="comment__bottom-row-left">
                                <div class="comment__bottom-date">сегодня в 12:34</div>
                                <div class="comment__bottom-link">Ответить</div>
                              </div>
                              <div class="comment__bottom-row-right">
                                <div class="news-item__actions-item">
                                  <div class="news-item__actions-icon">
                                    <svg class="svg-icon">
                                      <use xlink:href="#i-like"></use>
                                    </svg>
                                  </div>
                                  <div class="news-item__actions-label">9</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="news-item__comments-showmore hover js-comments-showmore">
                        Показать следующие комментарии
                      </div>
                      <div class="news-item__comments-bottom">
                        <div class="news-item__comments-bottom-avatar">
                          <img src="/assets/img/profile/avatar_blank.png" alt="Игорь Игорев">
                        </div>
                        <div class="news-item__comments-bottom-input">
                          <input type="text" placeholder="Написать комментарий"
                            class="news-item__comments-bottom-input-control">
                          <div class="news-item__comments-bottom-input-actions">
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-attach"></use>
                              </svg>
                            </div>
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-camera"></use>
                              </svg>
                            </div>
                            <div class="news-item__comments-bottom-input-actions-btn hover">
                              <svg class="svg-icon">
                                <use xlink:href="#i-smile"></use>
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content__col content__col--sidebar">
            <div class="block hide-m">
              <div class="block__inner widget widget-balance">
                <div class="widget__title">Баланс</div>
                <div class="widget__body">
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">₽</div>
                    <div class="widget-balance__value">40.420,18</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">€</div>
                    <div class="widget-balance__value">148,45</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">$</div>
                    <div class="widget-balance__value">348,45</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                  <div class="widget-balance__row">
                    <div class="widget-balance__label">EPP</div>
                    <div class="widget-balance__value">2,121</div>
                    <div class="widget-balance__icon">
                      <svg class="svg-icon">
                        <use xlink:href="#i-balance-move"></use>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="block__inner widget widget-rating">
                <div class="widget__title">
                  Рейтинг
                  <div class="widget__title-btn hover widget__title-btn--blue">
                    <svg class="svg-icon">
                      <use xlink:href="#i-help"></use>
                    </svg>
                  </div>
                </div>
                <div class="widget__body">
                  <div class="widget-rating__row">
                    <div class="widget-rating__label">Информация о себе</div>
                    <div class="widget-rating__diagram">
                      <div class="widget-rating__diagram-bg">
                        <svg id="i-diagram-bg" class="widget-rating__diagram-bg-svg" viewport="0 0 64 64" version="1.1"
                          xmlns="http://www.w3.org/2000/svg">
                          <circle r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500"
                            stroke-dashoffset="1"></circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-lay">
                        <svg id="i-diagram-lay" class="widget-rating__diagram-lay-svg" viewport="0 0 64 64"
                          version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle id="info-bar" r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500">
                          </circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-value">67</div>
                    </div>
                  </div>
                  <div class="widget-rating__row">
                    <div class="widget-rating__label">Заключенные сделки</div>
                    <div class="widget-rating__diagram">
                      <div class="widget-rating__diagram-bg">
                        <svg id="i-diagram-bg" class="widget-rating__diagram-bg-svg" viewport="0 0 64 64" version="1.1"
                          xmlns="http://www.w3.org/2000/svg">
                          <circle r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500"
                            stroke-dashoffset="1"></circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-lay">
                        <svg id="i-diagram-lay" class="widget-rating__diagram-lay-svg" viewport="0 0 64 64"
                          version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle id="deals-bar" r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500">
                          </circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-value">18</div>
                    </div>
                  </div>
                  <div class="widget-rating__row">
                    <div class="widget-rating__label">Обучение</div>
                    <div class="widget-rating__diagram">
                      <div class="widget-rating__diagram-bg">
                        <svg id="i-diagram-bg" class="widget-rating__diagram-bg-svg" viewport="0 0 64 64" version="1.1"
                          xmlns="http://www.w3.org/2000/svg">
                          <circle r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500"
                            stroke-dashoffset="1"></circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-lay">
                        <svg id="i-diagram-lay" class="widget-rating__diagram-lay-svg" viewport="0 0 64 64"
                          version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle id="study-bar" r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500">
                          </circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-value">88</div>
                    </div>
                  </div>
                  <div class="widget-rating__row">
                    <div class="widget-rating__label">Партнеры</div>
                    <div class="widget-rating__diagram">
                      <div class="widget-rating__diagram-bg">
                        <svg id="i-diagram-bg" class="widget-rating__diagram-bg-svg" viewport="0 0 64 64" version="1.1"
                          xmlns="http://www.w3.org/2000/svg">
                          <circle r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500"
                            stroke-dashoffset="1"></circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-lay">
                        <svg id="i-diagram-lay" class="widget-rating__diagram-lay-svg is-complete" viewport="0 0 64 64"
                          version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle id="partners-bar" r="26" cx="32" cy="32" fill="transparent" stroke-dasharray="500">
                          </circle>
                        </svg>
                      </div>
                      <div class="widget-rating__diagram-value-icon is-complete">
                        <svg class="svg-icon">
                          <use xlink:href="#i-check"></use>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="block__inner widget widget-deals">
                <div class="widget__title">
                  Сделки
                  <div class="widget__title-btn hover widget__title-btn--blue">
                    <svg class="svg-icon">
                      <use xlink:href="#i-help"></use>
                    </svg>
                  </div>
                </div>
                <div class="widget__body">
                  <div class="widget-deals__row widget-deals__item">
                    <div class="widget-deals__item-head">
                      <div class="widget-deals__item-avatar">
                        <img src="/assets/img/profile/avatar_blank.png" alt="Алексей Ларионов">
                      </div>
                      <div class="widget-deals__item-info">
                        <div class="widget-deals__item-title hover">Алексей Ларионов</div>
                        <div class="widget-deals__item-rating hover">
                          <svg class="svg-icon">
                            <use xlink:href="#i-rating"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div class="widget-deals__item-content">
                      <p>Спасибо продавцу. Товар был быстро
                        собран и отправлен по указанному
                        адресу. Все отличного качества. </p>
                    </div>
                  </div>
                  <div class="widget-deals__row widget-deals__item">
                    <div class="widget-deals__item-head">
                      <div class="widget-deals__item-avatar">
                        <img src="/assets/img/profile/avatar_blank.png" alt="Алексей Ларионов">
                      </div>
                      <div class="widget-deals__item-info">
                        <div class="widget-deals__item-title hover">Алексей Ларионов</div>
                        <div class="widget-deals__item-rating hover">
                          <svg class="svg-icon">
                            <use xlink:href="#i-rating"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div class="widget-deals__item-content">
                      <p>Спасибо продавцу. Товар был быстро
                        собран и отправлен по указанному
                        адресу. Все отличного качества. </p>
                    </div>
                  </div>
                  <div class="widget-deals__row widget-deals__item">
                    <div class="widget-deals__item-head">
                      <div class="widget-deals__item-avatar">
                        <img src="/assets/img/profile/avatar_blank.png" alt="Алексей Ларионов">
                      </div>
                      <div class="widget-deals__item-info">
                        <div class="widget-deals__item-title hover">Алексей Ларионов</div>
                        <div class="widget-deals__item-rating hover">
                          <svg class="svg-icon">
                            <use xlink:href="#i-rating"></use>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div class="widget-deals__item-content">
                      <p>Спасибо продавцу. Товар был быстро
                        собран и отправлен по указанному
                        адресу. Все отличного качества. </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block block--noshadow block--transbg">
              <div class="sidebar-links">
                <a href="#" class="sidebar-links__item hover">Политика конфиденциальности</a>
                <a href="#" class="sidebar-links__item hover">Условия использования</a>
                <a href="#" class="sidebar-links__item hover">Реклама</a>
                <a href="#" class="sidebar-links__item hover">Вакансии</a>
                <a href="#" class="sidebar-links__item hover">О нас</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="assets/js/bundle.js"></script>
</body>

</html>