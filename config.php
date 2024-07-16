<?php
    date_default_timezone_set('Europe/Paris');
    Locale::setDefault('fr_FR.utf-8');
    const LOCALE = "fr-FR";

    const SECRET_APP = "HyrAuKumatta";

    // Database
    const DB_HOST = "localhost"; //db5014948173.hosting-data.io
    const DB_NAME = "dbs5645721"; //dbs12424720
    const DB_USER = "root"; //dbu2416975
    const DB_PASS = ""; //db#67%LesAgit!2008

    // Miscellaneous
    define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']);
    const COMMON_FUNCTIONS = "common-functions.php";

    // Main controller, action and view
    const DEFAULT_CTRL = "home";
    const DEFAULT_ACTION = "index";
    const HOME_CTRL = "App\\Controller\\HomeController";
    const VIEW_PATH = "view/";

    // Users
    const ROLE_ADMIN = "ROLE_ADMIN_LESAA_67";
    const ROLE_ACCOUNT = "ROLE_ACCOUNT_LESAA_67";

    // Assets paths
    const CSS_PATH = "public/css/";
    const ASSETS_PATH = "public/assets/";
    const IMG_PATH = "public/assets/images/";
    const LOGO_PATH = "public/assets/logos/";
    const IMG_ABOUT = "public/assets/images/about/";
    const IMG_BLOG = "public/assets/images/blog/";
    const IMG_PLAY = "public/assets/images/play/";
    const IMG_PLAY_FLYERS = "public/assets/images/play/flyers/";
    const IMG_TEAM = "public/assets/images/team/";
    const NO_IMAGE = "public/assets/images/noimage.png";
    const JS_PATH = "public/js/";

    // Admin paths
    const ADMIN_CTRL = "App\\Controller\\Admin\\AdminController";
    const VIEW_ADMIN_PATH = "view/admin/";