<?php
    
class Twitter extends BaseModel {
    public static $tableS = 'tweets';
    public $_table = 'tweets';
    protected $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'id' => new Field(
                'id', 'id', false, 'i'
            ),
            'message' => new Field(
                'message', 'message', true, 's'
            ),
            'likes' => new Field(
                'likes', 'likes', true, 'i'
            ),
            'retweets' => new Field(
                'retweets','retweets', true, 'i'
            ),
            'device' => new Field(
                'device','device', true, 's'
            ),
            'author_id' => new Field(
                'author_id','author_id', true, 'i'
            ),
            'comments' => new Field(
                'comments','comments', true, 'i'
            ),
            'reply_to' => new Field(
                'reply_to','reply_to', false, 'i'
            ),
        );
    }

    public static function getNoReplyTweets() {
        $sql = "SELECT t.*, w.twitter_name AS wrestler_name, w.twitter_image AS wrestler_image, w.twitter_acc AS twitter_account FROM ".static::$tableS." t INNER JOIN wrestler w ON t.author_id = w.id WHERE reply_to IS NULL ORDER BY t.created_at DESC";
        return Db::getInstance()->query($sql);
    }

    public static function getRepliesTweets() {
        $sql = "SELECT t.*, w.twitter_name AS wrestler_name, w.twitter_image AS wrestler_image, w.twitter_acc AS twitter_account FROM ".static::$tableS." t INNER JOIN wrestler w ON t.author_id = w.id WHERE reply_to IS NOT NULL ORDER BY t.created_at DESC";
        return Db::getInstance()->query($sql);
    }

    public static function getAdminAllTweets() {
        $sql = "SELECT t.*, w.twitter_name AS wrestler_name, w.twitter_image AS wrestler_image, w.twitter_acc AS twitter_account, t.reply_to FROM ".static::$tableS." t INNER JOIN wrestler w ON t.author_id = w.id ORDER BY t.created_at DESC";
        return Db::getInstance()->query($sql);
    }

    public static function assignRepliesToTweets($tweets, $replies) {
        foreach ($tweets as &$tweet) {
            foreach ($replies as $reply) {
                if ($reply['reply_to'] === $tweet['id'])
                    $tweet['replies'][] = $reply;
            }
        }
        return $tweets;
    }

    public static function getAllTweetsWithReplies() {
        $tweets = self::getNoReplyTweets();
        $replies = self::getRepliesTweets();

        return self::assignRepliesToTweets($tweets, $replies);
    }

    public static function getSingleTweetById($id) {
        $sql = "SELECT t.*, w.twitter_name AS wrestler_name, w.twitter_image AS wrestler_image, w.twitter_acc AS twitter_account FROM tweets t INNER JOIN wrestler w ON t.author_id = w.id WHERE t.id =$id";
        return Db::getInstance()->query($sql);
    }

    public static function getRepliesToTweet($id) {
        $sql = "SELECT t.*, w.twitter_name AS wrestler_name, w.twitter_image AS wrestler_image, w.twitter_acc AS twitter_account FROM tweets t INNER JOIN wrestler w ON t.author_id = w.id WHERE t.reply_to = $id ORDER BY t.created_at DESC";
        return Db::getInstance()->query($sql);
    }

    public static function getSingleTweetWithReplies($id) {
        $tweet = self::getSingleTweetById($id);
        $replies = self::getRepliesToTweet($id);

        return self::assignRepliesToTweets($tweet, $replies)[0];
    }
}