<?php
function postTop6LatestHome()
{
    try {
        $status = STATUS_PUBLIC;
        $sql = "SELECT * FROM products WHERE status_id = $status 
                ORDER BY view_count DESC ";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        // $stmt = $GLOBALS['conn']->bindparam(':id_product', $postTopViewHomeID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}
