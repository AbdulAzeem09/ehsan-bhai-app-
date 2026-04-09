<?php

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"];

// Compute the web sub-path so $BaseUrl works correctly in subdirectory deployments
// (e.g. http://localhost/SHAREPAGE_CODES-Hafiz_Dev) as well as from the web root.
$_bu_doc_root  = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$_bu_proj_root = rtrim(str_replace('\\', '/', dirname(__DIR__)), '/');
$_bu_sub_path  = (strpos($_bu_proj_root, $_bu_doc_root) === 0)
                 ? substr($_bu_proj_root, strlen($_bu_doc_root))
                 : '';
$BaseUrl = $actual_link . rtrim($_bu_sub_path, '/');

?>
