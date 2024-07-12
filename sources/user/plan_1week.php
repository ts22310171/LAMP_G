<?php
class cplan extends crecord
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_plans($debug)
    {
        $query = <<< END_BLOCK
select
plans.*
from
plans
order by
plans.id asc
END_BLOCK;

        $prep_arr = array();

        $this->select_query(
            $debug,
            $query,
            $prep_arr
        );

        $arr = array();
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function get_plan_by_id($debug, $id)
    {
        if (!cutil::is_number($id) || $id < 1) {
            return false;
        }

        $query = <<< END_BLOCK
select
plans.*
from
plans
where
id = :id
END_BLOCK;

        $prep_arr = array(
            ':id' => (int)$id
        );

        $this->select_query(
            $debug,
            $query,
            $prep_arr
        );

        return $this->fetch_assoc();
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}
?>
