<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){  
      if(isLoggedIn()) {
        redirect('posts');
      }

      $data = [
        'title' => 'SharePosts',
        'description' => 'Simple social network built with a custom MVC php Framework'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'An App to share posts with other users!'
      ];

      $this->view('pages/about', $data);
    }
  }