<?php

    class products extends model /*classe*/
    {
        //métodos para listar os produtos
        public function getList()/*função*/
        {
            //armazena os produtos em array
            $array = array();
           
            //fazer a listagem dos produtos
            /*produto ligado à marca e depois ligado à categoria*/
            $sql ="SELECT *,
            (select brands.name from brands where brands.id = products.id_brand) as brand_name,
           
            (select categories.name from categories where categories.id = products.id_category) as category_name
           
            FROM products";
            $sql = $this->db->query($sql);
           
            // se existir produtos
            if($sql->rowCount()>0)
            {
                $array = $sql->fetchAll();  
               
                /*buscar as imagens de cada produto*/
               
                foreach($array as $key=>$item)
                {
                    $array[$key]['images'] = $this->getImagesByProductId($item['id']);
                }
            }
             return $array;
        }
        //método para buscar imagens
        public function getImagesbyProductId($id)
        {
            $array = array();
           
            $sql = "SELECT url FROM products_images WHERE id_product = :id";
            $sql= $this->db->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();
           
            //verificar se existe imagem
            if($sql->rowCount()> 0)
            {
                $array = $sql->fetchAll();
            }
               
           
           
            return $array;
           
           
        }  
       
    }
