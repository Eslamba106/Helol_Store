<?php

return [
    [
        "icon"   => "nav-icon fas fa-tachometer-alt",
        "route"  => "dashboard.dashboard",
        "title"  => "Dashboard",
        "active" => "dashboard.dashboard",
    ],
    [
        "icon"  => "far fa-circle nav-icon",
        "route" => "dashboard.categories.index",
        "title" => "Categories",
        "badge" => "Eslam",
        "active"=> "dashboard.categories.*",
    ],
    [
        "icon"  => "far fa-circle nav-icon",
        "route" => "dashboard.products.index",
        "title" => "Products",
        // "badge" => "Eslam",
        "active"=> "dashboard.products.*",
    ],
    [
        "icon"  => "far fa-circle nav-icon",
        "route" => "home",
        "title" => "Front Office",
        // "badge" => "Eslam",
        "active"=> "/.*",
    ],
];
