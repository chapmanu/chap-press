<?php

class createPostsAndCommentsTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown()
    {
        // your tear down methods here
        parent::tearDown();
    }

    // tests
    public function testCreateTestPosts()
    {
        $post_id = $this->factory->post->create();
        $post_id_array = $this->factory->post->create_many( 4 );
    }

    public function testCreateMultipleUsers() {
        $user_id = $this->factory->user->create( array( 'user_login' => 'test', 'role' => 'administrator' ) );
        $user_id_array = $this->factory->user->create_many( 4 );
    }

   public function testCreateTestComments() {
        $comment_id = $this->factory->comment->create();
        $comment_id_array = $this->factory->comment->create_many( 4 );
    }

}