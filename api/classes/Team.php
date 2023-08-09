<?php
    
class Team extends BaseModel {
    public static $tableS = 'teams';
    public $_table = 'teams';
    protected $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'id' => new Field(
                'id', 'id', false, 'i'
            ),
            'name' => new Field(
                'name', 'name', true, 's'
            ),
            'average' => new Field(
                'average', 'average', true, 'i'
            ),
            'member_champion_1' => new Field(
                'member_champion_1','member_champion_1', false, 'i'
            ),
            'member_champion_2' => new Field(
                'member_champion_2','member_champion_2', false, 'i'
            ),
            'brand' => new Field(
                'brand','brand', false, 'i'
            ),
        );
    }

    public static function findAll() {
        $sql = "SELECT t.id AS id, t.name AS `name`, t.average AS average, w1.name AS member_champion_1, w1.image_name AS member_champion_1_image, w2.name AS member_champion_2, w2.image_name AS member_champion_2_image FROM teams t LEFT JOIN wrestler w1 ON t.member_champion_1 = w1.id LEFT JOIN wrestler w2 ON t.member_champion_2 = w2.id";
        return Db::getInstance()->query($sql);
    }

    public static function getTeamMembers() {
        $sql = "SELECT wt.*, w.name, w.image_name FROM wrestler_team wt INNER JOIN wrestler w ON w.id = wt.wrestler_id";
        return Db::getInstance()->query($sql);
    }

    public static function assignTeamMembers($teams, $teamMembers) {
        foreach ($teams as &$team) {
            foreach ($teamMembers as $member) {
                if ($member['team_id'] === $team['id'])
                    $team['members'][] = $member;                
            }
        }

        return $teams;
    }

    public static function getAllTeamsWithMembers() {
        $teams = self::findAll();
        $teamMembers = self::getTeamMembers();

        return self::assignTeamMembers($teams, $teamMembers);
    }

    public static function getSingleTeam($id) {
        $sql = "SELECT t.id AS id, t.name AS `name`, t.average AS average, w1.name AS member_champion_1, w1.image_name AS member_champion_1_image, w2.name AS member_champion_2, w2.image_name AS member_champion_2_image FROM teams t LEFT JOIN wrestler w1 ON t.member_champion_1 = w1.id LEFT JOIN wrestler w2 ON t.member_champion_2 = w2.id WHERE t.id = $id";
        return Db::getInstance()->query($sql);
    }

    public static function getSingleTeamWithMembers($id) {
        $sql ="SELECT wt.*, w.name, w.image_name FROM wrestler_team wt INNER JOIN wrestler w ON w.id = wt.wrestler_id WHERE wt.team_id = $id";
        return Db::getInstance()->query($sql);
    }

    public static function  getSingleTeamWithMembersById($id) {
        $team = self::getSingleTeam($id);
        $teamMembers = self::getSingleTeamWithMembers($id);

        return self::assignTeamMembers($team, $teamMembers);
    }

    // function createTeam($body) {
    //     if (!body || Object.keys(body).length === 0) {
    //         throw new Error("No body provided");
    //     }

    //     const missingEntries = Object.entries(body).filter(([key, _]) => {
    //         return this.createParams.includes(key);
    //     });

    //     if (missingEntries.length > 0) {
    //         throw new Error("Missing entries: " + missingEntries.join(", "));
    //     }

    //     return missingEntries;
    // }
}