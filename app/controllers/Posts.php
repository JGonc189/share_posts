<?php
    class Posts extends Controller {
        public function __construct() {
            // if we're not logged in
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
        }

        public function index() {
            // get posts
            $post = $this->postModel->getPosts();

            $data = [
                'posts' => $post
            ];
            
            $this->view('posts/index', $data);


        }

        public function add() {
            $data = [
                'title' => '',
                'body' => ''
            ];
            
            $this->view('posts/add', $data);
        }
    }