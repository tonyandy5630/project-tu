<?php


function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

function loadView(string $view, $title, string $role = USER, $data = [])
{
    loadPartial('head', $title);
    $role === USER ? loadPartial('member_header') : loadPartial('admin_header');
    extract($data);
    include basePath("../view/{$view}.view.php");
    loadPartial('footer');
}

function loadPartial($partial, ?string $title = 'Document')
{
    include basePath("../view/partials/{$partial}.php");
}

function loadLayout($role)
{
    include basePath("../view/partials/_{$role}_layout.php");
}

function loadDB()
{
    require('../database/dbhelper.php');
}

function loadModel($model)
{
    require_once("../model/{$model}.php");
}
