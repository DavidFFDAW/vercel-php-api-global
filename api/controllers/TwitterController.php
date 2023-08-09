<?php
    
class TwitterController extends BaseController {
    public function getAllTweetsWithReplies() {
        return $this->response(Twitter::getAllTweetsWithReplies(), 'tweets', 200);
    }

    public function getAdminAllTweets() {
        return $this->response(Twitter::getAdminAllTweets(), 'tweets', 200);
    }

    public function getSingleTweetWithReplies(Request $rq) {
        $id = $this->getTheRequestID($rq);
        return $this->response(Twitter::getSingleTweetWithReplies($id), 'tweets', 200);
    }

    public function upsertTweet(Request $rq) {
        $twitter = new Twitter();
        $datas = $this->getCheckedDatas($twitter, $rq->body);
        return $this->response($twitter->upsert($datas), "upserted", 200);
    }
    
    public function deleteTweet(Request $rq) {
        $id = $this->getTheRequestID($rq);
        $deleted = Twitter::delete($id);
        return $this->response($deleted, "deleted", 200);
    }

}