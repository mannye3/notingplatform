<?php
  class Listing {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }



     public function getPropertyByRef($ref_id){
      $this->db->query('SELECT * FROM property WHERE ref_id = :ref_id');
      $this->db->bind(':ref_id', $ref_id);

      $row = $this->db->single();

      return $row;
    }



    public function getPropertyPictures($ref_id){
      $this->db->query('SELECT * FROM pro_img WHERE ref_id = :ref_id');
      $this->db->bind(':ref_id', $ref_id);

      $results = $this->db->resultSet();

      return $results;
    }


     public function getPictureByid($id){
      $this->db->query('SELECT * FROM pro_img WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }



        public function getPropertyImg($user_id,$ref_id){
      $this->db->query('SELECT * FROM pro_img WHERE user_id = :user_id AND ref_id = :ref_id');

      // Bind Values
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':ref_id', $ref_id);

      $results = $this->db->resultSet();

      return $results;
    }



     public function getAgentProperty($id){
      $this->db->query('SELECT * FROM property WHERE user_id = :id');
      $this->db->bind(':id', $id);

     $results = $this->db->resultSet();

      return $results;
    }

      

     public function UpdatePropertyPic($data){
       $this->db->query('UPDATE property SET pic = :pic WHERE ref_id = :ref_id');
      // Bind values
      $this->db->bind(':ref_id', $data['ref_id']);
      $this->db->bind(':pic', $data['pic']);

   // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




    public function UpdateProperty($data){
       $this->db->query('UPDATE property SET title = :title, type = :type , purpose = :purpose, price = :price, rooms = :rooms, bathrooms = :bathrooms, details = :details, address = :address, latitude = :latitude, longitude = :longitude, state = :state, lga = :lga  WHERE ref_id = :ref_id');
      // Bind values      
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':purpose', $data['purpose']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':rooms', $data['rooms']);
      $this->db->bind(':bathrooms', $data['bathrooms']);
      $this->db->bind(':details', $data['details']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':latitude', $data['latitude']);
      $this->db->bind(':longitude', $data['longitude']);
      $this->db->bind(':state', $data['state']);
      $this->db->bind(':lga', $data['lga']);
      $this->db->bind(':ref_id', $data['ref_id']);
      
     

   // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




       public function deleteProperty($ref_id){
      $this->db->query('DELETE FROM property WHERE ref_id = :ref_id');
      // Bind values
      $this->db->bind(':ref_id', $ref_id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


    public function deletePicture($id){
      $this->db->query('DELETE FROM pro_img WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


    
    public function getFeaturedProperty(){
      $this->db->query('SELECT * FROM property LIMIT 0,5'); 
     $results = $this->db->resultSet();

      return $results;
    }




    public function getRentProperty($Rent){
      $this->db->query('SELECT * FROM property WHERE purpose= :Rent ');

       $this->db->bind(':Rent', $Rent);

     $results = $this->db->resultSet();

      return $results;
    }


    public function getSaleProperty($Sale){
      $this->db->query('SELECT * FROM property WHERE purpose= :Sale ');

       $this->db->bind(':Sale', $Sale);
        
     $results = $this->db->resultSet();

      return $results;
    }


    public function updateViewPro($ref_id,$view){
       $this->db->query('UPDATE property SET view = :view WHERE ref_id = :ref_id');
      // Bind values
      $this->db->bind(':ref_id', $ref_id);
      $this->db->bind(':view', $view);
     
     

   // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




      public function searchListings($location,$start_from,$limit2){
      $this->db->query('SELECT * FROM property WHERE address LIKE :address OR state LIKE :state OR lga LIKE :lga ORDER BY id ASC LIMIT :start_from, :limit2');

      // Bind Values
      $this->db->bind(':address', "%" . $location . "%");
      $this->db->bind(':state', "%" . $location . "%");
      $this->db->bind(':lga', "%" . $location . "%");
      $this->db->bind(':start_from', $start_from);
      $this->db->bind(':limit2', $limit2);

      $results = $this->db->resultSet();

      return $results;
    }



      public function getListingsNumRows($location){
      $this->db->query('SELECT COUNT(id) AS TotalCount FROM property WHERE address LIKE :address OR state LIKE :state OR lga LIKE :lga');

      // Bind Values
      $this->db->bind(':address', "%" . $location . "%");
      $this->db->bind(':state', "%" . $location . "%");
      $this->db->bind(':lga', "%" . $location . "%");

      $row = $this->db->single();
      
      if($this->db->rowCount() > 0){
        return $row;
      } else {
        return 0;
      }
    }




   public function GetProertyPics(){
      $this->db->query('SELECT ref_id, COUNT(ref_id) AS TotalCountImg FROM pro_img GROUP BY ref_id');
      //$this->db->bind(':ref_id', $ref_id);

      

    $results = $this->db->resultSet();

    return $results;

 
  }

}