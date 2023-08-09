<?php
    
class TeamController extends BaseController {

    public function getAll() {
        return $this->response(Team::findAll(), 'teams', 200);
    }
    
    public function getAllTeamsWithMembers() {
        return $this->response(Team::getAllTeamsWithMembers(), 'teams', 200);
    }
    
    public function getSingleTeam(Request $request) {
        $id = $this->getTheRequestID($request);
        return $this->response(Team::getSingleTeam($id), 'teams', 200);
    }
    
    public function getSingleTeamWithMembersById(Request $request) {
        $id = $this->getTheRequestID($request);
        return $this->response(Team::getSingleTeamWithMembersById($id), 'teams', 200);
    }

    public function upsertTeam(Request $request) {
        $team = new Team();

        $datas = $this->getCheckedDatas($team, $request->body);
        $upserted = $team->upsert($datas);

        return $this->response($upserted, 'upserted', 200);
    }
}