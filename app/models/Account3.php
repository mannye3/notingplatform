<?php
  class Account3 {
    private $db;

    public function __construct(){
      $this->db = new Database2;
    }




public function getLiveTrades($trade_date){


      $this->db->query('SELECT market_report.`Security`,COUNT(*) AS countall,SUM(`Qty`) AS totVol,(`Price`),SUM(`Qty`*`Price`) AS totVal,MAX(`Price`) AS maxprice,MIN(`Price`) AS minprice,MAX(`Qty`) AS maxqty,MIN(`Qty`) AS minqty
        FROM market_report
       WHERE  `Date`= :trade_date
        GROUP BY market_report.`Security`');
      $this->db->bind(':trade_date', $trade_date);

      

    $results = $this->db->resultSet();

    return $results;

 
  }



 


  }