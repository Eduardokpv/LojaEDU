<?php
class products extends model{
    public function getList(){
        $array = array();
        $sql = "SELECT * FROM products";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0){
            
        }
    }
}
?>
