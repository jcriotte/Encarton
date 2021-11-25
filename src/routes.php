<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    //'' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'contact' => ['ResultController', 'contact',],
    'genre' => ['TestMSApiController', 'index',],
    'Result/artist' => ['ResultController','artist'],
    'Result/album' => ['ResultController','album'],
    '' => ['WelcomeController', 'index'],
    'artist/search' => ['ArtistController', 'SearchArtist', ['input']],
    'AboutUs' => ['WelcomeController', 'about'],
];
