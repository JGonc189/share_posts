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
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // Validate data
                if(empty($data['title'])) {
                    $data['title_err'] = 'Please enter Title...';
                }
                
                if(empty($data['body'])) {
                    $data['body_err'] = 'Please enter Body Text....';
                }

                // make sure there are no errors
                if(empty($data['title_err']) && empty($data['body_err'])) {
                    // validated
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    // load the view
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
    
                $this->view('posts/add', $data);

            }

            
        }
    }