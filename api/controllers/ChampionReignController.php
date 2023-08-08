<?php
    
class ChampionReignController extends BaseController {

    public function getAll() {
        $reigns = ChampionReign::getChampionshipReigns();
        return $this->response($reigns, "championship_reigns", 200);
    }

    public function getSingleReign(Request $rq) {
        $id = $rq->params->id;
        if (!isset($id) || empty($id)) throw new ApiException("No ID is present in request");

        return $this->response(
            ChampionReign::findOneTitleReignByID($id)[0], 
            "championship_reign", 
            200
        );
    }

    public function createTitleReign() {
        // TODO: If title is tag team and team_id exists -> assign current team to reign
        // TODO: If title is tag team and team_id does not exists and has the team creation 
        // TODO: datas -> create team and assign current team to reign.
        // TODO: If is tag team and team does not exist -> create team
        // TODO: If current decurrentize every champion with this championship and currentize this new champion
        // TODO: Update previous champion for this belt and add lost_date with today date ↑ (join)
    }
}