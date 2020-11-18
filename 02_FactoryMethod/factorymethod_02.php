<?php

// Giả sử bạn đang xây dựng một chức năng đăng tin lên facebook, nhưng một lúc nào đó dịch vụ này yêu cầu là 
// phải đăng tin lên instagram hoặc facebook

class Twitter{
    public function postToTweet($text)
    {
        echo $text;
    }
}

class Instagram{
    public function postToInstagram($text)
    {
        echo $text;
    }
}

class Facebook{
    public function postToFacebook($text)
    {
        echo $text;
    }
}

interface ServiceInterface
{
    public function post($text);
}

class TwitterService implements ServiceInterface
{
    protected $service;
    public function __construct()
    {
        $this->service = new Twitter();
    }

    public function post($text)
    {
        $this->service->postToTweet($text);
    }
}

class FacebookService implements ServiceInterface
{
    protected $service;
    public function __construct()
    {
        $this->service = new Facebook();
    }

    public function post($text)
    {
        $this->service->postToFacebook($text);
    }
}

class InstagramService implements ServiceInterface
{
    protected $service;
    public function __construct()
    {
        $this->service = new Instagram();
    }

    public function post($text)
    {
        $this->service->postToInstagram($text);
    }
}

class Post
{
    protected $service;

    public function setServiceAdapter(ServiceInterface $service)
    {
        $this->service = $service;
    }
    public function send()
    {
        $this->service->post($this->description);
    }
}

// tạo một bài đăng và đăng lên twitter, facebook hoặc instagram
$post = new Post();
// nếu bạn muốn đăng lên Twitter
// $post->setServiceAdapter(new TwitterService()); 
// nếu bạn muốn đăng lên Instagram
// $post->setServiceAdapter(new InstagramService()); 
// nếu bạn muốn đăng lên Facebook
$post->setServiceAdapter(new FacebookService());

$post->description = 'My first post to Facebook. Just for fun!';

$post->send();