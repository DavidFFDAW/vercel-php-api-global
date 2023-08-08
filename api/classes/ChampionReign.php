<?php class ChampionReign extends BaseModel {
    public static $tableS = 'championship_reigns';
    public $_table = 'championship_reigns';
    protected $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'id' => new Field('id',                  'id',          false, 'i'),
            'days' => new Field('days',              'days',        true, 'i'),
            'current' => new Field('current',        'current',     true, 'i'),
            'wrestler_id' => new Field('wrestler_id','wrestler_id', true, 'i'),
            'championship_id' => new Field(
                'championship_id','championship_id', true, 'i'
            ),
            'won_date' => new Field('won_date',      'won_date',    true, 's'),
            'lost_date' => new Field('lost_date',    'lost_date',   true, 's'),
        );
    }

    private static function parseResponse($resultRows) {
        if (!$resultRows || count($resultRows) < 0) return [];
        $finalArray = array();

        foreach ($resultRows as $reign) {
            $reignDatas = array(
                'title_reign_id' => $reign['id'],
                'wrestler' => array(
                    'id' => $reign['wrestler_id'],
                    'name' => $reign['wrestler_name'],
                    'image' => $reign['wrestler_image'],
                    'sex' => $reign['wrestler_sex'],
                ),
                'championship' => array(
                    'id' => $reign['championship_id'],
                    'name' => $reign['championship_name'],
                    'image' => $reign['championship_image'],
                    'tag' => $reign['championship_tag'],
                ),
                'team' => array(
                    'id' => $reign['team_id'],
                    'name' => $reign['team_name'],
                ),
                'days' => $reign['days'],
                'current' => $reign['current'],
                'won_date' => $reign['won_date'],
                'lost_date' => $reign['lost_date'],
                'created_at' => $reign['created_at'],
                'updated_at' => $reign['updated_at'],
            );
            $finalArray[] = $reignDatas;
        }

        return $finalArray;
    }

    public static function getChampionshipReigns() {
        $sql = "SELECT cr.*, t.name AS team_name, w.name AS wrestler_name, w.image_name AS wrestler_image, w.sex AS wrestler_sex, c.tag AS championship_tag, c.name AS championship_name, c.image AS championship_image, c.gender AS championship_gender FROM championship_reigns cr INNER JOIN wrestler w ON w.id = cr.wrestler_id INNER JOIN championship c ON cr.championship_id = c.id LEFT JOIN teams t ON t.id = cr.wrestler_id WHERE c.active = TRUE ORDER BY days DESC";
        $result = Db::getInstance()->query($sql);
        return self::parseResponse($result);
    }

    public static function findOneTitleReignByID($id) {
        $sql = "SELECT cr.*, t.name AS team_name, w.name AS wrestler_name, w.image_name AS wrestler_image, w.sex AS wrestler_sex, c.tag AS championship_tag, c.name AS championship_name, c.image AS championship_image, c.gender AS championship_gender FROM championship_reigns cr INNER JOIN wrestler w ON w.id = cr.wrestler_id INNER JOIN championship c ON cr.championship_id = c.id LEFT JOIN teams t ON t.id = cr.wrestler_id WHERE cr.id = $id ORDER BY days DESC LIMIT 1";
        $result = Db::getInstance()->query($sql);
        return self::parseResponse($result);
    }
}