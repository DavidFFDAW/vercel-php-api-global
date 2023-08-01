<?php

class WrestlerController extends BaseController
{

    public function getAll()
    {
        $wrestlers = Wrestler::findAll();
        return $this->response($wrestlers, 'wrestlers');
    }

    public function getActiveWrestlers()
    {
        $active = Wrestler::findBy([array('status', '=', "active")]);
        return $this->response($active, 'wrestlers');
    }

    public function getReleasedWrestlers()
    {
        $released = Wrestler::findBy([array('status', '=', "released")]);
        return $this->response($released, 'wrestlers');
    }

    public function findWithChampionships()
    {
        $final = array();
        $sql = "SELECT wr.id, wr.name, wr.sex AS sex, wr.brand AS brand, wr.status AS status, wr.image_name AS image, wr.overall AS overall,
        ( SELECT chs.name FROM wrestler w INNER JOIN championship_reigns chr ON chr.wrestler_id = w.id INNER JOIN championship chs ON chs.id = chr.championship_id WHERE w.id = wr.id AND chs.tag = FALSE AND chr.current = TRUE AND chs.active = TRUE ) AS championship ,
        ( SELECT chs.image FROM wrestler w INNER JOIN championship_reigns chr ON chr.wrestler_id = w.id INNER JOIN championship chs ON chs.id = chr.championship_id WHERE w.id = wr.id AND chs.tag = FALSE AND chr.current = TRUE AND chs.active = TRUE ) AS championship_image
        FROM wrestler wr WHERE wr.status = 'active' ORDER BY wr.name ASC";

        $result = Wrestler::query($sql);

        foreach ($result as $single) {
            $current = array(
                'id' => $single['id'],
                'name' => $single['name'],
                'sex' => $single['sex'],
                'brand' => $single['brand'],
                'status' => $single['status'],
                'image' => $single['image'],
                'overall' => $single['overal'],
            );

            if ($single['championship']) {
                $current['championship'] = array(
                    'name' => $single['championship'],
                    'image' => $single['championship_image'],
                );
            }

            $final[] = $current;
        }

        return $this->response($final, 'wrestlers', 200);
    }

    public function getSingleWrestler(Request $req)
    {
        $id = $this->getTheRequestID($req);
        $singleWrestler = Wrestler::find($id);

        if (empty($singleWrestler)) throw new ApiException("Impossible to retrieve a wrestler with this ID");

        return $this->response($singleWrestler, "wrestler", 200);
    }


    public function upsert(Request $req)
    {
        $wrestler = new Wrestler();
        $body = $this->getCheckedDatas($wrestler, $req->body);
        $result = $wrestler->upsert($body);
        Debug::ddAPI($body);
    }

    public function statusChange(Request $req)
    {
    }


    public function delete(Request $req)
    {
        $id = $this->getTheRequestID($req);
        $deleted = Wrestler::delete($id);

        return $this->response($deleted, 'deleted', 200);
    }
}
